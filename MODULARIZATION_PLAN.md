# 📋 PLANO DE MODULARIZAÇÃO - TEMPLATE ESPORTIVO

## 🎯 OBJETIVO

Transformar o site do Brasília Basquete em um **template modular e reutilizável** que possa ser facilmente adaptado para outros times esportivos, mantendo:
- ✅ Toda a funcionalidade existente
- ✅ Sistema de blog completo
- ✅ Painel administrativo
- ✅ Separação clara entre estrutura e conteúdo/tema

---

## 📊 ANÁLISE DA ARQUITETURA ATUAL

### Tecnologias Identificadas
- **Backend:** PHP 7.4+ + MySQL (PDO)
- **Frontend:** HTML5 + CSS3 Puro (1.871 linhas) + JavaScript Vanilla (692 linhas)
- **Autenticação:** Sessões PHP com password hashing
- **Banco de Dados:** 4 tabelas (users, players, posts, categories)
- **Temas:** Dark/Light mode com CSS Variables
- **Responsivo:** Mobile-first (3 breakpoints)

### Funcionalidades Principais
1. **Site Público:**
   - Hero monumental
   - Grid de patrocinadores
   - Carrossel infinito de jogadores (touch-enabled)
   - Timeline histórica
   - Sistema de recordes
   - Blog com categorias e filtros
   - Posts individuais com compartilhamento social
   - Dark/Light mode

2. **Painel Admin:**
   - CRUD de jogadores
   - CRUD de posts com WYSIWYG
   - Gerenciamento de categorias
   - Sistema de autenticação
   - Dashboard com estatísticas
   - Configurações de perfil

3. **Recursos Avançados:**
   - Intersection Observer para animações
   - Touch events para mobile
   - Auto-slug generator
   - Contador de visualizações
   - Posts relacionados
   - Meta tags Open Graph/Twitter Cards

---

## 🏗️ ESTRUTURA MODULAR PROPOSTA

### Nova Organização de Diretórios

