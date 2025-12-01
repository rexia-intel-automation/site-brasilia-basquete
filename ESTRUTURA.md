# 📁 Estrutura Completa do Site - Brasília Basquete

Este documento detalha a organização de todos os arquivos e pastas do projeto.

---

## 📊 Visão Geral

```
site-brasilia-basquete/
├── admin/              # Painel administrativo (backend)
├── assets/             # Recursos do site público (frontend)
├── index.php           # Página inicial do site
├── blog.php            # Página do blog
└── README.md           # Documentação principal
```

---

## 🎨 Site Público (Frontend)

### Arquivos Principais

```
/
├── index.php           # Página inicial
│   ├── Hero section com apresentação
│   ├── Seção de patrocinadores
│   ├── Carrossel do elenco
│   ├── Recordes do clube
│   └── História do Brasília Basquete
│
├── blog.php            # Blog de notícias
│   ├── Post em destaque
│   ├── Filtros por categoria
│   ├── Grid de posts
│   └── Sistema de busca
│
└── estrutura.txt       # Especificações originais do site
```

### Assets (Recursos)

```
assets/
├── css/
│   └── styles.css      # Estilos principais (1450 linhas)
│       ├── CSS Variables para temas
│       ├── Dark/Light mode
│       ├── Componentes responsivos
│       ├── Animações e transições
│       └── Media queries para mobile
│
├── js/
│   └── main.js         # JavaScript principal (342 linhas)
│       ├── ThemeManager class
│       ├── Navbar scroll effects
│       ├── Carousel de jogadores
│       ├── Smooth scrolling
│       ├── Blog filters
│       └── Intersection Observer
│
└── images/
    └── logo.png        # Logo do clube
```

---

## 👨‍💼 Painel Administrativo (Backend)

### Estrutura Geral

```
admin/
├── auth/               # Sistema de autenticação
├── config/             # Configurações e database
├── includes/           # Componentes compartilhados
├── players/            # Gerenciamento de jogadores
├── posts/              # Gerenciamento de posts
├── categories/         # Gerenciamento de categorias
├── media/              # Galeria de mídia
├── settings/           # Configurações do sistema
├── uploads/            # Pasta para uploads
├── assets/             # CSS e JS do admin
├── index.php           # Dashboard principal
└── README.md           # Documentação técnica
```

---

## 🔐 Sistema de Autenticação

```
admin/auth/
├── login.php           # Página de login
│   ├── Formulário de autenticação
│   ├── Validação de credenciais
│   ├── Criação de sessão
│   └── Redirecionamento pós-login
│
├── logout.php          # Encerrar sessão
│   ├── Destruir sessão
│   └── Redirect para login
│
└── check_auth.php      # Middleware de autenticação
    ├── Verificar se está logado
    ├── Validar sessão ativa
    └── Redirecionar se não autenticado
```

**Credenciais Padrão:**
- Usuário: `admin`
- Senha: `admin123`

---

## ⚙️ Configuração e Banco de Dados

```
admin/config/
├── database.php                # Classe de conexão
│   ├── Conexão PDO com MySQL
│   ├── Criação automática de tabelas
│   ├── Inserção de dados padrão
│   └── Helper function getDB()
│
├── db_credentials.php          # Credenciais do banco (não commitado)
│   ├── Host
│   ├── Database name
│   ├── Username
│   └── Password
│
└── db_credentials.example.php  # Template de credenciais
    └── Exemplo para referência
```

### Tabelas do Banco de Dados

**1. users** - Usuários do admin
```sql
- id (INT AUTO_INCREMENT)
- username (VARCHAR 50, UNIQUE)
- password (VARCHAR 255, hash)
- email (VARCHAR 100)
- created_at (DATETIME)
```

