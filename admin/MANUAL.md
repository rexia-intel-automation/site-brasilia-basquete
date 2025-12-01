# 📖 Manual Completo do Painel Administrativo
## Brasília Basquete - Guia para Iniciantes

---

## 📚 Índice

1. [Introdução](#introdução)
2. [Configuração Inicial](#configuração-inicial)
3. [Primeiro Acesso](#primeiro-acesso)
4. [Navegação no Painel](#navegação-no-painel)
5. [Gerenciar Jogadores](#gerenciar-jogadores)
6. [Gerenciar Posts do Blog](#gerenciar-posts-do-blog)
7. [Solução de Problemas](#solução-de-problemas)
8. [Perguntas Frequentes](#perguntas-frequentes)

---

## 🎯 Introdução

Bem-vindo ao Painel Administrativo do Brasília Basquete! Este sistema permite que você:

- ✅ Adicione e edite informações dos jogadores
- ✅ Publique e gerencie posts do blog
- ✅ Organize conteúdo por categorias
- ✅ Controle o que aparece no site

**Não se preocupe!** Este manual foi feito para quem nunca mexeu com sistemas assim antes. Vamos explicar tudo passo a passo.

---

## 🚀 Configuração Inicial

### Passo 1: Entender os Arquivos

Dentro da pasta `admin/config/` você encontrará dois arquivos importantes:

1. **db_credentials.example.php** - É um modelo/exemplo (não mexe neste)
2. **db_credentials.php** - É onde você vai colocar sua senha (é neste que vamos trabalhar)

### Passo 2: Abrir o Arquivo de Credenciais

**Opção A: Usando um Editor de Código (Recomendado)**

Se você usa VS Code, Sublime Text, ou similar:
1. Abra a pasta do projeto no editor
2. Navegue até: `admin/config/db_credentials.php`
3. Dê um duplo clique para abrir

**Opção B: Usando o Bloco de Notas (Windows)**

1. Abra o Explorador de Arquivos
2. Navegue até a pasta: `admin/config/`
3. Clique com botão direito em `db_credentials.php`
4. Escolha "Abrir com" → "Bloco de Notas"

### Passo 3: Adicionar sua Senha

Você verá um arquivo assim:

```php
<?php
return [
    'host' => 'localhost',
    'database' => 'u568843907_brasiliabasque',
    'username' => 'u568843907_bsbbkt',
    'password' => '', // ← AQUI!
    'charset' => 'utf8mb4'
];
```

**O que fazer:**

1. Localize a linha que tem `'password' => '',`
2. Entre as aspas vazias `''`, coloque sua senha do banco de dados
3. Por exemplo, se sua senha é `minhaSenha123`, ficará assim:
   ```php
   'password' => 'minhaSenha123',
   ```

⚠️ **IMPORTANTE:**
- NÃO remova as aspas simples `'`
- NÃO remova a vírgula `,` no final
- Salve o arquivo depois de editar (Ctrl+S)

### Passo 4: Onde Encontrar suas Credenciais do Banco?

Se você usa **phpMyAdmin** (fornecido pela sua hospedagem):

1. Faça login no painel da sua hospedagem
2. Procure por "phpMyAdmin" ou "Banco de Dados"
3. As informações geralmente estão na página inicial:
   - **Host:** Geralmente é `localhost`
   - **Database:** Seu provedor forneceu (já está no arquivo)
   - **Username:** Seu provedor forneceu (já está no arquivo)
   - **Password:** Você deve ter recebido por email ou pode criar uma nova

### Passo 5: Verificar se Está Correto

Depois de salvar o arquivo, vamos testar se funcionou:

1. Abra seu navegador
2. Digite o endereço: `http://seusite.com.br/admin/`
3. Se aparecer uma página de login, **parabéns!** Deu certo ✅
4. Se aparecer uma mensagem de erro, veja a seção [Solução de Problemas](#solução-de-problemas)

---

## 🔐 Primeiro Acesso

### Acessando o Painel

1. Abra seu navegador (Chrome, Firefox, Edge, Safari...)
2. Digite na barra de endereços:
   ```
   http://seusite.com.br/admin/
   ```
   (Substitua `seusite.com.br` pelo endereço real do seu site)

### Tela de Login

Você verá uma tela com:
- Um campo "Usuário"
- Um campo "Senha"
- Um botão "Entrar"

**Use estas credenciais no primeiro acesso:**

```
Usuário: admin
Senha: admin123
```

⚠️ **ATENÇÃO:** Após entrar pela primeira vez, você DEVE trocar esta senha! (explicaremos como)

### O que Fazer Depois do Primeiro Login?

1. ✅ Você verá o **Dashboard** (painel principal)
2. ✅ À esquerda, terá um menu com várias opções
3. ✅ No topo, terá seu nome de usuário
4. ⚠️ **IMPORTANTE:** Vá em "Configurações" e troque a senha padrão!

---

## 🧭 Navegação no Painel

### Entendendo a Interface

O painel administrativo é dividido em 3 partes:

```
┌─────────────────────────────────────────────┐
│  [Logo] Brasília Basquete    👤 Admin ▼     │ ← CABEÇALHO
├──────────┬──────────────────────────────────┤
│          │                                  │
│ 📊 Dash  │                                  │
│ 👥 Jogad │     CONTEÚDO PRINCIPAL           │
│ 📝 Posts │     (O que você está editando)   │
│ 🏷️ Categ │                                  │
│ 🖼️ Galer │                                  │
│ ⚙️ Config│                                  │
│          │                                  │
│  MENU    │                                  │
│          │                                  │
└──────────┴──────────────────────────────────┘
```

### Menu Lateral (Esquerda)

- **📊 Dashboard** - Página inicial com resumo geral
- **👥 Jogadores** - Gerenciar elenco do time
- **📝 Posts** - Criar e editar notícias do blog
- **🏷️ Categorias** - Organizar posts por categoria
- **🖼️ Galeria** - Gerenciar fotos (em breve)
- **⚙️ Configurações** - Ajustes gerais e trocar senha

### Cabeçalho (Topo)

- **Logo/Nome** - Clique para voltar ao Dashboard
- **🌙/☀️ Botão de Tema** - Alterna entre modo claro e escuro
- **👤 Seu Nome** - Clique para ver opções:
  - Meu Perfil
  - Configurações
  - Sair

---

## 👥 Gerenciar Jogadores

### Como Ver a Lista de Jogadores

1. No menu lateral, clique em **"Jogadores"**
2. Você verá uma tabela com todos os jogadores cadastrados
3. Cada linha mostra:
   - **Foto** - Imagem do jogador
   - **Número** - Camisa do jogador
   - **Nome** - Nome completo
   - **Posição** - Armador, Ala, Pivô, etc.
   - **Status** - Ativo ou Inativo
   - **Ações** - Botões de Editar e Excluir

### Adicionar um Novo Jogador

**Passo a Passo:**

1. Na página "Jogadores", clique no botão **"+ Novo Jogador"** (canto superior direito)

2. Você verá um formulário com vários campos:

   **a) Número da Camisa** (obrigatório)
   ```
   Exemplo: 10
   ```
   - Digite apenas o número
   - Sem hashtag (#) ou outros símbolos

   **b) Nome Completo** (obrigatório)
   ```
   Exemplo: João Silva Santos
   ```
   - Nome e sobrenome do jogador

   **c) Posição** (obrigatório)
   ```
   Opções disponíveis:
   - Armador
   - Ala-Armador
   - Ala
   - Ala-Pivô
   - Pivô
   ```
   - Escolha a posição principal do jogador

   **d) URL da Foto**
   ```
   Exemplo: https://seusite.com.br/fotos/jogador.jpg
   ```
   - Cole o link completo da imagem
   - A imagem deve estar hospedada online
   - Formatos aceitos: JPG, PNG, WEBP

   **e) Altura**
   ```
   Exemplo: 1,85m
   ```
   - Pode digitar como preferir: 1.85m, 1,85, 185cm

   **f) Peso**
   ```
   Exemplo: 82kg
   ```
   - Inclua ou não a unidade (kg)

   **g) Data de Nascimento**
   ```
   Formato: DD/MM/AAAA
   Exemplo: 15/03/1995
   ```
   - Use o seletor de data que aparecer

   **h) Nacionalidade**
   ```
   Padrão: Brasileiro
   Exemplo de outros: Argentino, Americano
   ```

   **i) Status**
   ```
   ☑️ Ativo - Jogador aparece no site
   ☐ Inativo - Jogador não aparece no site
   ```
   - Marque "Ativo" para jogadores do elenco atual
   - Desmarque para jogadores que saíram do time

3. Depois de preencher, clique em **"Salvar"**

4. Você será redirecionado para a lista de jogadores

5. O novo jogador aparecerá na tabela

### Editar um Jogador Existente

1. Na lista de jogadores, localize o jogador que deseja editar
2. Clique no botão **"✏️ Editar"** na coluna "Ações"
3. O formulário abrirá com os dados preenchidos
4. Altere o que desejar
5. Clique em **"Atualizar"** para salvar as mudanças

### Excluir um Jogador

⚠️ **ATENÇÃO:** Esta ação NÃO pode ser desfeita!

1. Na lista de jogadores, localize o jogador que deseja remover
2. Clique no botão **"🗑️ Excluir"** na coluna "Ações"
3. Confirme a exclusão quando perguntado
4. O jogador será removido permanentemente

**Dica:** Em vez de excluir, considere marcar como "Inativo". Assim você mantém o histórico.

### Como Fazer Upload de Fotos dos Jogadores

Existem algumas opções para hospedar as fotos:

**Opção 1: Usar um serviço de hospedagem de imagens**

1. Acesse sites como:
   - Imgur (imgur.com)
   - ImgBB (imgbb.com)
   - Ou similar

2. Faça upload da foto do jogador

3. Copie o link direto da imagem
   - Geralmente termina com `.jpg`, `.png` ou `.webp`
   - Exemplo: `https://i.imgur.com/abc123.jpg`

4. Cole este link no campo "URL da Foto" no formulário

**Opção 2: Hospedar no próprio servidor**

1. Crie uma pasta no seu site, por exemplo: `/uploads/jogadores/`

2. Faça upload da foto via FTP ou painel de hospedagem

3. O link ficará assim:
   ```
   https://seusite.com.br/uploads/jogadores/jogador1.jpg
   ```

4. Use este link no campo "URL da Foto"

**Dica de Tamanho das Fotos:**
- Largura recomendada: 400-600 pixels
- Formato: JPG (menor tamanho de arquivo)
- Qualidade: 80% é suficiente
- Procure fotos com fundo neutro ou transparente

---

## 📝 Gerenciar Posts do Blog

### Como Ver a Lista de Posts

1. No menu lateral, clique em **"Posts"**
2. Você verá todos os posts publicados e rascunhos
3. A tabela mostra:
   - **Título** - Título do post
   - **Categoria** - Notícias, Jogos, etc.
   - **Autor** - Quem criou o post
   - **Visualizações** - Quantas pessoas leram
   - **Status** - Publicado ou Rascunho
   - **Data** - Quando foi criado
   - **Ações** - Editar e Excluir

### Criar um Novo Post

**Passo a Passo Detalhado:**

1. Na página "Posts", clique em **"+ Novo Post"**

2. Preencha o formulário:

   **a) Título do Post** (obrigatório)
   ```
   Exemplo: Brasília Basquete vence por 85 a 72
   ```
   - Seja claro e direto
   - Esse título aparecerá em destaque no blog

   **b) Slug/URL** (gerado automaticamente)
   ```
   Exemplo: brasilia-basquete-vence-por-85-a-72
   ```
   - É o endereço da página do post
   - Gerado automaticamente a partir do título
   - Você pode editar se quiser

   **c) Categoria** (obrigatório)
   ```
   Opções padrão:
   - Notícias - Para novidades e informações gerais
   - Bastidores - Para conteúdo dos treinos e dia a dia
   - Entrevistas - Para entrevistas com jogadores/comissão
   - Jogos - Para resultados e análises de partidas
   - Elenco - Para notícias sobre jogadores
   - História - Para conteúdo histórico do clube
   ```
   - Escolha a categoria mais adequada

   **d) Resumo/Excerpt**
   ```
   Exemplo: O time conquistou mais uma vitória importante
   no campeonato regional com atuação brilhante de...
   ```
   - Um pequeno texto (2-3 linhas)
   - Aparece nas listagens do blog
   - Ajuda o leitor a decidir se quer ler o post completo

   **e) Conteúdo Principal** (obrigatório)
   ```
   O editor de texto funciona como o Word:
   - Negrito, itálico, sublinhado
   - Listas com marcadores
   - Links
   - Títulos e subtítulos
   ```
   - Escreva o texto completo do post aqui
   - Use parágrafos para facilitar a leitura
   - Adicione subtítulos para organizar o conteúdo

   **f) Imagem Destacada**
   ```
   Exemplo: https://seusite.com.br/blog/imagens/jogo-vitoria.jpg
   ```
   - A imagem principal do post
   - Aparece no topo e nas listagens
   - Funciona igual às fotos dos jogadores (URL)

   **g) Post em Destaque**
   ```
   ☑️ Marcar - Post aparece em destaque no blog
   ☐ Desmarcar - Post normal
   ```
   - Marque apenas para posts muito importantes
   - Apenas 1-2 posts devem estar em destaque

   **h) Status de Publicação**
   ```
   ☑️ Publicado - Post visível para todos
   ☐ Rascunho - Post salvo mas não visível
   ```
   - Use "Rascunho" enquanto ainda está escrevendo
   - Mude para "Publicado" quando estiver pronto