```
site-template-esportivo/
│
├── 📁 template/                          # ESTRUTURA REUTILIZÁVEL (NÃO MODIFICAR)
│   │
│   ├── 📁 core/                          # Funcionalidades principais
│   │   ├── config/                       # Configurações do sistema
│   │   │   ├── Database.php              # Classe de conexão
│   │   │   ├── Config.php                # Gerenciador de configurações
│   │   │   └── schema.sql                # Schema do banco de dados
│   │   │
│   │   ├── models/                       # Modelos de dados
│   │   │   ├── Player.php                # Modelo de jogador
│   │   │   ├── Post.php                  # Modelo de post
│   │   │   ├── Category.php              # Modelo de categoria
│   │   │   └── User.php                  # Modelo de usuário
│   │   │
│   │   ├── controllers/                  # Lógica de negócio
│   │   │   ├── PlayerController.php
│   │   │   ├── PostController.php
│   │   │   └── AuthController.php
│   │   │
│   │   └── helpers/                      # Funções auxiliares
│   │       ├── functions.php             # Funções globais
│   │       ├── security.php              # XSS, CSRF, validações
│   │       └── slugify.php               # Geração de slugs
│   │
│   ├── 📁 components/                    # Componentes reutilizáveis
│   │   ├── public/                       # Componentes do site público
│   │   │   ├── Header.php
│   │   │   ├── Footer.php
│   │   │   ├── Hero.php
│   │   │   ├── PlayerCard.php
│   │   │   ├── PlayerCarousel.php
│   │   │   ├── PostCard.php
│   │   │   ├── Timeline.php
│   │   │   ├── RecordCard.php
│   │   │   ├── SponsorGrid.php
│   │   │   └── ThemeToggle.php
│   │   │
│   │   └── admin/                        # Componentes do admin
│   │       ├── AdminHeader.php
│   │       ├── AdminSidebar.php
│   │       ├── Breadcrumbs.php
│   │       ├── DataTable.php
│   │       └── FormFields.php
│   │
│   ├── 📁 pages/                         # Templates de páginas
│   │   ├── public/
│   │   │   ├── home.template.php
│   │   │   ├── blog.template.php
│   │   │   ├── post.template.php
│   │   │   └── legal.template.php        # Termos, Privacidade, etc
│   │   │
│   │   └── admin/
│   │       ├── dashboard.template.php
│   │       ├── players-list.template.php
│   │       ├── posts-list.template.php
│   │       └── form.template.php
│   │
│   ├── 📁 assets/                        # Assets do template
│   │   ├── css/
│   │   │   ├── base/                     # Estilos base
│   │   │   │   ├── reset.css
│   │   │   │   ├── variables.css         # CSS Variables base
│   │   │   │   ├── typography.css
│   │   │   │   └── utilities.css
│   │   │   │
│   │   │   ├── components/               # Estilos dos componentes
│   │   │   │   ├── header.css
│   │   │   │   ├── footer.css
│   │   │   │   ├── hero.css
│   │   │   │   ├── player-card.css
│   │   │   │   ├── carousel.css
│   │   │   │   ├── post-card.css
│   │   │   │   ├── timeline.css
│   │   │   │   ├── record-card.css
│   │   │   │   └── theme-toggle.css
│   │   │   │
│   │   │   ├── layouts/                  # Layouts de páginas
│   │   │   │   ├── home.css
│   │   │   │   ├── blog.css
│   │   │   │   └── post.css
│   │   │   │
│   │   │   └── admin/                    # Estilos do admin
│   │   │       ├── admin-base.css
│   │   │       ├── admin-components.css
│   │   │       └── admin-forms.css
│   │   │
│   │   └── js/
│   │       ├── core/
│   │       │   ├── ThemeManager.js       # Gerenciador de temas
│   │       │   └── Config.js             # Configurações JS
│   │       │
│   │       ├── components/
│   │       │   ├── Carousel.js           # Carrossel de jogadores
│   │       │   ├── MobileMenu.js         # Menu mobile
│   │       │   ├── ScrollAnimations.js   # Intersection Observer
│   │       │   └── SmoothScroll.js       # Scroll suave
│   │       │
│   │       ├── utils/
│   │       │   ├── slugify.js            # Geração de slugs
│   │       │   └── api.js                # Helper de API
│   │       │
│   │       └── admin/
│   │           ├── admin-main.js
│   │           └── wysiwyg.js            # Editor de texto
│   │
│   └── 📁 docs/                          # Documentação do template
│       ├── INSTALLATION.md               # Guia de instalação
│       ├── CONFIGURATION.md              # Guia de configuração
│       ├── CUSTOMIZATION.md              # Guia de customização
│       ├── COMPONENTS.md                 # Documentação dos componentes
│       └── DATABASE.md                   # Estrutura do banco
│
├── 📁 config/                            # CONFIGURAÇÕES PERSONALIZÁVEIS
│   ├── site.config.php                   # Configurações gerais do site
│   ├── theme.config.php                  # Configurações de tema
│   ├── database.config.php               # Credenciais do banco
│   └── features.config.php               # Ativar/desativar funcionalidades
│
├── 📁 content/                           # CONTEÚDO ESPECÍFICO DO SITE
│   ├── data/                             # Dados específicos
│   │   ├── team-info.json                # Informações do time
│   │   ├── sponsors.json                 # Patrocinadores
│   │   ├── records.json                  # Recordes históricos
│   │   └── timeline.json                 # Eventos da timeline
│   │
│   └── legal/                            # Textos legais
│       ├── termos.md
│       ├── privacidade.md
│       └── consentimento.md
│
├── 📁 themes/                            # TEMAS VISUAIS
│   ├── default/                          # Tema padrão (Brasília Basquete)
│   │   ├── theme.config.php              # Configurações do tema
│   │   ├── variables.css                 # CSS Variables personalizadas
│   │   ├── custom.css                    # CSS customizado
│   │   │
│   │   └── assets/                       # Assets do tema
│   │       ├── images/
│   │       │   ├── logos/
│   │       │   │   ├── team-logo.svg
│   │       │   │   └── sponsors/
│   │       │   │
│   │       │   ├── players/
│   │       │   ├── posts/
│   │       │   └── timeline/
│   │       │
│   │       └── fonts/                    # Fontes customizadas
│   │           ├── Bebas_Neue/
│   │           └── Rajdhani/
│   │
│   └── example-theme/                    # Tema de exemplo
│       ├── theme.config.php
│       ├── variables.css
│       └── assets/
│
├── 📁 public/                            # ARQUIVOS PÚBLICOS
│   ├── index.php                         # Home (usa template)
│   ├── blog.php                          # Blog (usa template)
│   ├── post.php                          # Post individual
│   ├── termos.php                        # Termos
│   ├── privacidade.php                   # Privacidade
│   ├── consentimento.php                 # Consentimento
│   │
│   ├── api/                              # Endpoints de API
│   │   ├── players.php
│   │   └── posts.php
│   │
│   └── uploads/                          # Uploads de usuários
│       ├── players/
│       ├── posts/
│       └── media/
│
├── 📁 admin/                             # PAINEL ADMINISTRATIVO
│   ├── index.php                         # Dashboard
│   │
│   ├── auth/
│   │   ├── login.php
│   │   ├── logout.php
│   │   └── check_auth.php
│   │
│   ├── players/
│   │   ├── index.php
│   │   └── form.php
│   │
│   ├── posts/
│   │   ├── index.php
│   │   └── form.php
│   │
│   ├── categories/
│   │   └── index.php
│   │
│   └── settings/
│       └── index.php
│
├── 📁 database/                          # MIGRATIONS E SEEDS
│   ├── migrations/
│   │   ├── 001_create_tables.sql
│   │   └── 002_add_indexes.sql
│   │
│   └── seeds/
│       ├── default_categories.sql
│       └── default_user.sql
│
├── 📄 .env.example                       # Exemplo de variáveis de ambiente
├── 📄 .gitignore
├── 📄 composer.json                      # Dependências PHP (futuro)
├── 📄 README.md                          # Documentação principal
└── 📄 CHANGELOG.md                       # Histórico de mudanças
```

