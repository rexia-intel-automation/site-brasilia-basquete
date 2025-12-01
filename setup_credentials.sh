#!/bin/bash
# Script para criar o arquivo de credenciais do banco de dados
# Execute este script no servidor onde o site está hospedado

echo "Criando arquivo de credenciais..."

# Navegar para a pasta config
cd "$(dirname "$0")/admin/config"

# Criar o arquivo db_credentials.php
cat > db_credentials.php << 'CREDENTIALS_FILE'
<?php
/**
 * Database Credentials
 * IMPORTANT: Keep this file secure and never commit passwords to version control
 */

return [
    'host' => 'localhost',
    'database' => 'u568843907_brasiliabasque',
    'username' => 'u568843907_bsbbkt',
    'password' => 'SUBSTITUA_PELA_SUA_SENHA', // ← EDITE AQUI!
    'charset' => 'utf8mb4'
];
CREDENTIALS_FILE

echo "✓ Arquivo criado: admin/config/db_credentials.php"
echo ""
echo "⚠️  IMPORTANTE: Edite o arquivo e adicione sua senha do banco de dados!"
echo ""
echo "Comando para editar:"
echo "  nano admin/config/db_credentials.php"
echo ""