3. Clique em **"Publicar"** ou **"Salvar Rascunho"**

### Editar um Post Existente

1. Na lista de posts, clique em **"✏️ Editar"** no post desejado
2. Faça as alterações necessárias
3. Clique em **"Atualizar"**

**Dica:** Sempre revise o post antes de publicar. Verifique:
- ✅ Ortografia e gramática
- ✅ Links funcionando
- ✅ Imagens carregando
- ✅ Formatação correta

### Excluir um Post

⚠️ **CUIDADO:** Não é possível recuperar posts excluídos!

1. Na lista de posts, clique em **"🗑️ Excluir"**
2. Confirme a exclusão
3. O post será removido permanentemente

**Dica:** Considere mudar o status para "Rascunho" em vez de excluir.

### Dicas para Escrever Bons Posts

**Estrutura Ideal de um Post:**

```
1. Título chamativo
   "Brasília Basquete conquista título invicto"

2. Resumo atrativo
   "Equipe venceu todos os 10 jogos da competição..."

3. Conteúdo bem estruturado:

   Parágrafo de abertura
   (resumo do que aconteceu)

   Desenvolvimento
   (detalhes, contexto, informações)

   Citações
   "Foi um trabalho de equipe", disse o técnico

   Conclusão
   (próximos passos, calendário)

4. Imagem de qualidade
   (clara, relacionada ao assunto)
```