---

## 🔧 SISTEMA DE CONFIGURAÇÃO

### 1. **config/site.config.php** - Configurações Gerais

```php
<?php
return [
    // Informações do Site
    'site' => [
        'name' => 'Caixa Brasília Basquete',
        'tagline' => 'MONUMENTAL!',
        'description' => 'Site oficial do time de basquete...',
        'url' => 'https://brasilia-basquete.com.br',
        'email' => 'contato@brasilia-basquete.com.br',
        'phone' => '+55 61 3XXX-XXXX',
    ],

    // Informações do Time
    'team' => [
        'name' => 'Brasília Basquete',
        'full_name' => 'Caixa Brasília Basquete',
        'sport' => 'Basketball',
        'founded' => '2007',
        'city' => 'Brasília',
        'state' => 'DF',
        'country' => 'Brasil',
        'stadium' => 'Ginásio Nilson Nelson',
    ],

    // Redes Sociais
    'social' => [
        'instagram' => 'https://instagram.com/brasiliabasquete',
        'facebook' => 'https://facebook.com/brasiliabasquete',
        'twitter' => 'https://twitter.com/brasiliabasquete',
        'youtube' => 'https://youtube.com/@brasiliabasquete',
        'tiktok' => 'https://tiktok.com/@brasiliabasquete',
    ],

    // SEO
    'seo' => [
        'meta_title' => 'Caixa Brasília Basquete - MONUMENTAL!',
        'meta_description' => 'Site oficial do Caixa Brasília Basquete...',
        'meta_keywords' => 'basquete, brasília, NBB, esporte',
        'og_image' => '/themes/default/assets/images/og-image.jpg',
    ],

    // Funcionalidades
    'features' => [
        'blog' => true,
        'players' => true,
        'timeline' => true,
        'records' => true,
        'sponsors' => true,
        'dark_mode' => true,
        'comments' => false, // Futuro
        'newsletter' => false, // Futuro
    ],

    // Blog
    'blog' => [
        'posts_per_page' => 9,
        'related_posts_count' => 3,
        'excerpt_length' => 150,
        'enable_views' => true,
        'enable_sharing' => true,
    ],

    // Carousel
    'carousel' => [
        'animation_duration' => 40, // segundos
        'cards_visible' => 3,
        'cards_visible_tablet' => 2,
        'cards_visible_mobile' => 1,
    ],
];
```

