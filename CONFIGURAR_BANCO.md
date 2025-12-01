# 🔧 Guia: Configurar Banco de Dados

## ❌ Erro: "Arquivo de credenciais não encontrado"

Este erro acontece porque o arquivo `db_credentials.php` não existe no servidor.
Por questões de **segurança**, esse arquivo NÃO é enviado para o Git.

---

## ✅ Solução: Criar o Arquivo de Credenciais

### 📋 Você vai precisar:
- Senha do banco de dados MySQL
- Acesso ao servidor (FTP, SSH ou cPanel)

---

## 🎯 MÉTODO 1: Script Automático (Mais Rápido)

Se você tem acesso SSH ao servidor:

```bash
# 1. Acesse o servidor via SSH
ssh usuario@seuservidor.com

# 2. Navegue até a pasta do site
cd /caminho/do/site

# 3. Execute o script
./setup_credentials.sh

# 4. Edite o arquivo e adicione sua senha
nano admin/config/db_credentials.php
```

**No editor:**
- Localize a linha: `'password' => 'SUBSTITUA_PELA_SUA_SENHA',`
- Substitua `SUBSTITUA_PELA_SUA_SENHA` pela sua senha real
- Salve: `Ctrl + O`, Enter, `Ctrl + X`

---

## 🎯 MÉTODO 2: Via cPanel/Gerenciador de Arquivos (Mais Fácil)

### Passo 1: Acessar o Gerenciador de Arquivos

1. Faça login no **cPanel** da sua hospedagem
2. Clique em **"Gerenciador de Arquivos"** ou **"File Manager"**
3. Navegue até: `public_html/admin/config/` (ou onde está seu site)

### Passo 2: Criar o Arquivo

1. Localize o arquivo **`db_credentials.example.php`**
2. Clique com botão direito nele
3. Escolha **"Copy"** ou **"Copiar"**
4. Digite o novo nome: **`db_credentials.php`**
5. Clique em **"Copy File"** ou **"Copiar Arquivo"**

### Passo 3: Editar o Arquivo

1. Clique com botão direito em **`db_credentials.php`**
2. Escolha **"Edit"** ou **"Editar"**
3. Localize esta linha:
   ```php
   'password' => '', // ADICIONE A SENHA AQUI
   ```
4. Adicione sua senha entre as aspas:
   ```php
   'password' => 'minhaSenha123',
   ```
5. Clique em **"Save Changes"** ou **"Salvar Alterações"**

---

## 🎯 MÉTODO 3: Via FTP (FileZilla)

### Passo 1: Conectar via FTP

1. Abra o **FileZilla** (ou seu cliente FTP)
2. Conecte ao seu servidor
3. Navegue até: `admin/config/`

### Passo 2: Baixar e Editar

1. **Baixe** o arquivo `db_credentials.example.php` para seu computador
2. **Renomeie** para `db_credentials.php`
3. **Abra** com Bloco de Notas ou editor de texto
4. Localize esta linha:
   ```php
   'password' => '', // ADICIONE A SENHA AQUI
   ```
5. Adicione sua senha:
   ```php
   'password' => 'minhaSenha123',
   ```
6. **Salve** o arquivo
7. **Faça upload** do arquivo `db_credentials.php` de volta para `admin/config/`

---

## 🎯 MÉTODO 4: Criar Arquivo Manualmente

### Conteúdo do Arquivo

Crie um arquivo chamado **`db_credentials.php`** dentro de **`admin/config/`** com este conteúdo:

```php
<?php
/**
 * Database Credentials
 * IMPORTANT: Keep this file secure and never commit passwords to version control
 */

return [
    'host' => 'localhost',
    'database' => 'u568843907_brasiliabasque',
    'username' => 'u568843907_bsbbkt',
    'password' => 'SUA_SENHA_AQUI', // ← EDITE AQUI!
    'charset' => 'utf8mb4'
];
```

**⚠️ IMPORTANTE:**
- Substitua `SUA_SENHA_AQUI` pela senha real do banco
- NÃO remova as aspas simples `'`
- NÃO remova a vírgula `,` no final

---

## 📍 Onde Encontrar a Senha do Banco?

### Opção 1: Via phpMyAdmin
1. Acesse o **phpMyAdmin** da sua hospedagem
2. As credenciais geralmente estão na página inicial

### Opção 2: Via cPanel
1. Acesse o **cPanel**
2. Vá em **"MySQL Databases"** ou **"Bancos de Dados MySQL"**
3. Localize o usuário: `u568843907_bsbbkt`
4. Se não souber a senha, você pode criar uma nova:
   - Clique em **"Change Password"** ao lado do usuário
   - Defina uma nova senha
   - Anote a senha
   - Use essa senha no arquivo

### Opção 3: Email da Hospedagem
- Verifique o email que você recebeu ao contratar a hospedagem
- Geralmente contém todas as credenciais

---

## ✅ Verificar se Funcionou

Após criar o arquivo com a senha:

1. Acesse: `http://seusite.com.br/admin/`
2. Se aparecer a **página de login**, deu certo! ✅
3. Use as credenciais:
   - **Usuário:** `admin`
   - **Senha:** `admin123`

---

## ❌ Ainda com Erro?

### Erro: "ATENÇÃO: Configure a senha do banco de dados"
✅ **Solução:** Você criou o arquivo mas não adicionou a senha
- Edite `db_credentials.php`
- Adicione a senha entre as aspas

### Erro: "Erro na conexão com o banco de dados"
❌ **Possíveis causas:**
1. Senha incorreta
   - Confirme a senha no phpMyAdmin
2. Host incorreto
   - Tente mudar `localhost` para `127.0.0.1`
   - Ou consulte a hospedagem sobre o host correto
3. Banco não existe
   - Verifique se o banco `u568843907_brasiliabasque` existe

### Erro: Página em Branco
❌ **Solução:**
1. Verifique se o arquivo foi salvo corretamente
2. Verifique se não tem erros de sintaxe PHP
3. Confira se as aspas e vírgulas estão corretas

---

## 🔐 Importante: Segurança

✅ **BOM:**
- O arquivo `db_credentials.php` está no `.gitignore`
- Ele NÃO é enviado para o repositório Git
- A senha fica apenas no servidor

❌ **NUNCA:**
- Não compartilhe este arquivo
- Não faça commit dele no Git
- Não deixe a senha padrão `admin123` em produção

---

## 📞 Precisa de Ajuda?

Se nenhum método funcionou:

1. Anote a mensagem de erro **completa**
2. Tire um print da tela
3. Verifique os logs de erro do PHP:
   - Geralmente em: `error_log` ou `php_errors.log`
   - No cPanel: "Error Log"

---

## 📚 Documentação Adicional

- **Manual Completo:** `admin/MANUAL.md`
- **Solução de Problemas:** `admin/TROUBLESHOOTING.md`
- **Guia Rápido:** `admin/GUIA-RAPIDO.md`

---

**✅ Após configurar, você terá acesso completo ao painel administrativo!**

*Última atualização: 2025-12-01*