**Tamanho Recomendado:**
- Posts curtos: 200-400 palavras
- Posts médios: 400-800 palavras
- Posts longos: 800+ palavras

**Formatação:**
- Use parágrafos curtos (3-4 linhas)
- Adicione subtítulos
- Destaque informações importantes em **negrito**
- Adicione links para posts relacionados

---

## 🏷️ Categorias

As categorias organizam seu blog. Você já tem 6 categorias padrão:

1. **Notícias** - Informações gerais do clube
2. **Bastidores** - Treinos, preparação, dia a dia
3. **Entrevistas** - Conversas com jogadores e comissão
4. **Jogos** - Resultados e análises de partidas
5. **Elenco** - Novidades sobre os jogadores
6. **História** - Conteúdo sobre o passado do clube

### Criar uma Nova Categoria

1. Vá em **"Categorias"** no menu
2. Clique em **"+ Nova Categoria"**
3. Preencha:
   - **Nome:** Ex: "Campeonatos"
   - **Slug:** Ex: "campeonatos" (gerado automaticamente)
4. Clique em **"Salvar"**

---

## 🔧 Solução de Problemas

### Problema 1: "Erro ao conectar com banco de dados"

**Possíveis causas e soluções:**

✅ **Senha incorreta no arquivo de credenciais**
- Abra `admin/config/db_credentials.php`
- Verifique se a senha está correta
- Confirme com seu provedor de hospedagem