### 2. **config/theme.config.php** - Configurações de Tema

```php
<?php
return [
    // Tema Ativo
    'active_theme' => 'default',

    // Cores Principais
    'colors' => [
        'primary' => '#005CA9',      // Azul Brasília
        'secondary' => '#D17D00',    // Laranja
        'accent' => '#B8DDFF',       // Azul claro

        // Light Theme
        'light' => [
            'background' => '#FFFFFF',
            'surface' => '#F5F5F5',
            'text' => '#0A0A0A',
            'text_secondary' => '#4A4A4A',
        ],

        // Dark Theme
        'dark' => [
            'background' => '#0A0A0A',
            'surface' => '#1A1A1A',
            'text' => '#FFFFFF',
            'text_secondary' => '#CCCCCC',
        ],
    ],

    // Tipografia
    'typography' => [
        'font_heading' => 'Bebas Neue',
        'font_body' => 'Rajdhani',
        'font_source' => 'google', // google, local, cdn

        'sizes' => [
            'heading_1' => '4rem',
            'heading_2' => '3rem',
            'heading_3' => '2rem',
            'body' => '1rem',
            'small' => '0.875rem',
        ],
    ],

    // Espaçamentos
    'spacing' => [
        'xs' => '0.5rem',
        'sm' => '1rem',
        'md' => '1.5rem',
        'lg' => '2rem',
        'xl' => '3rem',
        'xxl' => '4rem',
    ],

    // Breakpoints
    'breakpoints' => [
        'mobile' => '480px',
        'tablet' => '768px',
        'desktop' => '1024px',
        'wide' => '1440px',
    ],

    // Animações
    'animations' => [
        'duration_fast' => '0.2s',
        'duration_normal' => '0.3s',
        'duration_slow' => '0.5s',
        'easing' => 'cubic-bezier(0.4, 0, 0.2, 1)',
    ],
];
```

### 3. **content/data/team-info.json** - Informações do Time

```json
{
  "team": {
    "name": "Brasília Basquete",
    "fullName": "Caixa Brasília Basquete",
    "nickname": "Monumental",
    "founded": "2007",
    "location": {
      "city": "Brasília",
      "state": "DF",
      "country": "Brasil"
    },
    "stadium": {
      "name": "Ginásio Nilson Nelson",
      "capacity": "14000",
      "address": "SRPN - Brasília, DF"
    }
  },

  "achievements": {
    "titles": [
      {
        "year": "2009/2010",
        "competition": "NBB",
        "description": "Primeiro título do Novo Basquete Brasil"
      },
      {
        "year": "2015/2016",
        "competition": "NBB",
        "description": "Bicampeonato Nacional"
      },
      {
        "year": "2018/2019",
        "competition": "NBB",
        "description": "Tricampeonato Nacional"
      }
    ]
  },

  "hero": {
    "title": "CAIXA BRASÍLIA BASQUETE",
    "subtitle": "MONUMENTAL!",
    "ctaText": "Conheça o Time",
    "ctaLink": "#elenco"
  }
}
```

### 4. **content/data/sponsors.json** - Patrocinadores

