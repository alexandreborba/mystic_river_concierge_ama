#!/bin/bash
# ==============================================================================
# deploy-srv-prd.sh
#
# Deploy PRD via rsync/ssh usando chave SSH (sem sshpass).
#
# Lê variáveis específicas do servidor a partir de um ficheiro de config:
# - por defeito: ./deploy-srv-prd_config
# - ou: ./deploy-srv-prd.sh --config ./deploy-srv-prd_config_outro
#
# NOTA IMPORTANTE (sem sudo):
# - Este script executa rsync SEM sudo no servidor (para evitar falhas TTY/sudo).
# - Para funcionar, o utilizador remoto tem de ter permissão de escrita em:
#     /docker/projetos/<PROJECTFOLDER_REMOTE>/www
# - E o Apache tem de conseguir ler (e escrever onde for necessário).
# - Se existir sudo NOPASSWD no servidor, o script tenta (opcionalmente) corrigir
#   permissões no fim. Se não existir, ignora e não falha por isso.
# ==============================================================================

set -u

clear

# ------------------------------------------------------------------------------
# CONFIG LOADING
# ------------------------------------------------------------------------------

DEFAULT_CONFIG="./deploy-srv-prd_config"
CONFIG_FILE="$DEFAULT_CONFIG"

# Suporta: --config /caminho/para/config
if [[ $# -ge 2 && "${1:-}" == "--config" ]]; then
  CONFIG_FILE="$2"
  shift 2
fi

if [[ ! -f "$CONFIG_FILE" ]]; then
  echo "ERRO: ficheiro de config não encontrado: $CONFIG_FILE"
  echo "Crie-o com base no template 'deploy-srv-prd_config'."
  exit 1
fi

# shellcheck source=/dev/null
source "$CONFIG_FILE"

# Valida variáveis obrigatórias
if [[ -z "${SERVER:-}" || -z "${PROJECTFOLDER_LOCAL:-}" || -z "${PROJECTFOLDER_REMOTE:-}" ]]; then
  echo "ERRO: Config incompleto. Garante que existem:"
  echo "  SERVER, PROJECTFOLDER_LOCAL, PROJECTFOLDER_REMOTE"
  exit 1
fi

# Default se não vier do config
REMOTE_OWNER_GROUP="${REMOTE_OWNER_GROUP:-www-data}"

# ------------------------------------------------------------------------------
# UTILIZADORES (MACOS -> SSH)
# ------------------------------------------------------------------------------
USERS_MACOS=("alexandreaborba" "pedroneves" "bernardoaragao")
USERS_SSH=("aborba" "pneves" "baragao")

echo "Escolha um dos utilizadores abaixo :"
echo
echo "1) ${USERS_MACOS[0]}  -> SSH: ${USERS_SSH[0]}"
echo "2) ${USERS_MACOS[1]}  -> SSH: ${USERS_SSH[1]}"
echo "3) ${USERS_MACOS[2]}  -> SSH: ${USERS_SSH[2]}"
echo
read -r -p "Opção (1-3): " OPC
echo

INDEX=$((OPC - 1))
if [[ $INDEX -lt 0 || $INDEX -ge ${#USERS_MACOS[@]} ]]; then
  echo "Opção inválida. Saindo."
  exit 1
fi

USERMACOS="${USERS_MACOS[$INDEX]}"
REMOTE_SSH_USER="${USERS_SSH[$INDEX]}"

# ------------------------------------------------------------------------------
# PATHS E LOG
# ------------------------------------------------------------------------------
LOCAL_BASE="/Users/${USERMACOS}/docker/projetos/${PROJECTFOLDER_LOCAL}"
REMOTE_BASE="/docker/projetos/${PROJECTFOLDER_REMOTE}"

LOG_FILE="./deploy-srv-prd.log"
TIMESTAMP=$(date "+%Y-%m-%d %H:%M:%S")
echo "[$TIMESTAMP] --- Início do deploy PRD em $SHIPCODE [ $SHIPNAME ]---" >> "$LOG_FILE"
echo "[$TIMESTAMP] Config -> $CONFIG_FILE" >> "$LOG_FILE"
echo "[$TIMESTAMP] Server -> $SERVER" >> "$LOG_FILE"
echo "[$TIMESTAMP] ShipCode -> $SHIPCODE" >> "$LOG_FILE"
echo "[$TIMESTAMP] ShipName -> $SHIPNAME" >> "$LOG_FILE"
echo "[$TIMESTAMP] User   -> $REMOTE_SSH_USER" >> "$LOG_FILE"
echo "[$TIMESTAMP] Local  -> $LOCAL_BASE" >> "$LOG_FILE"
echo "[$TIMESTAMP] Remote -> $REMOTE_BASE" >> "$LOG_FILE"

# ------------------------------------------------------------------------------
# CHAVE SSH LOCAL
# ------------------------------------------------------------------------------
SSH_DIR="${HOME}/.ssh"
SSH_KEY="${SSH_DIR}/id_ed25519"
SSH_PUB="${SSH_KEY}.pub"

SSH_OPTS_BASE="-o StrictHostKeyChecking=no -o ConnectTimeout=30 -o ServerAliveInterval=10 -o ServerAliveCountMax=3"

# ------------------------------------------------------------------------------
# HELPERS
# ------------------------------------------------------------------------------
ensure_local_keypair() {
  mkdir -p "$SSH_DIR"
  chmod 700 "$SSH_DIR"

  if [[ ! -f "$SSH_KEY" || ! -f "$SSH_PUB" ]]; then
    echo "Chave SSH não encontrada. A criar chave ed25519 local (${SSH_KEY})..."
    ssh-keygen -t ed25519 -C "${REMOTE_SSH_USER}@${USERMACOS}" -f "$SSH_KEY" -N "" || exit 1
  fi

  chmod 600 "$SSH_KEY"
  chmod 644 "$SSH_PUB"
}

ssh_test_passwordless() {
  ssh -i "$SSH_KEY" $SSH_OPTS_BASE -o BatchMode=yes \
    "${REMOTE_SSH_USER}@${SERVER}" "echo SSH_OK >/dev/null" 2>/dev/null
  return $?
}

bootstrap_authorized_keys_if_needed() {
  echo "Testando SSH sem password para ${REMOTE_SSH_USER}@${SERVER}..."
  if ssh_test_passwordless; then
    echo "SSH sem password já está ativo para ${REMOTE_SSH_USER}@${SERVER}."
    return 0
  fi

  echo "SSH sem password ainda não está ativo para ${REMOTE_SSH_USER}@${SERVER}."
  echo "A instalar a chave pública no servidor (vai pedir a password UMA vez)..."
  ssh-copy-id -i "$SSH_PUB" -o StrictHostKeyChecking=no "${REMOTE_SSH_USER}@${SERVER}"
  local RC=$?
  if [[ $RC -ne 0 ]]; then
    echo "ERRO: não foi possível instalar a chave com ssh-copy-id (exit code $RC)."
    exit $RC
  fi

  echo "Chave instalada. Re-testando SSH sem password..."
  if ! ssh_test_passwordless; then
    echo "ERRO: mesmo após ssh-copy-id, SSH sem password ainda falha."
    exit 1
  fi
  echo "SSH sem password ativado com sucesso."
}

run_remote() {
  local CMD="$1"
  ssh -i "$SSH_KEY" $SSH_OPTS_BASE "${REMOTE_SSH_USER}@${SERVER}" "$CMD"
}

check_remote_write_access() {
  local REMOTE_WWW="${REMOTE_BASE}/www"
  echo "Validando permissão de escrita no destino remoto: ${REMOTE_WWW} no ${SHIPCODE} [ ${SHIPNAME} ]..."
  run_remote "test -d '${REMOTE_WWW}' && test -w '${REMOTE_WWW}'"
  local RC=$?
  if [[ $RC -ne 0 ]]; then
    echo "ERRO: o utilizador ${REMOTE_SSH_USER} não tem permissão de escrita em ${REMOTE_WWW}"
    echo "Correção (no servidor, uma vez, por alguém com sudo/root), exemplo:"
    echo "  sudo chown -R ${REMOTE_SSH_USER}:${REMOTE_OWNER_GROUP} '${REMOTE_WWW}'"
    echo "  sudo find '${REMOTE_WWW}' -type d -exec chmod 2775 {} +"
    echo "  sudo find '${REMOTE_WWW}' -type f -exec chmod 0664 {} +"
    echo "  sudo usermod -aG ${REMOTE_OWNER_GROUP} ${REMOTE_SSH_USER}"
    exit 1
  fi
}

# Opcional: se existir sudo NOPASSWD, normaliza permissões no fim
try_fix_remote_permissions_www() {
  local REMOTE_WWW="${REMOTE_BASE}/www"

  run_remote "sudo -n true" >/dev/null 2>&1
  if [[ $? -ne 0 ]]; then
    echo "Aviso: sudo NOPASSWD não está ativo. A correção automática de permissões será ignorada."
    return 0
  fi

  echo "Ajustando permissões/ownership no PRD (sudo NOPASSWD detetado)..."
  run_remote "sudo -n chown -R ${REMOTE_SSH_USER}:${REMOTE_OWNER_GROUP} '${REMOTE_WWW}'" | tee -a "$LOG_FILE"
  local RC=${PIPESTATUS[0]}
  if [[ $RC -ne 0 ]]; then
    echo "Aviso: falha no chown automático (exit code $RC)."
    return 0
  fi

  run_remote "sudo -n find '${REMOTE_WWW}' -type d -exec chmod 2775 {} +" | tee -a "$LOG_FILE"
  run_remote "sudo -n find '${REMOTE_WWW}' -type f -exec chmod 0664 {} +" | tee -a "$LOG_FILE"

  echo "Permissões ajustadas."
  return 0
}

run_rsync_partial() {
  local SRC="$1"
  local DEST="$2"

  rsync -rz --progress \
    --omit-dir-times \
    --no-perms --no-owner --no-group \
    --chmod=Du=rwx,Dg=rwx,Do=rx,Fu=rw,Fg=rw,Fo=r \
    -e "ssh -i ${SSH_KEY} ${SSH_OPTS_BASE}" \
    "$SRC" "${REMOTE_SSH_USER}@${SERVER}:$DEST"
}

run_rsync_full_www() {
  local SRC="$1"
  local DEST="$2"


  rsync -rz --delete \
    --omit-dir-times \
    --no-perms --no-owner --no-group \
    --chmod=Du=rwx,Dg=rwx,Do=rx,Fu=rw,Fg=rw,Fo=r \
    --exclude '.DS_Store' \
    --exclude '.env' \
    --exclude '.custom.ini' \
    --exclude 'entrypoint.sh' \
    --exclude 'Dockerfile' \
    --exclude 'docker-composer.yml' \
    --exclude '.gitignore' \
    --exclude '.git/' \
    --exclude '.github/' \
    --exclude 'deploy-srv*' \
    --exclude 'deploy-srv-dev.sh' \
    --exclude 'deploy-srv-qua.sh' \
    --exclude 'deploy-srv-prd.sh' \
    --exclude 'composer.json' \
    --exclude 'composer.lock' \
    --exclude 'media/**' \
    --exclude 'nocontent/**' \
    --exclude '_not/' \
    --exclude 's/' \
    --exclude 'sv/' \
    -e "ssh -i ${SSH_KEY} ${SSH_OPTS_BASE}" \
    --progress "$SRC" "${REMOTE_SSH_USER}@${SERVER}:$DEST"
}

# ------------------------------------------------------------------------------
# PRÉ-CHECAGENS
# ------------------------------------------------------------------------------
if [[ ! -d "$LOCAL_BASE" ]]; then
  echo "ERRO: Pasta local não encontrada: $LOCAL_BASE"
  exit 1
fi

ensure_local_keypair
bootstrap_authorized_keys_if_needed
check_remote_write_access

# ------------------------------------------------------------------------------
# DEPLOY
# ------------------------------------------------------------------------------
if [[ $# -ge 1 && -n "${1:-}" ]]; then
  # Deploy parcial: ./deploy-srv-prd.sh "www/index.html,www/js/app.js"
  IFS=',' read -ra ITEMS <<< "$1"

  echo "Fazendo deploy dos arquivos/diretórios informados..."
  echo
  echo "[$(date "+%Y-%m-%d %H:%M:%S")] Deploy parcial: $1" >> "$LOG_FILE"

  for ITEM in "${ITEMS[@]}"; do
    ITEM="$(echo "$ITEM" | xargs)"

    LOCAL_ITEM="${LOCAL_BASE}/${ITEM}"
    REMOTE_ITEM="${REMOTE_BASE}/${ITEM}"

    if [[ -e "$LOCAL_ITEM" ]]; then
      echo "-> Deploy: $ITEM"
      echo "  OK: $ITEM" >> "$LOG_FILE"

      run_rsync_partial "$LOCAL_ITEM" "$REMOTE_ITEM" | tee -a "$LOG_FILE"
      RC=${PIPESTATUS[0]}
      if [[ $RC -ne 0 ]]; then
        echo "ERRO: rsync falhou no deploy parcial de '$ITEM' (exit code $RC)"
        exit $RC
      fi
    else
      echo "Aviso: Não encontrado localmente -> $ITEM (ignorado)"
      echo "  ERRO: Não encontrado -> $ITEM" >> "$LOG_FILE"
    fi
  done

else
  echo "Fazendo deploy completo da pasta www/..."
  echo
  echo "[$(date "+%Y-%m-%d %H:%M:%S")] Deploy completo da pasta www/" >> "$LOG_FILE"

  LOCAL_PATH="${LOCAL_BASE}/www/"
  REMOTE_PATH="${REMOTE_BASE}/www"

  run_rsync_full_www "$LOCAL_PATH" "$REMOTE_PATH" | tee -a "$LOG_FILE"
  RC=${PIPESTATUS[0]}
  if [[ $RC -ne 0 ]]; then
    echo "ERRO: rsync falhou no deploy completo (exit code $RC)"
    exit $RC
  fi
fi

# Opcional: corrige permissões se houver sudo NOPASSWD
try_fix_remote_permissions_www

TIMESTAMP=$(date "+%Y-%m-%d %H:%M:%S")
echo "[$TIMESTAMP] --- Fim do deploy PRD em $SHIPCODE [ $SHIPNAME ]---" >> "$LOG_FILE"

echo
echo "Deploy Ambiente PRD[ $SERVER ] $SHIPCODE [ $SHIPNAME ] concluído com sucesso!"
echo