**2. players** - Jogadores do elenco
```sql
- id (INT AUTO_INCREMENT)
- number (INT)
- name (VARCHAR 100)
- position (VARCHAR 50)
- photo (TEXT, URL)
- height (VARCHAR 20)
- weight (VARCHAR 20)
- birth_date (DATE)
- nationality (VARCHAR 50)
- active (TINYINT)
- created_at (DATETIME)
- updated_at (DATETIME)
```

**3. categories** - Categorias do blog
```sql
- id (INT AUTO_INCREMENT)
- name (VARCHAR 100, UNIQUE)
- slug (VARCHAR 100, UNIQUE)
- created_at (DATETIME)
```

**Categorias Padrão:**
- Notícias
- Bastidores
- Entrevistas
- Jogos
- Elenco
- História

**4. posts** - Posts do blog
```sql
- id (INT AUTO_INCREMENT)
- title (VARCHAR 255)
- slug (VARCHAR 255, UNIQUE)
- excerpt (TEXT)
- content (LONGTEXT)
- featured_image (TEXT, URL)
- category_id (INT, FK)
- author_id (INT, FK)
- is_featured (TINYINT)
- published (TINYINT)
- views (INT)
- created_at (DATETIME)
- updated_at (DATETIME)
```

---

## 🧩 Componentes Compartilhados

```
admin/includes/
├── header.php          # Cabeçalho do admin
│   ├── Logo e título
│   ├── Toggle de tema (dark/light)
│   ├── Dropdown do usuário
│   ├── Link para perfil
│   ├── Link para configurações
│   └── Botão de logout
│
└── sidebar.php         # Menu lateral de navegação
    ├── Logo
    ├── Dashboard
    ├── Seção "Conteúdo"
    │   ├── Jogadores
    │   ├── Posts
    │   └── Categorias
    ├── Seção "Mídia"
    │   └── Galeria
    └── Seção "Configurações"
        └── Configurações
```

---

## 👥 Gerenciamento de Jogadores

```
admin/players/
├── index.php           # Lista de jogadores
│   ├── Tabela com todos os jogadores
│   ├── Filtros de busca
│   ├── Status (ativo/inativo)
│   ├── Botão "Novo Jogador"
│   ├── Ações: Editar, Excluir
│   └── Confirmação de exclusão
│
└── form.php            # Formulário add/edit
    ├── Campos:
    │   ├── Número da camisa *
    │   ├── Nome completo *
    │   ├── Posição *
    │   ├── URL da foto
    │   ├── Altura
    │   ├── Peso
    │   ├── Data de nascimento
    │   ├── Nacionalidade
    │   └── Status (ativo/inativo)
    ├── Validação de dados
    ├── Insert/Update no banco
    └── Redirect após salvar
```

**Posições Disponíveis:**
- Armador
- Ala-Armador
- Ala
- Ala-Pivô
- Pivô

---

## 📝 Gerenciamento de Posts

```
admin/posts/
├── index.php           # Lista de posts
│   ├── Tabela de posts
│   ├── Filtros:
│   │   ├── Busca por texto
│   │   ├── Por categoria
│   │   └── Por status (publicado/rascunho)
│   ├── Colunas:
│   │   ├── Título (+ badge destaque)
│   │   ├── Categoria
│   │   ├── Autor
│   │   ├── Status
│   │   ├── Visualizações
│   │   └── Data
│   ├── Botão "Novo Post"
│   └── Ações: Editar, Excluir
│
└── form.php            # Formulário add/edit
    ├── Layout em 2 colunas
    ├── Coluna Principal:
    │   ├── Título *
    │   ├── Slug (gerado automaticamente)
    │   ├── Resumo (500 caracteres)
    │   └── Conteúdo * (HTML aceito)
    ├── Sidebar:
    │   ├── Card "Publicação"
    │   │   ├── Checkbox: Publicar
    │   │   ├── Checkbox: Destaque
    │   │   └── Botão: Salvar/Publicar
    │   ├── Card "Categoria"
    │   │   └── Select de categorias
    │   ├── Card "Imagem Destacada"
    │   │   ├── URL da imagem
    │   │   └── Preview
    │   └── Card "Informações" (se editando)
    │       ├── Data de criação
    │       ├── Última atualização
    │       └── Total de visualizações
    └── JavaScript: Auto-geração de slug
```