```json
{
  "sponsors": [
    {
      "id": 1,
      "name": "Caixa Econômica Federal",
      "logo": "/themes/default/assets/images/logos/sponsors/caixa.png",
      "url": "https://www.caixa.gov.br",
      "tier": "master"
    },
    {
      "id": 2,
      "name": "Governo do Distrito Federal",
      "logo": "/themes/default/assets/images/logos/sponsors/gdf.png",
      "url": "https://www.df.gov.br",
      "tier": "master"
    }
  ]
}
```

### 5. **content/data/records.json** - Recordes

```json
{
  "records": [
    {
      "id": 1,
      "title": "MAIOR PONTUADOR DA HISTÓRIA",
      "playerName": "Alex Garcia",
      "playerNumber": "#8",
      "stat": "4.532 pontos",
      "description": "Lenda do basquete brasileiro...",
      "image": "/themes/default/assets/images/players/alex-garcia.jpg"
    }
  ]
}
```

### 6. **content/data/timeline.json** - Timeline Histórica

```json
{
  "timeline": [
    {
      "year": "2009/2010",
      "title": "Primeiro Título do NBB",
      "description": "O Brasília Basquete conquistou seu primeiro título...",
      "image": "/themes/default/assets/images/timeline/2009-titulo.jpg",
      "type": "championship"
    }
  ]
}
```

---

## 📦 COMPONENTES REUTILIZÁVEIS

### Exemplo: **template/components/public/PlayerCard.php**

```php
<?php
class PlayerCard {
    public static function render($player, $config = []) {
        $defaults = [
            'show_link' => true,
            'lazy_load' => true,
            'fallback_number' => true,
        ];

        $config = array_merge($defaults, $config);

        $html = '';
        $html .= $config['show_link']
            ? '<a href="#" class="player-card" data-player="' . $player['id'] . '">'
            : '<div class="player-card">';

        $html .= '<div class="player-image">';
        $html .= '<img src="' . htmlspecialchars($player['photo']) . '" ';
        $html .= 'alt="' . htmlspecialchars($player['name']) . '" ';
        $html .= $config['lazy_load'] ? 'loading="lazy" ' : '';
        $html .= 'onerror="this.style.display=\'none\'; this.parentElement.classList.add(\'no-image\');">';

        if ($config['fallback_number']) {
            $html .= '<div class="player-image-fallback">';
            $html .= '<span class="player-number-large">#' . $player['number'] . '</span>';
            $html .= '</div>';
        }

        $html .= '</div>';
        $html .= '<div class="player-info">';
        $html .= '<div class="player-number">#' . $player['number'] . '</div>';
        $html .= '<h3 class="player-name">' . htmlspecialchars($player['name']) . '</h3>';
        $html .= '<p class="player-position">' . htmlspecialchars($player['position']) . '</p>';
        $html .= '</div>';

        $html .= $config['show_link'] ? '</a>' : '</div>';

        return $html;
    }
}
```

### Exemplo: **template/components/public/PostCard.php**

```php
<?php
class PostCard {
    public static function render($post, $config = []) {
        $defaults = [
            'show_excerpt' => true,
            'excerpt_length' => 150,
            'show_category' => true,
            'show_meta' => true,
            'lazy_load' => true,
        ];

        $config = array_merge($defaults, $config);

        $excerpt = $config['show_excerpt']
            ? self::truncate($post['excerpt'], $config['excerpt_length'])
            : '';

        ob_start();
        ?>
        <a href="post.php?slug=<?= htmlspecialchars($post['slug']) ?>" class="post-card">
            <div class="post-image">
                <img src="<?= htmlspecialchars($post['featured_image']) ?>"
                     alt="<?= htmlspecialchars($post['title']) ?>"
                     <?= $config['lazy_load'] ? 'loading="lazy"' : '' ?>>

                <?php if ($config['show_category'] && !empty($post['category_name'])): ?>
                    <span class="post-tag"><?= htmlspecialchars($post['category_name']) ?></span>
                <?php endif; ?>
            </div>

            <div class="post-content">
                <?php if ($config['show_meta']): ?>
                    <div class="post-meta">
                        <span><?= date('d M Y', strtotime($post['created_at'])) ?></span>
                    </div>
                <?php endif; ?>

                <h3 class="post-title"><?= htmlspecialchars($post['title']) ?></h3>

                <?php if ($excerpt): ?>
                    <p class="post-excerpt"><?= htmlspecialchars($excerpt) ?></p>
                <?php endif; ?>
            </div>
        </a>
        <?php
        return ob_get_clean();
    }

    private static function truncate($text, $length) {
        if (strlen($text) <= $length) return $text;
        return substr($text, 0, $length) . '...';
    }
}
```

