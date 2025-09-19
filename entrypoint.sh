#!/bin/bash

echo "[Entrypoint] Ajustando permissões da pasta /var/www/html para 777 (leitura, escrita e execução para todos)"
chmod -R 777 /var/www/html

# Executa o Apache no foreground para manter o container ativo
exec apache2-foreground
