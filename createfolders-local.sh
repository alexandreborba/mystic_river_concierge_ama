#!/usr/bin/env bash
set -euo pipefail

# Diretório onde o script está
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
# Nome da pasta atual do projeto (ex.: mystic_river_concierge_ama-dev)
pastaatual="$(basename "$SCRIPT_DIR")"

# Caminho base esperado para segurança
BASE_EXPECTED="/Users/alexandreaborba/docker/projetos"

# Verificações de segurança básicas
if [[ "$SCRIPT_DIR" != $BASE_EXPECTED/* ]]; then
  echo "Erro: o script deve estar dentro de $BASE_EXPECTED/<projeto>/. Local atual: $SCRIPT_DIR"
  exit 1
fi

WWW_DIR="$SCRIPT_DIR/www"

# Lista de pastas a criar dentro de www
DIRS=(
  "media/dMenus"
  "media/dMenusv"
  "media/dPrograms"
  "media/logos"
  "media/ships"
  "media/shops"
  "media/spas"
  "media/videos"
  "nocontent/concierge"
  "nocontent/logo"
  "nocontent/restaurant"
)

echo ">> Criando estrutura dentro de: $WWW_DIR"
mkdir -p "$WWW_DIR"

for d in "${DIRS[@]}"; do
  target="$WWW_DIR/$d"
  if [[ -d "$target" ]]; then
    echo "   [!] Já existe: $d → limpando arquivos"
    # Remove todos os arquivos dentro da pasta, mas mantém a pasta
    find "$target" -mindepth 1 -delete
  else
    mkdir -p "$target"
    echo "   [+] Criado: $d"
  fi
done

#echo ">> Ajustando permissões em /docker/projetos/$pastaatual"
#sudo chown -R aborba:aborba "/docker/projetos/$pastaatual"
# sudo chmod -R 777 "/docker/projetos/$pastaatual"

echo "Concluído."