---

## 🎨 SISTEMA DE TEMAS

### Carregamento Dinâmico de Temas

**template/core/config/Config.php:**

```php
<?php
class Config {
    private static $instance = null;
    private $config = [];
    private $theme = [];

    private function __construct() {
        $this->loadConfig();
        $this->loadTheme();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function loadConfig() {
        $this->config = require_once __DIR__ . '/../../../config/site.config.php';
    }

    private function loadTheme() {
        $activeTheme = $this->config['active_theme'] ?? 'default';
        $themePath = __DIR__ . '/../../../themes/' . $activeTheme . '/theme.config.php';

        if (file_exists($themePath)) {
            $this->theme = require_once $themePath;
        }
    }

    public function get($key, $default = null) {
        return $this->config[$key] ?? $default;
    }

    public function getTheme($key, $default = null) {
        return $this->theme[$key] ?? $default;
    }

    public function getThemeAsset($path) {
        $activeTheme = $this->get('active_theme', 'default');
        return "/themes/{$activeTheme}/assets/{$path}";
    }
}
```

### CSS Variables Dinâmicas

**template/assets/css/base/variables.css:**

```css
:root {
    /* Cores serão injetadas via PHP do theme.config.php */
    --primary: var(--theme-primary, #005CA9);
    --secondary: var(--theme-secondary, #D17D00);
    --accent: var(--theme-accent, #B8DDFF);

    /* Tipografia */
    --font-heading: var(--theme-font-heading, 'Bebas Neue');
    --font-body: var(--theme-font-body, 'Rajdhani');

    /* Espaçamentos */
    --spacing-xs: var(--theme-spacing-xs, 0.5rem);
    --spacing-sm: var(--theme-spacing-sm, 1rem);
    --spacing-md: var(--theme-spacing-md, 1.5rem);
    --spacing-lg: var(--theme-spacing-lg, 2rem);

    /* Cores de tema (light/dark) */
    --bg-primary: var(--theme-bg-primary, #FFFFFF);
    --bg-secondary: var(--theme-bg-secondary, #F5F5F5);
    --text-primary: var(--theme-text-primary, #0A0A0A);
    --text-secondary: var(--theme-text-secondary, #4A4A4A);
}

[data-theme="dark"] {
    --bg-primary: var(--theme-dark-bg-primary, #0A0A0A);
    --bg-secondary: var(--theme-dark-bg-secondary, #1A1A1A);
    --text-primary: var(--theme-dark-text-primary, #FFFFFF);
    --text-secondary: var(--theme-dark-text-secondary, #CCCCCC);
}
```

**Injeção via PHP (em `<head>`):**

```php
<?php
$config = Config::getInstance();
$colors = $config->getTheme('colors');
?>

<style id="theme-variables">
:root {
    --theme-primary: <?= $colors['primary'] ?>;
    --theme-secondary: <?= $colors['secondary'] ?>;
    --theme-accent: <?= $colors['accent'] ?>;

    /* Light Theme */
    --theme-bg-primary: <?= $colors['light']['background'] ?>;
    --theme-text-primary: <?= $colors['light']['text'] ?>;

    /* Dark Theme */
    --theme-dark-bg-primary: <?= $colors['dark']['background'] ?>;
    --theme-dark-text-primary: <?= $colors['dark']['text'] ?>;
}
</style>
```

---

## 🔄 MIGRAÇÃO DOS ARQUIVOS ATUAIS