✅ **Arquivo de credenciais não existe**
- Certifique-se de que o arquivo `db_credentials.php` existe
- Se não existir, copie de `db_credentials.example.php`

✅ **Host incorreto**
- Geralmente é `localhost`
- Alguns provedores usam um endereço diferente
- Consulte a documentação da sua hospedagem

### Problema 2: "Página em branco" ao acessar o admin

**Solução:**

1. Ative a exibição de erros do PHP:
   - Abra o arquivo `admin/index.php`
   - Adicione no topo do arquivo:
     ```php
     <?php
     error_reporting(E_ALL);
     ini_set('display_errors', 1);
     ```

2. Recarregue a página
3. Agora você verá mensagens de erro que indicam o problema
4. Anote o erro e procure ajuda

### Problema 3: Não consigo fazer login

**Soluções:**

✅ **Confirme as credenciais padrão:**
```
Usuário: admin
Senha: admin123
```

✅ **Caps Lock ativado:**
- Verifique se a tecla Caps Lock não está ativada
- As senhas diferenciam maiúsculas de minúsculas

✅ **Resetar a senha:**
- Será necessário acesso ao banco de dados
- Consulte a seção "Como Resetar a Senha do Admin" abaixo

### Problema 4: Imagens não aparecem

**Verifique:**

