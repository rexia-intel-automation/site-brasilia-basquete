# Painel Administrativo - Brasília Basquete

Sistema de gerenciamento de conteúdo para o site do Brasília Basquete.

## 📚 Documentação

Este arquivo contém uma visão geral técnica. Para documentação completa:

- **📖 [MANUAL.md](MANUAL.md)** - Manual completo e didático para iniciantes
  - Passo a passo detalhado de configuração
  - Como usar todas as funcionalidades
  - Solução de problemas comuns
  - Perguntas frequentes

- **⚡ [GUIA-RAPIDO.md](GUIA-RAPIDO.md)** - Referência rápida
  - Ações mais comuns
  - Atalhos e dicas
  - Checklists úteis

👉 **Primeira vez usando o sistema? Comece pelo [MANUAL.md](MANUAL.md)**

---

## 📋 Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Extensões PHP: PDO, PDO_MySQL

## 🚀 Instalação

### 1. Configurar Banco de Dados

O sistema usa MySQL para armazenar os dados. Siga os passos abaixo:

#### 1.1. Criar arquivo de credenciais

```bash
cd admin/config
cp db_credentials.example.php db_credentials.php
```

#### 1.2. Adicionar senha do banco

Edite o arquivo `admin/config/db_credentials.php` e adicione a senha:

```php
return [
    'host' => 'localhost',
    'database' => 'u568843907_brasiliabasque',
    'username' => 'u568843907_bsbbkt',
    'password' => 'SUA_SENHA_AQUI', // ← Adicione sua senha
    'charset' => 'utf8mb4'
];
```

#### 1.3. As tabelas serão criadas automaticamente

Ao acessar o painel pela primeira vez, o sistema irá:
- Criar todas as tabelas necessárias
- Inserir um usuário admin padrão
- Inserir categorias padrão para o blog

## 🔐 Login Inicial

Após a instalação, use estas credenciais para o primeiro acesso:

- **Usuário:** admin
- **Senha:** admin123

⚠️ **IMPORTANTE:** Altere a senha padrão após o primeiro login!

## 📁 Estrutura do Banco de Dados

O sistema cria as seguintes tabelas:

### `users`
- Usuários do painel administrativo
- Armazena username, senha (hash) e email

### `players`
- Jogadores do elenco
- Informações: número, nome, posição, foto, altura, peso, data de nascimento, nacionalidade

### `categories`
- Categorias do blog
- Pré-populada com: Notícias, Bastidores, Entrevistas, Jogos, Elenco, História

### `posts`
- Posts do blog
- Campos: título, slug, conteúdo, imagem destacada, categoria, autor, status de publicação

## 🛠️ Recursos

### Gerenciamento de Jogadores
- ✅ Adicionar/editar/excluir jogadores
- ✅ Upload de fotos (via URL)
- ✅ Controle de status (ativo/inativo)
- ✅ Informações completas (altura, peso, data nascimento, nacionalidade)

### Gerenciamento de Blog
- 📝 Criar e editar posts
- 🏷️ Categorizar conteúdo
- 🖼️ Imagens destacadas
- 📊 Contagem de visualizações
- ⭐ Posts em destaque

### Interface
- 🌓 Modo claro/escuro
- 📱 Design responsivo
- 🎨 Interface moderna e intuitiva

## 🔒 Segurança

- Senhas armazenadas com `password_hash()`
- Proteção contra SQL Injection (prepared statements)
- Validação de sessão em todas as páginas
- Arquivo de credenciais fora do controle de versão

## 📞 Suporte

Para problemas ou dúvidas:
1. Verifique se as credenciais do banco estão corretas
2. Certifique-se de que as extensões PHP necessárias estão instaladas
3. Verifique os logs de erro do PHP

## 📝 Estrutura de Arquivos

```
admin/
├── config/
│   ├── database.php              # Classe de conexão
│   ├── db_credentials.php        # Credenciais (não commitado)
│   └── db_credentials.example.php # Template
├── auth/
│   ├── login.php                 # Página de login
│   ├── logout.php                # Logout
│   └── check_auth.php            # Middleware de autenticação
├── players/
│   ├── index.php                 # Lista de jogadores
│   └── form.php                  # Adicionar/editar jogador
├── posts/                        # (em desenvolvimento)
├── includes/
│   ├── header.php                # Cabeçalho do admin
│   └── sidebar.php               # Menu lateral
├── assets/
│   ├── css/admin.css             # Estilos do admin
│   └── js/admin.js               # JavaScript do admin
└── index.php                     # Dashboard
```