---

## 🏷️ Gerenciamento de Categorias

```
admin/categories/
└── index.php           # Lista e formulário
    ├── Layout em 2 colunas
    ├── Coluna Esquerda:
    │   ├── Formulário inline
    │   ├── Campo: Nome *
    │   ├── Campo: Slug (auto-gerado)
    │   ├── Botão: Criar/Atualizar
    │   └── Botão: Cancelar (ao editar)
    ├── Coluna Direita:
    │   ├── Tabela de categorias
    │   ├── Colunas:
    │   │   ├── Nome
    │   │   ├── Slug
    │   │   └── Nº de posts
    │   └── Ações:
    │       ├── Editar (preenche formulário)
    │       └── Excluir (só se sem posts)
    └── Validação: Não permite excluir com posts
```

---

## 🖼️ Galeria de Mídia

```
admin/media/
└── index.php           # Página informativa
    ├── Status: Em desenvolvimento
    ├── Alternativas sugeridas:
    │   ├── Serviços externos:
    │   │   ├── Imgur.com
    │   │   ├── ImgBB.com
    │   │   └── Postimages.org
    │   └── Upload via FTP/cPanel
    ├── Instruções detalhadas
    └── Link para manual
```

---

## ⚙️ Configurações do Sistema

```
admin/settings/
└── index.php           # Configurações gerais
    ├── Layout em 2 colunas
    ├── Coluna Principal:
    │   ├── Card "Informações do Perfil"
    │   │   ├── Nome de usuário *
    │   │   ├── Email
    │   │   ├── Membro desde (readonly)
    │   │   └── Botão: Atualizar Perfil
    │   └── Card "Alterar Senha"
    │       ├── Senha atual *
    │       ├── Nova senha * (mín. 6 caracteres)
    │       ├── Confirmar senha *
    │       └── Botão: Alterar Senha
    ├── Coluna Lateral:
    │   ├── Card "Estatísticas"
    │   │   ├── Total de usuários
    │   │   ├── Total de jogadores
    │   │   ├── Total de posts
    │   │   └── Total de categorias
    │   ├── Card "Informações do Sistema"
    │   │   ├── Versão do PHP
    │   │   ├── Versão do MySQL
    │   │   ├── Servidor web
    │   │   └── Versão do painel (1.0.0)
    │   └── Card "Ações Rápidas"
    │       ├── Ir para Dashboard
    │       ├── Ver Site Público
    │       └── Sair do Sistema
    └── Validações de senha e unicidade
```

---

## 🎨 Assets do Admin

```
admin/assets/
├── css/
│   └── admin.css       # Estilos do painel
│       ├── CSS Variables (cores, espaçamentos)
│       ├── Dark/Light theme
│       ├── Layout: sidebar + main content
│       ├── Components:
│       │   ├── Cards
│       │   ├── Tables
│       │   ├── Forms
│       │   ├── Buttons
│       │   ├── Badges
│       │   ├── Alerts
│       │   └── Stats cards
│       ├── Responsive design
│       └── Mobile sidebar (toggle)
│
├── js/
│   └── admin.js        # JavaScript do painel
│       ├── Theme management
│       │   ├── Salvar preferência
│       │   ├── Toggle dark/light
│       │   └── Aplicar ao carregar
│       ├── Sidebar toggle (mobile)
│       └── Auto-hide alerts
│
└── images/
    └── (logos, ícones se necessário)
```

---

## 📂 Uploads e Mídia

```
admin/uploads/
└── .gitkeep            # Mantém pasta no Git
    # Esta pasta é para:
    # - Uploads futuros de imagens
    # - Arquivos de mídia
    # - Temporários
```