✅ **URL da imagem está correta:**
- Copie a URL e cole no navegador
- Se a imagem abrir, a URL está correta
- Se não abrir, a URL está incorreta ou a imagem não existe

✅ **Formato da URL:**
```
Correto: https://exemplo.com/foto.jpg
Errado: www.exemplo.com/foto.jpg (falta o http://)
Errado: exemplo.com/foto (falta a extensão)
```

✅ **A imagem existe:**
- Confirme que você fez upload da imagem
- Verifique se o arquivo não foi movido ou renomeado

### Problema 5: Posts não aparecem no site

**Verifique:**

✅ **Post está publicado:**
- Edite o post
- Confira se o status está como "Publicado"
- Se estiver "Rascunho", mude para "Publicado"

✅ **Cache do navegador:**
- Pressione Ctrl+F5 (Windows) ou Cmd+Shift+R (Mac)
- Isso força o navegador a recarregar a página

### Como Resetar a Senha do Admin

Se você esqueceu a senha, precisará acessar o banco de dados:

**Via phpMyAdmin:**

1. Acesse o phpMyAdmin da sua hospedagem
2. Selecione o banco `u568843907_brasiliabasque`
3. Clique na tabela `users`
4. Encontre o usuário `admin`
5. Clique em "Editar" (ícone de lápis)
6. No campo `password`, cole este valor:
   ```
   $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
   ```
7. Clique em "Executar"
8. Agora a senha voltou a ser: `admin123`

---

## ❓ Perguntas Frequentes

### Como posso ter certeza de que meus dados estão seguros?

✅ **Boas práticas de segurança:**

1. **Troque a senha padrão imediatamente**
   - Nunca use `admin123` em produção
   - Use senhas fortes: letras, números, símbolos

2. **Não compartilhe suas credenciais**
   - Cada pessoa deve ter seu próprio usuário

3. **Faça backups regulares**
   - Salve cópias do banco de dados
   - Mantenha backups dos arquivos

4. **Mantenha o arquivo de credenciais seguro**
   - Nunca o compartilhe publicamente
   - Ele já está protegido pelo .gitignore

### Posso ter mais de um usuário administrador?

Sim! Você pode criar novos usuários:

1. Acesse o phpMyAdmin
2. Vá na tabela `users`
3. Clique em "Inserir"
4. Preencha:
   - **username:** nome do novo usuário
   - **password:** use um gerador de hash online
     - Pesquise: "PHP password hash generator"
     - Use o algoritmo bcrypt
   - **email:** email do usuário

### Como faço para alterar o logo do painel?

1. Prepare sua logo (formato PNG, fundo transparente)
2. Faça upload para: `admin/assets/images/`
3. Edite o arquivo: `admin/includes/header.php`
4. Localize a tag `<img>` do logo
5. Altere o atributo `src` para apontar para sua logo

### Posso personalizar as cores do painel?

Sim! Edite o arquivo: `admin/assets/css/admin.css`

Procure pelas variáveis CSS no topo:
```css
:root {
    --primary-color: #E85D04; /* Laranja principal */
    --secondary-color: #DC2F02; /* Vermelho */
    /* ... outras cores ... */
}
```

Altere os valores hexadecimais para suas cores preferidas.

### Como adiciono novos campos aos jogadores?