### Fase 1: Criar Estrutura Base
1. ✅ Criar diretórios conforme estrutura proposta
2. ✅ Mover arquivos CSS para componentes separados
3. ✅ Extrair JavaScript em módulos
4. ✅ Criar classes Model para banco de dados

### Fase 2: Extrair Componentes
1. ✅ Transformar seções HTML em componentes PHP
2. ✅ Criar componentes reutilizáveis (PlayerCard, PostCard, etc)
3. ✅ Separar lógica de apresentação
4. ✅ Adicionar configurabilidade aos componentes

### Fase 3: Criar Sistema de Configuração
1. ✅ Criar arquivos de configuração (site, theme, features)
2. ✅ Implementar classe Config para gerenciar configurações
3. ✅ Implementar injeção de CSS Variables via PHP
4. ✅ Extrair dados específicos para JSON (sponsors, records, timeline)

### Fase 4: Implementar Sistema de Temas
1. ✅ Criar estrutura de temas
2. ✅ Mover assets específicos do Brasília para `themes/default/`
3. ✅ Criar tema de exemplo (`themes/example-theme/`)
4. ✅ Documentar customização de temas

### Fase 5: Refatorar Banco de Dados
1. ✅ Criar migrations SQL
2. ✅ Criar seeds com dados padrão
3. ✅ Implementar Models (Player, Post, Category, User)
4. ✅ Implementar Controllers

### Fase 6: Documentação
1. ✅ README.md principal
2. ✅ Guia de instalação
3. ✅ Guia de configuração
4. ✅ Guia de customização
5. ✅ Documentação de componentes
6. ✅ Documentação do banco de dados

---

## 📝 DOCUMENTAÇÃO PROPOSTA

### README.md Principal

```markdown
# 🏀 Template Esportivo Modular

Template profissional para sites de times esportivos com CMS administrativo completo.

## ✨ Características

- ✅ **Totalmente Modular** - Separa estrutura, conteúdo e tema
- ✅ **Sistema de Blog** - Posts, categorias, filtros, busca
- ✅ **Painel Admin** - CRUD completo de jogadores, posts e categorias
- ✅ **Carrossel Touch** - Navegação swipe para jogadores
- ✅ **Dark/Light Mode** - Alternância de temas com persistência
- ✅ **100% Responsivo** - Mobile-first design
- ✅ **SEO Otimizado** - Meta tags, Open Graph, Twitter Cards
- ✅ **Zero Frameworks** - HTML5 + CSS3 + JavaScript Vanilla
- ✅ **Fácil Customização** - Arquivos de configuração simples

## 🚀 Instalação Rápida

1. Clone o repositório
2. Configure o banco de dados
3. Personalize o tema
4. Pronto para usar!

[Ver guia completo de instalação →](template/docs/INSTALLATION.md)

## 📖 Documentação

- [Instalação](template/docs/INSTALLATION.md)
- [Configuração](template/docs/CONFIGURATION.md)
- [Customização](template/docs/CUSTOMIZATION.md)
- [Componentes](template/docs/COMPONENTS.md)
- [Banco de Dados](template/docs/DATABASE.md)

## 🎨 Exemplos de Uso

Este template foi criado originalmente para o **Caixa Brasília Basquete** e pode ser facilmente adaptado para:

- Times de basquete
- Times de futebol
- Times de vôlei
- Qualquer esporte coletivo
- Clubes esportivos

## 🛠️ Tecnologias

- PHP 7.4+
- MySQL 5.7+
- HTML5 + CSS3
- JavaScript ES6+

## 📄 Licença

MIT License - Livre para uso comercial e pessoal
```

---

## ✅ CHECKLIST DE IMPLEMENTAÇÃO

### Estrutura
- [ ] Criar nova estrutura de diretórios
- [ ] Mover arquivos CSS para componentes separados
- [ ] Mover JavaScript para módulos
- [ ] Criar arquivos de configuração

