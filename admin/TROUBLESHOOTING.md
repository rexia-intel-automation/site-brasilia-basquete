# 🔧 Guia de Solução de Problemas
## Painel Administrativo - Brasília Basquete

Este guia contém soluções detalhadas para os problemas mais comuns.

---

## 📑 Índice de Problemas

1. [Problemas de Conexão](#problemas-de-conexão)
2. [Problemas de Login](#problemas-de-login)
3. [Problemas com Imagens](#problemas-com-imagens)
4. [Problemas com Posts](#problemas-com-posts)
5. [Problemas de Visualização](#problemas-de-visualização)
6. [Problemas de Performance](#problemas-de-performance)
7. [Erros PHP](#erros-php)
8. [Recuperação de Emergência](#recuperação-de-emergência)

---

## 🔌 Problemas de Conexão

### ❌ Erro: "Erro na conexão com o banco de dados: Access denied"

**Causa:** Credenciais incorretas do banco de dados.

**Solução Passo a Passo:**

1. Abra o arquivo: `admin/config/db_credentials.php`

2. Verifique cada campo:
   ```php
   'host' => 'localhost',        // Correto?
   'database' => 'u568843907_brasiliabasque',  // Nome exato?
   'username' => 'u568843907_bsbbkt',          // Nome exato?
   'password' => 'sua_senha_aqui',             // Senha correta?
   ```

3. Confirme as credenciais no phpMyAdmin:
   - Acesse o phpMyAdmin da sua hospedagem
   - Verifique se consegue fazer login com as mesmas credenciais
   - Se não conseguir, a senha está incorreta

4. Se necessário, redefina a senha do banco:
   - No painel da hospedagem, vá em "Banco de Dados"
   - Localize o usuário `u568843907_bsbbkt`
   - Clique em "Alterar senha"
   - Defina uma nova senha
   - Atualize o arquivo `db_credentials.php`

---

### ❌ Erro: "SQLSTATE[HY000] [2002] Connection refused"

**Causa:** Host do banco de dados incorreto ou servidor offline.

**Solução:**

1. Verifique se o host está correto:
   - Geralmente é `localhost`
   - Algumas hospedagens usam:
     - `127.0.0.1`
     - `mysql.seudominio.com`
     - Um IP específico

2. Consulte a documentação da sua hospedagem:
   - Procure por "MySQL Host" ou "Database Host"
   - Use o valor fornecido

3. Teste a conexão:
   ```php
   // Crie um arquivo test_connection.php:
   <?php
   $host = 'localhost'; // Mude para testar
   $db = 'u568843907_brasiliabasque';
   $user = 'u568843907_bsbbkt';
   $pass = 'sua_senha';

   try {
       $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
       echo "Conexão OK!";
   } catch(PDOException $e) {
       echo "Erro: " . $e->getMessage();
   }
   ?>
   ```

4. Delete o arquivo `test_connection.php` após testar!

---

### ❌ Erro: "Arquivo de credenciais não encontrado"

**Causa:** Arquivo `db_credentials.php` não existe.

**Solução:**

1. Navegue até: `admin/config/`

2. Verifique se existe o arquivo `db_credentials.php`

3. Se não existir:
   - Copie `db_credentials.example.php`
   - Renomeie a cópia para `db_credentials.php`

4. No Linux/Mac (via terminal):
   ```bash
   cd admin/config
   cp db_credentials.example.php db_credentials.php
   ```

5. No Windows (via cmd):
   ```cmd
   cd admin\config
   copy db_credentials.example.php db_credentials.php
   ```

6. Edite o novo arquivo e adicione a senha

---

## 🔐 Problemas de Login

### ❌ "Usuário ou senha incorretos"

**Solução 1: Verificar credenciais padrão**

```
Usuário: admin (tudo minúsculo)
Senha: admin123 (sem espaços)
```

- Caps Lock está desligado?
- Não há espaços extras no início ou fim?

**Solução 2: Resetar senha via banco de dados**

1. Acesse phpMyAdmin

2. Selecione o banco: `u568843907_brasiliabasque`

3. Clique na tabela `users`

4. Localize a linha do usuário `admin`

5. Clique em "Editar" (ícone de lápis)

6. No campo `password`, substitua todo o conteúdo por:
   ```
   $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
   ```

7. Clique em "Executar"

8. Agora a senha voltou a ser: `admin123`

**Solução 3: Verificar se a tabela users existe**

1. No phpMyAdmin, verifique se a tabela `users` existe

2. Se não existir:
   - O banco não foi inicializado corretamente
   - Acesse `http://seusite.com.br/admin/index.php`
   - As tabelas serão criadas automaticamente

---

### ❌ "Página redireciona infinitamente"

**Causa:** Problema com sessões PHP.

**Solução:**

1. Limpe os cookies do navegador:
   - Chrome: Ctrl+Shift+Del
   - Selecione "Cookies"
   - Limpe apenas do seu site

2. Verifique se as sessões estão funcionando:
   ```php
   // Crie test_session.php na raiz:
   <?php
   session_start();
   $_SESSION['teste'] = 'funcionou';
   echo "Sessão OK: " . $_SESSION['teste'];
   ?>
   ```

3. Se aparecer erro, verifique permissões:
   - A pasta de sessões do PHP precisa ter permissão de escrita
   - Geralmente: `/tmp` no Linux
   - Contate a hospedagem se necessário

---

### ❌ "Deslogado automaticamente"

**Causa:** Timeout de sessão curto.

**Solução:**

1. Edite `admin/auth/check_auth.php`

2. Adicione após `session_start();`:
   ```php
   // Aumentar tempo de sessão para 8 horas
   ini_set('session.gc_maxlifetime', 28800);
   ```

3. Ou use "Remember me" (se implementado)

---

## 🖼️ Problemas com Imagens

### ❌ Imagem não aparece (ícone quebrado)

**Diagnóstico:**

1. Clique com botão direito na imagem quebrada
2. Escolha "Copiar endereço da imagem"
3. Cole em uma nova aba do navegador

**Se a imagem carregar:** Problema no código
**Se não carregar:** Problema na URL

**Soluções:**

**A) URL incorreta ou incompleta**
```
❌ Errado: www.exemplo.com/foto.jpg
✅ Correto: https://www.exemplo.com/foto.jpg

❌ Errado: /uploads/foto
✅ Correto: https://seusite.com.br/uploads/foto.jpg
```

**B) Imagem foi movida ou excluída**
- Faça upload novamente
- Atualize a URL no admin

**C) Problema de permissões**
- A pasta com as imagens precisa ter permissão 755
- Os arquivos precisam ter permissão 644

**D) Imagem muito grande**
- Redimensione para máximo 1920px
- Comprima usando TinyPNG.com
- Formato recomendado: JPG para fotos

---

### ❌ "Não sei como fazer upload de imagens"

**Método 1: Usar serviço externo (Mais fácil)**

1. Vá para [imgur.com](https://imgur.com)

2. Clique em "New post"

3. Faça upload da imagem

4. Clique com botão direito na imagem

5. Escolha "Copiar endereço da imagem"

6. Cole este link no campo "URL da Foto"

**Método 2: Usar seu próprio servidor**

1. Crie uma pasta no seu site:
   - Via FTP: Criar pasta `/uploads/`
   - Via painel: Gerenciador de arquivos → Nova pasta

2. Faça upload da imagem para esta pasta

3. A URL será:
   ```
   https://seusite.com.br/uploads/nome-da-imagem.jpg
   ```

4. Use esta URL no admin

**Método 3: Via cPanel (se disponível)**

1. Login no cPanel

2. Gerenciador de Arquivos

3. Navegue até `public_html/uploads/`

4. Botão "Upload"

5. Selecione a imagem

6. Use a URL completa no admin

---

### ❌ Imagens aparecem distorcidas

**Causa:** Tamanho ou proporção incorreta.

**Solução:**

1. Use imagens nas proporções corretas:
   - **Jogadores:** 3:4 (vertical) - Ex: 600x800px
   - **Posts:** 16:9 (horizontal) - Ex: 1200x675px
   - **Logo:** 1:1 (quadrado) ou horizontal

2. Redimensione antes de fazer upload:
   - Online: [ResizeImage.net](https://resizeimage.net)
   - Software: GIMP, Photoshop, Paint.NET

3. Se não puder redimensionar:
   - Ajuste o CSS para `object-fit: cover;`

---

## 📝 Problemas com Posts

### ❌ Post não aparece no site

**Checklist de verificação:**

1. ✅ **Status está "Publicado"?**
   - Edite o post no admin
   - Verifique se a opção "Publicado" está marcada
   - Se estiver "Rascunho", o post não aparece

2. ✅ **Limpe o cache:**
   - Pressione Ctrl+F5 (Windows)
   - Ou Cmd+Shift+R (Mac)
   - Ou abra em aba anônima

3. ✅ **Verifique a categoria:**
   - O post tem uma categoria selecionada?
   - A página do blog está filtrando por categoria?

4. ✅ **Verifique a data:**
   - Se há sistema de agendamento
   - A data de publicação já passou?

5. ✅ **Verifique erros PHP:**
   - Ative exibição de erros
   - Veja logs: `error_log`

---

### ❌ Formatação do post aparece errada

**Causa:** HTML mal formatado ou tags não fechadas.

**Solução:**

1. Edite o post no admin

2. Se usou editor visual:
   - Mude para modo "Código/HTML"
   - Procure por tags não fechadas:
     ```html
     ❌ <p>Texto sem fechar
     ✅ <p>Texto fechado</p>
     ```

3. Verifique parágrafos:
   - Use `<p>` para cada parágrafo
   - Não use múltiplos `<br>`

4. Remova formatação problemática:
   - Selecione todo texto
   - Clique em "Remover formatação"
   - Reformate do zero

---

### ❌ Texto colado do Word aparece estranho

**Causa:** Word adiciona formatação invisível.

**Solução:**

1. **Método 1: Cola como texto puro**
   - Copie do Word
   - Cole no Bloco de Notas primeiro
   - Copie do Bloco de Notas
   - Cole no editor do admin

2. **Método 2: Use "Colar sem formatação"**
   - No editor, use Ctrl+Shift+V
   - Ou botão "Colar como texto puro"

3. **Método 3: Limpe depois**
   - Cole normalmente
   - Selecione todo texto
   - Clique em "Limpar formatação"
   - Reformate manualmente

---

### ❌ Links não funcionam nos posts

**Verificações:**

1. **URL completa?**
   ```
   ❌ Errado: www.google.com
   ✅ Correto: https://www.google.com
   ```

2. **Tag correta?**
   ```html
   ✅ <a href="https://exemplo.com">Clique aqui</a>
   ```

3. **Aspas corretas?**
   ```html
   ❌ <a href='https://exemplo.com'>Link</a>
   ✅ <a href="https://exemplo.com">Link</a>
   ```

4. **Abrir em nova aba?**
   ```html
   <a href="https://exemplo.com" target="_blank">Link</a>
   ```

---

## 👁️ Problemas de Visualização

### ❌ "Página em branco"

**Solução 1: Ativar exibição de erros**

1. Abra o arquivo que está dando problema

2. Adicione no topo (linha 1):
   ```php
   <?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```

3. Recarregue a página

4. Anote o erro que aparecer

**Solução 2: Verificar logs**

1. Localize o arquivo de log:
   - `error_log` na pasta do site
   - Ou no painel da hospedagem: "Logs de Erro"

2. Abra o arquivo

3. Veja os últimos erros (no final do arquivo)

**Solução 3: Verificar PHP**

1. Crie `info.php` na raiz:
   ```php
   <?php phpinfo(); ?>
   ```

2. Acesse: `http://seusite.com.br/info.php`

3. Se aparecer informações, PHP está OK

4. Delete o arquivo depois!

---

### ❌ Layout quebrado / CSS não carrega

**Verificações:**

1. **Arquivo CSS existe?**
   - `admin/assets/css/admin.css`
   - Se não existir, recupere do backup

2. **Caminho correto?**
   ```php
   // No header.php, verificar:
   <link rel="stylesheet" href="../assets/css/admin.css">
   ```

3. **Limpe cache do navegador:**
   - Ctrl+F5
   - Ou Ctrl+Shift+Del → Limpar cache

4. **Verifique permissões:**
   - Arquivo CSS precisa ter permissão 644
   - Pasta precisa ter permissão 755

---

### ❌ Modo escuro/claro não funciona

**Solução:**

1. **Limpe localStorage:**
   ```javascript
   // Console do navegador (F12):
   localStorage.clear();
   location.reload();
   ```

2. **Verifique o JavaScript:**
   - Abra Console (F12)
   - Procure por erros em vermelho
   - O arquivo `admin.js` está carregando?

3. **Teste manualmente:**
   - Console (F12)
   - Digite: `document.documentElement.setAttribute('data-theme', 'dark');`
   - Se funcionar, problema está no JS

---

## ⚡ Problemas de Performance

### ❌ Painel muito lento

**Soluções:**

1. **Otimize o banco de dados:**
   ```sql
   -- No phpMyAdmin, execute:
   OPTIMIZE TABLE users;
   OPTIMIZE TABLE players;
   OPTIMIZE TABLE posts;
   OPTIMIZE TABLE categories;
   ```

2. **Adicione índices:**
   ```sql
   -- Acelera buscas:
   CREATE INDEX idx_posts_category ON posts(category_id);
   CREATE INDEX idx_posts_author ON posts(author_id);
   CREATE INDEX idx_posts_published ON posts(published);
   ```

3. **Limite resultados:**
   - Adicione paginação nas listagens
   - Mostre 20-50 itens por página

4. **Otimize imagens:**
   - Use WebP em vez de PNG
   - Comprima todas imagens
   - Tamanho máximo: 200KB

---

### ❌ Muitos dados / banco pesado

**Soluções:**

1. **Limpe dados antigos:**
   ```sql
   -- Delete posts muito antigos (mais de 2 anos):
   DELETE FROM posts WHERE created_at < DATE_SUB(NOW(), INTERVAL 2 YEAR);
   ```

2. **Archive conteúdo:**
   - Exporte posts antigos
   - Salve em arquivo
   - Delete do banco

3. **Limpe visualizações:**
   ```sql
   -- Reset contador de views:
   UPDATE posts SET views = 0;
   ```

---

## 🐛 Erros PHP

### ❌ "Call to undefined function"

**Causa:** Extensão PHP não instalada.

**Solução:**

1. Identifique qual função está faltando

2. Extensões necessárias:
   - `PDO` - Para banco de dados
   - `pdo_mysql` - Para MySQL
   - `mbstring` - Para strings UTF-8
   - `session` - Para login

3. Contate a hospedagem para instalar

4. Ou edite `php.ini`:
   ```ini
   extension=pdo
   extension=pdo_mysql
   extension=mbstring
   ```

---

### ❌ "Fatal error: Maximum execution time exceeded"

**Causa:** Script rodando por muito tempo.

**Solução:**

1. Aumente o tempo limite:
   ```php
   // No topo do arquivo:
   set_time_limit(300); // 5 minutos
   ```

2. Ou em `.htaccess`:
   ```apache
   php_value max_execution_time 300
   ```

3. Otimize queries lentas:
   - Adicione índices
   - Limite resultados
   - Use LIMIT nas queries

---

### ❌ "Allowed memory size exhausted"

**Causa:** Script usa muita memória RAM.

**Solução:**

1. Aumente o limite:
   ```php
   // No topo do arquivo:
   ini_set('memory_limit', '256M');
   ```

2. Otimize o código:
   - Processe dados em lotes
   - Não carregue tudo de uma vez
   - Libere variáveis: `unset($var);`

---

## 🆘 Recuperação de Emergência

### ❌ "Deletei tudo sem querer!"

**Se tiver backup:**

1. Acesse phpMyAdmin

2. Selecione o banco

3. Aba "Importar"

4. Escolha o arquivo de backup (.sql)

5. Clique em "Executar"

**Se NÃO tiver backup:**

1. 😰 Contate a hospedagem IMEDIATAMENTE

2. Muitos servidores fazem backup automático

3. Peça para restaurar do backup mais recente

4. **Para o futuro:**
   - Faça backups semanais!
   - Salve em local seguro
   - Teste restauração

---

### ❌ "Site hackeado / invadido"

**Ação imediata:**

1. **Troque TODAS as senhas:**
   - Admin do painel
   - Banco de dados
   - FTP
   - Hospedagem
   - Email

2. **Scan de malware:**
   - Use plugin de segurança
   - Ou serviço online: VirusTotal

3. **Verifique arquivos:**
   - Procure arquivos suspeitos
   - Extensões estranhas: .suspected, .malware
   - Arquivos novos que você não criou

4. **Restaure de backup limpo:**
   - Use backup de antes da invasão
   - Verifique data de modificação dos arquivos

5. **Fortaleça segurança:**
   - Atualize todas senhas
   - Use senhas complexas
   - Ative 2FA se disponível

---

### 🔐 Recuperação de Senha Master

Se perdeu acesso total ao sistema:

**Método 1: Via Banco de Dados**

Já explicado na seção de Login

**Método 2: Criar Novo Admin**

```sql
-- No phpMyAdmin, execute:
INSERT INTO users (username, password, email)
VALUES (
    'novoadmin',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'novo@email.com'
);
```

Login: `novoadmin` / Senha: `admin123`

---

## 📞 Quando Pedir Ajuda Profissional

Procure um desenvolvedor ou suporte técnico se:

- ❌ Nada neste guia resolveu
- ❌ Há erros que você não entende
- ❌ Suspeita de problemas graves de segurança
- ❌ Precisa de funcionalidades customizadas
- ❌ Quer migrar de servidor
- ❌ Banco de dados corrompido

**O que preparar antes de pedir ajuda:**

1. ✅ Descrição detalhada do problema
2. ✅ O que você estava fazendo quando aconteceu
3. ✅ Mensagens de erro completas (copie e cole)
4. ✅ Capturas de tela
5. ✅ Qual navegador está usando
6. ✅ Se funciona em outro navegador/dispositivo
7. ✅ O que já tentou fazer

---

## 💾 Script de Backup Automático

Cole no arquivo `backup.php` na raiz:

```php
<?php
// Configuração
$host = 'localhost';
$user = 'u568843907_bsbbkt';
$pass = 'SUA_SENHA';
$db = 'u568843907_brasiliabasque';

// Nome do arquivo
$file = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

// Comando mysqldump
$command = "mysqldump --host=$host --user=$user --password=$pass $db > $file";

// Executar
system($command);

echo "Backup criado: $file";
?>
```

Execute semanalmente!

---

## ✅ Checklist de Diagnóstico

Quando algo não funciona, siga esta ordem:

```
☐ 1. Limpar cache do navegador (Ctrl+F5)
☐ 2. Testar em navegador anônimo/privado
☐ 3. Testar em outro navegador
☐ 4. Verificar console do navegador (F12)
☐ 5. Ativar exibição de erros PHP
☐ 6. Verificar logs de erro
☐ 7. Testar conexão com banco de dados
☐ 8. Verificar permissões de arquivos/pastas
☐ 9. Verificar se arquivos existem
☐ 10. Consultar este guia
☐ 11. Procurar erro no Google
☐ 12. Pedir ajuda com informações detalhadas
```

---

**💡 Dica Final:** Mantenha este guia salvo offline para consultar mesmo se o site sair do ar!

---

*Versão 1.0 - Atualizado em 2025-12-01*