Isso requer conhecimento técnico de PHP e SQL. Seria necessário:

1. Adicionar coluna na tabela do banco
2. Modificar o formulário em `admin/players/form.php`
3. Atualizar as consultas SQL
4. Modificar a exibição no site

**Recomendação:** Contrate um desenvolvedor para fazer isso com segurança.

### Quantos jogadores/posts posso cadastrar?

Não há limite prático. O sistema suporta:
- Centenas de jogadores
- Milhares de posts

O limite dependerá da capacidade do seu servidor/hospedagem.

### Como sei se alguém está lendo os posts?

O sistema já conta as visualizações automaticamente!

1. Vá em **"Posts"** no menu
2. A coluna **"Visualizações"** mostra quantas vezes cada post foi lido

**Dica:** Posts com muitas visualizações são populares. Crie mais conteúdo similar!

### Posso agendar posts para publicação futura?

Atualmente não, mas você pode:

1. Salvar como **"Rascunho"**
2. Quando chegar a data desejada, mude para **"Publicado"**

### Como adiciono vídeos aos posts?

Use serviços de hospedagem de vídeo:

**YouTube:**
1. Faça upload do vídeo no YouTube
2. Clique em "Compartilhar"
3. Clique em "Incorporar"
4. Copie o código fornecido
5. Cole no conteúdo do post (modo HTML/código)

**Exemplo:**
```html
<iframe width="560" height="315"
  src="https://www.youtube.com/embed/VIDEO_ID"
  frameborder="0" allowfullscreen>
</iframe>
```

### O que é o "Slug" e por que é importante?

O **slug** é a parte final da URL do post.

**Exemplo:**
```
Post: "Brasília vence mais uma"
Slug: brasilia-vence-mais-uma
URL: seusite.com.br/blog/brasilia-vence-mais-uma
```

**Boas práticas para slugs:**
- Use apenas letras minúsculas
- Substitua espaços por hífens `-`
- Não use acentos ou caracteres especiais
- Seja descritivo mas conciso
- Nunca mude o slug depois de publicar (quebra links)

---

## 📞 Suporte Adicional

### Preciso de mais ajuda!

Se este manual não resolveu seu problema:

1. **Anote exatamente:**
   - O que você estava tentando fazer
   - O que aconteceu
   - Mensagens de erro (copie o texto completo)
   - Capturas de tela ajudam muito!

2. **Verifique os logs de erro:**
   - Geralmente em: `error_log` ou `php_errors.log`
   - Seu provedor de hospedagem pode mostrar isso no painel

3. **Entre em contato com:**
   - Suporte da sua hospedagem (para problemas de banco de dados)
   - Desenvolvedor do sistema (para problemas técnicos)

### Recursos Úteis

- **phpMyAdmin:** Gerenciar banco de dados diretamente
- **FileZilla:** Cliente FTP para fazer upload de arquivos
- **Postimages/Imgur:** Hospedagem gratuita de imagens

---

## ✅ Checklist de Configuração

Use esta lista para garantir que tudo está funcionando:

```
☐ Arquivo db_credentials.php criado e com senha preenchida
☐ Consegui acessar http://seusite.com.br/admin/
☐ Fiz login com admin/admin123
☐ Troquei a senha padrão
☐ Cadastrei pelo menos 1 jogador de teste
☐ Jogador aparece no site principal
☐ Criei pelo menos 1 post de teste
☐ Post aparece no blog do site
☐ Explorei todas as opções do menu
☐ Entendi como adicionar imagens (URL)
☐ Sei como editar e excluir conteúdo
☐ Marquei este manual nos favoritos! 😉
```

---

## 🎓 Conclusão

Parabéns por chegar até aqui! Com este manual, você já tem todo o conhecimento necessário para:

✅ Gerenciar o elenco do Brasília Basquete
✅ Publicar notícias e atualizações no blog
✅ Organizar o conteúdo do site
✅ Resolver problemas comuns

**Lembre-se:**
- Não tenha medo de explorar
- Faça backups antes de mudanças grandes
- Comece devagar e vá ganhando confiança
- Este manual estará sempre aqui para consulta

**Boa sorte e bom trabalho! 🏀🧡**

---

*Última atualização: 2025-12-01*
*Versão: 1.0*