---

## 📋 Dashboard Principal

```
admin/index.php
├── Cabeçalho
│   └── "Bem-vindo, [usuário]!"
├── Cards de Estatísticas
│   ├── Jogadores Ativos
│   ├── Posts Publicados
│   ├── Categorias
│   └── Total de Visualizações
└── Conteúdo Recente (2 colunas)
    ├── Posts Recentes
    │   ├── Últimos 5 posts
    │   ├── Título + badge destaque
    │   ├── Categoria
    │   ├── Status
    │   └── Data
    └── Jogadores Recentes
        ├── Últimos 5 jogadores
        ├── Número da camisa
        ├── Nome
        ├── Posição
        └── Status
```

---

## 📚 Documentação

```
/
├── README.md           # Visão geral do projeto
├── ESTRUTURA.md        # Este arquivo (estrutura completa)
└── .gitignore          # Arquivos ignorados pelo Git

admin/
├── README.md           # Visão geral técnica do admin
├── MANUAL.md           # Manual completo para iniciantes
│   ├── Introdução
│   ├── Configuração inicial detalhada
│   ├── Primeiro acesso
│   ├── Navegação no painel
│   ├── Gerenciar jogadores (tutorial completo)
│   ├── Gerenciar posts (tutorial completo)
│   ├── Categorias
│   ├── Solução de problemas
│   ├── Perguntas frequentes
│   └── Checklist de configuração
│
├── GUIA-RAPIDO.md      # Referência rápida
│   ├── Acesso rápido e credenciais
│   ├── Ações mais comuns
│   ├── Configuração resumida
│   ├── Como adicionar imagens
│   ├── Campos obrigatórios
│   ├── Problemas comuns (versão curta)
│   ├── Boas práticas
│   ├── Checklists diário/semanal
│   └── Recursos úteis
│
└── TROUBLESHOOTING.md  # Solução de problemas
    ├── Problemas de conexão (5 cenários)
    ├── Problemas de login (3 soluções)
    ├── Problemas com imagens (4 casos)
    ├── Problemas com posts (4 casos)
    ├── Problemas de visualização (3 casos)
    ├── Problemas de performance
    ├── Erros PHP comuns
    ├── Recuperação de emergência
    ├── Script de backup automático
    └── Checklist de diagnóstico
```

---

## 🔒 Arquivos de Segurança

```
.gitignore
├── admin/config/db_credentials.php  # Credenciais (NUNCA commitar)
├── admin/data/*.db                  # Databases SQLite antigos
├── *.log                            # Logs de erro
├── uploads/*                        # Arquivos enviados
├── .DS_Store                        # Arquivos do macOS
└── IDE files (.vscode, .idea, etc)
```

---

## 🎯 Funcionalidades Implementadas

### ✅ Site Público
- [x] Página inicial responsiva
- [x] Blog com sistema de categorias
- [x] Dark/Light mode com persistência
- [x] Floating theme toggle
- [x] SVG icons (sem emojis)
- [x] Smooth scrolling
- [x] Carrossel de jogadores
- [x] Filtros de posts por categoria
- [x] Design mobile-first

### ✅ Painel Admin
- [x] Sistema de autenticação completo
- [x] Dashboard com estatísticas
- [x] CRUD completo de jogadores
- [x] CRUD completo de posts
- [x] CRUD completo de categorias
- [x] Gerenciamento de perfil
- [x] Alteração de senha
- [x] Dark/Light mode no admin
- [x] Design responsivo
- [x] Validação de formulários
- [x] Mensagens de feedback
- [x] Confirmação de exclusões

### ✅ Banco de Dados
- [x] Migração de SQLite para MySQL
- [x] Criação automática de tabelas
- [x] Dados padrão (admin, categorias)
- [x] Foreign keys
- [x] Índices otimizados
- [x] Charset UTF-8

