#!/usr/bin/env bash
set -euo pipefail

# Diretório onde o script está
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
# Nome da pasta atual do projeto (ex.: mystic_river_concierge_ama-dev)
pastaatual="$(basename "$SCRIPT_DIR")"

# Caminho base esperado
BASE_EXPECTED="/docker/projetos"

# Segurança: verificar se o script está dentro de /docker/projetos
if [[ "$SCRIPT_DIR" != $BASE_EXPECTED/* ]]; then
  echo "Erro: o script deve estar dentro de $BASE_EXPECTED/<projeto>/. Local atual: $SCRIPT_DIR"
  exit 1
fi

echo ">> Ajustando permissões em /docker/projetos/$pastaatual"
sudo chown -R aborba:aborba "/docker/projetos/$pastaatual"
sudo chmod -R 777 "/docker/projetos/$pastaatual"

echo "Concluído."