### Componentes PHP
- [ ] Header.php
- [ ] Footer.php
- [ ] Hero.php
- [ ] PlayerCard.php
- [ ] PlayerCarousel.php
- [ ] PostCard.php
- [ ] Timeline.php
- [ ] RecordCard.php
- [ ] SponsorGrid.php

### Sistema de Configuração
- [ ] site.config.php
- [ ] theme.config.php
- [ ] database.config.php
- [ ] features.config.php
- [ ] Config.php (classe gerenciadora)

### Dados Extraídos
- [ ] team-info.json
- [ ] sponsors.json
- [ ] records.json
- [ ] timeline.json

### Banco de Dados
- [ ] Migrations SQL
- [ ] Seeds SQL
- [ ] Models (Player, Post, Category, User)
- [ ] Controllers

### Temas
- [ ] Estrutura de temas
- [ ] Tema default (Brasília Basquete)
- [ ] Tema de exemplo
- [ ] CSS Variables dinâmicas

### Documentação
- [ ] README.md
- [ ] INSTALLATION.md
- [ ] CONFIGURATION.md
- [ ] CUSTOMIZATION.md
- [ ] COMPONENTS.md
- [ ] DATABASE.md

### Testes
- [ ] Testar instalação do zero
- [ ] Testar troca de temas
- [ ] Testar customização de cores
- [ ] Testar responsividade
- [ ] Testar painel admin

---

## 🎯 RESULTADO ESPERADO

### Facilidade de Uso

**Para criar um novo site:**
1. Copiar o template
2. Editar `config/site.config.php` (nome do time, cores, etc)
3. Editar `content/data/*.json` (patrocinadores, recordes, timeline)
4. Substituir imagens em `themes/default/assets/images/`
5. Deploy!

**Para customizar o tema:**
1. Duplicar `themes/default/` → `themes/meu-tema/`
2. Editar `themes/meu-tema/theme.config.php` (cores, fontes)
3. Editar `themes/meu-tema/variables.css` (ajustes finos)
4. Alterar `config/site.config.php`: `'active_theme' => 'meu-tema'`

### Manutenibilidade

- ✅ Código organizado e documentado
- ✅ Componentes isolados e testáveis
- ✅ Fácil adicionar novas funcionalidades
- ✅ Fácil atualizar o template core sem afetar customizações

### Escalabilidade

- ✅ Preparado para futuros recursos (comentários, newsletter, etc)
- ✅ Estrutura permite migração para frameworks (Laravel, Symfony)
- ✅ Permite adicionar API REST completa
- ✅ Permite adicionar PWA

---

## 📊 PRÓXIMOS PASSOS

1. **Aprovação do Plano** - Validar estrutura proposta
2. **Implementação Fase 1** - Criar estrutura base e mover CSS/JS
3. **Implementação Fase 2** - Extrair componentes PHP
4. **Implementação Fase 3** - Sistema de configuração
5. **Implementação Fase 4** - Sistema de temas
6. **Implementação Fase 5** - Refatoração do banco
7. **Implementação Fase 6** - Documentação completa
8. **Testes e Validação** - Garantir tudo funcionando
9. **Deploy** - Commit e push para o repositório

---

## 💡 OBSERVAÇÕES IMPORTANTES

### O que será MANTIDO
- ✅ Toda funcionalidade existente
- ✅ Sistema de blog completo
- ✅ Painel administrativo
- ✅ Design responsivo
- ✅ Dark/Light mode
- ✅ Performance (lazy load, animações, etc)

### O que será MELHORADO
- ✨ Organização do código
- ✨ Separação de responsabilidades
- ✨ Reutilização de componentes
- ✨ Facilidade de customização
- ✨ Documentação

### O que será ADICIONADO
- ➕ Sistema de configuração
- ➕ Sistema de temas
- ➕ Estrutura modular
- ➕ Models e Controllers
- ➕ Documentação completa
- ➕ Exemplos de uso

---

**Este plano está pronto para ser executado. Aguardando aprovação para iniciar a implementação! 🚀**