### ✅ Documentação
- [x] Manual completo para iniciantes
- [x] Guia rápido de referência
- [x] Troubleshooting detalhado
- [x] README técnico
- [x] Estrutura completa do projeto
- [x] Instruções de segurança
- [x] Exemplos práticos

---

## 🚧 Funcionalidades Planejadas (Futuro)

### 📋 Backlog
- [ ] Sistema de upload direto de imagens
- [ ] Galeria de mídia funcional
- [ ] Editor WYSIWYG para posts
- [ ] Comentários nos posts
- [ ] Sistema de usuários múltiplos
- [ ] Permissões e roles
- [ ] Agendamento de posts
- [ ] Tags para posts
- [ ] Busca avançada
- [ ] Analytics integrado
- [ ] Export/import de dados
- [ ] API REST
- [ ] Multi-idioma

---

## 🔗 Dependências

### Backend (PHP)
- **PHP:** 7.4+
- **Extensões:**
  - PDO
  - pdo_mysql
  - mbstring
  - session

### Banco de Dados
- **MySQL:** 5.7+
- **Charset:** utf8mb4
- **Engine:** InnoDB

### Frontend
- **Fonts:**
  - Bebas Neue (Google Fonts)
  - Rajdhani (Google Fonts)
- **Icons:**
  - SVG inline (Lucide Icons style)

### Servidor
- **Apache/Nginx** com mod_rewrite
- **HTTPS** recomendado

---

## 📝 Padrões de Código

### PHP
```php
// Classes: PascalCase
class Database { }

// Funções: camelCase
function getDB() { }

// Variáveis: snake_case
$db_connection = null;

// Constantes: UPPER_CASE
define('DB_HOST', 'localhost');
```

### CSS
```css
/* BEM Methodology */
.card { }
.card__header { }
.card--primary { }

/* CSS Variables */
:root {
  --primary-color: #E85D04;
}
```

### JavaScript
```javascript
// Classes: PascalCase
class ThemeManager { }

// Funções: camelCase
function toggleTheme() { }

// Variáveis: camelCase
const currentTheme = 'dark';
```

---

## 🎨 Cores do Tema

### Modo Claro
```css
--bg-primary: #FFFFFF
--bg-secondary: #F5F5F5
--text-primary: #0A0A0A
--text-secondary: #4A4A4A
--primary-color: #E85D04
--secondary-color: #DC2F02
```

### Modo Escuro
```css
--bg-primary: #0A0A0A
--bg-secondary: #1A1A1A
--text-primary: #FFFFFF
--text-secondary: #B0B0B0
--primary-color: #FF6B00
--secondary-color: #FF4500
```

---

## 📊 Métricas do Projeto

- **Total de arquivos PHP:** 15+
- **Linhas de código CSS:** ~2500
- **Linhas de código JS:** ~500
- **Linhas de código PHP:** ~3000
- **Linhas de documentação:** ~4500
- **Tabelas no banco:** 4
- **Páginas admin:** 8
- **Páginas públicas:** 2

---

## 🔐 Checklist de Segurança

- [x] Senhas hash com `password_hash()`
- [x] Prepared statements (SQL Injection)
- [x] `htmlspecialchars()` em outputs (XSS)
- [x] Validação de sessão
- [x] Credenciais fora do Git
- [x] `.gitignore` configurado
- [x] Validação de inputs
- [x] Confirmação de exclusões
- [x] CSRF tokens (recomendado adicionar)
- [ ] Rate limiting (recomendado)
- [ ] 2FA (futuro)

---

## 📞 Suporte e Contato

Para dúvidas ou problemas:
1. Consulte a [documentação completa](admin/MANUAL.md)
2. Veja o [troubleshooting](admin/TROUBLESHOOTING.md)
3. Use o [guia rápido](admin/GUIA-RAPIDO.md)

---

**Última atualização:** 2025-12-01
**Versão:** 1.0.0
**Mantido por:** Claude AI Assistant
