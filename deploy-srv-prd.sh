#!/bin/bash

clear

SERVER="10.178.103.20" # amavida
# SERVER="10.160.3.1"
PROJECTFOLDER_LOCAL="mystic_river_concierge_ama-local"
PROJECTFOLDER_REMOTE="mystic_river_concierge_ama-prd"

USERS_MACOS=("alexandreaborba" "pedroneves" "bernardoaragao")
USERS_SSH=("aborba" "pneves" "baragao")

echo "Escolha um dos utilizadores abaixo :"
echo 
echo "1) ${USERS_MACOS[0]}"
echo "2) ${USERS_MACOS[1]}"
echo "3) ${USERS_MACOS[2]}"
echo
read -p "Opção (1-3): " OPC
echo
INDEX=$((OPC - 1))

if [[ -z "${USERS_MACOS[$INDEX]}" ]]; then 
  echo "Opção inválida. Saindo."
  exit 1
fi

USERMACOS="${USERS_MACOS[$INDEX]}"
USERSSH="${USERS_SSH[$INDEX]}"

USE_SSH_PASS=false
if [[ "$USERSSH" != "aborba" ]]; then
  USE_SSH_PASS=true
  read -s -p "Digite a senha SSH do utilizador selecionado ($USERSSH): " USERSSHPASSWORD
  echo
fi

LOCAL_BASE="/Users/${USERMACOS}/docker/projetos/${PROJECTFOLDER_LOCAL}"
REMOTE_BASE="/docker/projetos/${PROJECTFOLDER_REMOTE}"

LOG_FILE="./deploy-srv-prd.log"
TIMESTAMP=$(date "+%Y-%m-%d %H:%M:%S")
echo "[$TIMESTAMP] --- Início do deploy PRD ---" >> "$LOG_FILE"

# Função de rsync para deploy parcial
run_rsync_partial() {
  local SRC=$1
  local DEST=$2

  if [ "$USE_SSH_PASS" = true ]; then
    sshpass -p "$USERSSHPASSWORD" rsync -avz --progress \
      -e "ssh -o StrictHostKeyChecking=no -o ConnectTimeout=30" \
      "$SRC" "$USERSSH@$SERVER:$DEST"
  else
    rsync -avz --progress \
      -e "ssh -o StrictHostKeyChecking=no -o ConnectTimeout=30" \
      "$SRC" "$USERSSH@$SERVER:$DEST"
  fi
}

# Deploy parcial
if [ -n "$1" ]; then
  IFS=',' read -ra ITEMS <<< "$1"

  echo "Fazendo deploy dos arquivos/diretórios informados..."
  echo 
  echo "[$TIMESTAMP] Deploy parcial dos arquivos:" >> "$LOG_FILE"

  for ITEM in "${ITEMS[@]}"; do
    LOCAL_ITEM="${LOCAL_BASE}/${ITEM}"
    REMOTE_ITEM="${REMOTE_BASE}/${ITEM}"

    if [ -e "$LOCAL_ITEM" ]; then
      echo "-> Deploy: $ITEM"
      echo "  OK: $ITEM" >> "$LOG_FILE"
      run_rsync_partial "$LOCAL_ITEM" "$REMOTE_ITEM" | tee -a "$LOG_FILE"
    else
      echo "!! AVISO: Arquivo ou diretório não encontrado localmente -> $ITEM (ignorado)"
      echo "  ERRO: Arquivo não encontrado -> $ITEM" >> "$LOG_FILE"
    fi
  done

# Deploy completo
else
  echo "Fazendo deploy completo da pasta www/..."
  echo 
  echo "[$TIMESTAMP] Deploy completo da pasta www/" >> "$LOG_FILE"

  LOCAL_PATH="${LOCAL_BASE}/www/"
  REMOTE_PATH="${REMOTE_BASE}/www"

  echo "[$TIMESTAMP] Remote Path -> $REMOTE_PATH" >> "$LOG_FILE"
  echo "[$TIMESTAMP] Local Path -> $LOCAL_PATH" >> "$LOG_FILE"
  echo "[$TIMESTAMP] User -> $USERSSH" >> "$LOG_FILE"
  echo "[$TIMESTAMP] Server -> $SERVER" >> "$LOG_FILE"

  if [ "$USE_SSH_PASS" = true ]; then
    sshpass -p "$USERSSHPASSWORD" rsync -az --delete \
      --omit-dir-times \
      --no-perms --no-owner --no-group \
      --chown=aborba:aborba \
      --chmod=Dug=rwx,Do=rx,Fu=rw,Fo=r \
      --rsync-path="sudo -n rsync" \
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
      -e "ssh -o StrictHostKeyChecking=no -o ConnectTimeout=30" \
      --progress "$LOCAL_PATH" "$USERSSH@$SERVER:$REMOTE_PATH" \
      | tee -a "$LOG_FILE"
  else
    rsync -az --delete \
      --omit-dir-times \
      --no-perms --no-owner --no-group \
      --chown=aborba:aborba \
      --chmod=Dug=rwx,Do=rx,Fu=rw,Fo=r \
      --rsync-path="sudo -n rsync" \
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
      -e "ssh -o StrictHostKeyChecking=no -o ConnectTimeout=30" \
      --progress "$LOCAL_PATH" "$USERSSH@$SERVER:$REMOTE_PATH" \
      | tee -a "$LOG_FILE"
  fi
fi

TIMESTAMP=$(date "+%Y-%m-%d %H:%M:%S")
echo "[$TIMESTAMP] --- Fim do deploy DEV ---" >> "$LOG_FILE"

echo
echo "Deploy Ambiente PRD[ 10.177.160.20 ] concluído com sucesso!"
echo