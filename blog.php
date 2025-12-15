<?php
require_once 'admin/config/database.php';

$db = getDB();

// Get filter parameters
$filter_category = $_GET['category'] ?? '';

// Get categories for filters
$categories = $db->query("SELECT * FROM categories ORDER BY name")->fetchAll();

// Get featured post
$featured_query = "
    SELECT p.*, c.name as category_name
    FROM posts p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.published = 1 AND p.is_featured = 1
    ORDER BY p.created_at DESC
    LIMIT 1
";
$stmt = $db->query($featured_query);
$featured_post = $stmt->fetch();

// Get regular posts (excluding featured)
$where_conditions = ["p.published = 1"];
$params = [];

if ($filter_category) {
    $where_conditions[] = "p.category_id = ?";
    $params[] = $filter_category;
}

if ($featured_post) {
    $where_conditions[] = "p.id != ?";
    $params[] = $featured_post['id'];
}

$where_clause = "WHERE " . implode(" AND ", $where_conditions);

$posts_query = "
    SELECT p.*, c.name as category_name
    FROM posts p
    LEFT JOIN categories c ON p.category_id = c.id
    $where_clause
    ORDER BY p.created_at DESC
    LIMIT 9
";

$stmt = $db->prepare($posts_query);
$stmt->execute($params);
$posts = $stmt->fetchAll();

// Helper function to format date
function formatPostDate($date) {
    $timestamp = strtotime($date);
    return date('d M Y', $timestamp);
}

// Helper function to truncate excerpt
function truncateExcerpt($text, $length = 150) {
    if (strlen($text) <= $length) return $text;
    return substr($text, 0, $length) . '...';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canal do Time - Caixa Brasília Basquete</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- CHAT BUTTON (Floating) -->
    <a href="https://primary-production-55af6.up.railway.app/webhook/532cd781-988a-45b3-a190-fd18a6c999e5/chat" class="chat-button" aria-label="Chat" onclick="event.preventDefault(); window.open(this.href, 'ChatPopup', 'width=400,height=600,resizable=yes,scrollbars=yes'); return false;">
        <img src="https://i.imgur.com/bgExqAD.png" alt="Chat">
    </a>

    <!-- THEME TOGGLE (Floating Button) -->
    <button class="theme-toggle" id="themeToggle" aria-label="Alternar modo claro/escuro">
        <svg class="theme-icon sun" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="4"/>
            <path d="M12 2v2"/>
            <path d="M12 20v2"/>
            <path d="m4.93 4.93 1.41 1.41"/>
            <path d="m17.66 17.66 1.41 1.41"/>
            <path d="M2 12h2"/>
            <path d="M20 12h2"/>
            <path d="m6.34 17.66-1.41 1.41"/>
            <path d="m19.07 4.93-1.41 1.41"/>
        </svg>
        <svg class="theme-icon moon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
        </svg>
    </button>

    <!-- NAVIGATION -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <ul class="nav-links left">
                <li><a href="index.php#inicio">Início</a></li>
                <li><a href="index.php#elenco">Elenco</a></li>
                <li><a href="index.php#recordes">Recordes</a></li>
            </ul>

            <div class="logo-container">
                <a href="index.php">
                    <img src="https://i.imgur.com/bgExqAD.png" alt="Brasília Basquete" class="logo">
                </a>
            </div>

            <ul class="nav-links right">
                <li><a href="index.php#história">História</a></li>
                <li><a href="blog.php" class="active">Canal do Time</a></li>
                <li class="social-links">
                    <a href="https://www.instagram.com/brasilia.basquete/" target="_blank" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                        </svg>
                    </a>
                    <a href="https://www.tiktok.com/@brasilia.basquete" target="_blank" aria-label="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/@CaixaBrasiliaBasquete" target="_blank" aria-label="YouTube">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/>
                            <path d="m10 15 5-3-5-3z"/>
                        </svg>
                    </a>
                    <a href="https://x.com/brasiliabasquet" target="_blank" aria-label="X/Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4l11.733 16h4.267l-11.733 -16z"/>
                            <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/>
                        </svg>
                    </a>
                </li>
            </ul>

            <div class="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- BLOG HERO -->
    <section class="blog-hero">
        <div class="blog-hero-content">
            <h1 class="blog-title">Canal do Time</h1>
            <p class="blog-subtitle">Notícias, bastidores e conteúdo exclusivo</p>
        </div>
    </section>

    <!-- FILTERS -->
    <section class="blog-filters">
        <div class="filters-container">
            <a href="blog.php" class="filter-btn <?php echo empty($filter_category) ? 'active' : ''; ?>">Todas</a>
            <?php foreach ($categories as $cat): ?>
                <a href="blog.php?category=<?php echo $cat['id']; ?>"
                   class="filter-btn <?php echo $filter_category == $cat['id'] ? 'active' : ''; ?>">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- FEATURED POST -->
    <?php if ($featured_post): ?>
    <section class="featured-section">
        <div class="featured-container">
            <div class="section-label">Destaque</div>
            <article class="featured-post">
                <div class="featured-image">
                    <?php if (!empty($featured_post['featured_image'])): ?>
                        <img src="<?php echo htmlspecialchars($featured_post['featured_image']); ?>"
                             alt="<?php echo htmlspecialchars($featured_post['title']); ?>"
                             loading="eager">
                    <?php else: ?>
                        <img src="https://i.imgur.com/bgExqAD.png"
                             alt="<?php echo htmlspecialchars($featured_post['title']); ?>"
                             loading="eager">
                    <?php endif; ?>
                    <span class="featured-tag">Destaque</span>
                </div>
                <div class="featured-content">
                    <div class="featured-meta">
                        <span><?php echo formatPostDate($featured_post['created_at']); ?></span>
                        <span><?php echo htmlspecialchars($featured_post['category_name'] ?? 'Sem categoria'); ?></span>
                    </div>
                    <h2 class="featured-title"><?php echo htmlspecialchars($featured_post['title']); ?></h2>
                    <p class="featured-excerpt">
                        <?php echo htmlspecialchars($featured_post['excerpt'] ?? truncateExcerpt(strip_tags($featured_post['content']), 200)); ?>
                    </p>
                    <a href="post.php?slug=<?php echo urlencode($featured_post['slug']); ?>" class="read-more">
                        Leia Mais
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                            <path d="m12 5 7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
        </div>
    </section>
    <?php endif; ?>

    <!-- POSTS GRID -->
    <section class="posts-section">
        <div class="posts-container">
            <div class="section-label">Últimas Notícias</div>
            <div class="posts-grid">
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <a href="post.php?slug=<?php echo urlencode($post['slug']); ?>" class="post-card">
                            <div class="post-image">
                                <?php if (!empty($post['featured_image'])): ?>
                                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>"
                                         alt="<?php echo htmlspecialchars($post['title']); ?>"
                                         loading="lazy">
                                <?php else: ?>
                                    <img src="https://i.imgur.com/bgExqAD.png"
                                         alt="<?php echo htmlspecialchars($post['title']); ?>"
                                         loading="lazy">
                                <?php endif; ?>
                                <span class="post-tag"><?php echo htmlspecialchars($post['category_name'] ?? 'Geral'); ?></span>
                            </div>
                            <div class="post-content">
                                <div class="post-meta">
                                    <span><?php echo formatPostDate($post['created_at']); ?></span>
                                </div>
                                <h3 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                                <p class="post-excerpt">
                                    <?php echo htmlspecialchars($post['excerpt'] ?? truncateExcerpt(strip_tags($post['content']))); ?>
                                </p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                        <p style="opacity: 0.7; font-size: 1.1rem;">Nenhum post encontrado nesta categoria.</p>
                        <a href="blog.php" style="display: inline-block; margin-top: 1rem; color: var(--primary-color);">Ver todos os posts</a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (count($posts) >= 9): ?>
            <div class="load-more">
                <button class="load-more-btn">Carregar Mais Notícias</button>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Navegação</h3>
                <ul class="footer-links">
                    <li><a href="index.php#inicio">Início</a></li>
                    <li><a href="index.php#elenco">Elenco</a></li>
                    <li><a href="index.php#recordes">Recordes</a></li>
                    <li><a href="index.php#história">História</a></li>
                    <li><a href="blog.php">Canal do Time</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Redes Sociais</h3>
                <div class="footer-social">
                    <a href="https://www.instagram.com/brasilia.basquete/" target="_blank" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                        </svg>
                    </a>
                    <a href="https://www.tiktok.com/@brasilia.basquete" target="_blank" aria-label="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/@CaixaBrasiliaBasquete" target="_blank" aria-label="YouTube">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/>
                            <path d="m10 15 5-3-5-3z"/>
                        </svg>
                    </a>
                    <a href="https://x.com/brasiliabasquet" target="_blank" aria-label="X/Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4l11.733 16h4.267l-11.733 -16z"/>
                            <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Contato</h3>
                <ul class="footer-links">
                    <li><a href="mailto:suporte@bsbbkt.com.br">suporte@bsbbkt.com.br</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Institucional</h3>
                <ul class="footer-links">
                    <li><a href="termos.php">Termos e Condições</a></li>
                    <li><a href="privacidade.php">Política de Privacidade</a></li>
                    <li><a href="consentimento.php">Aviso de Consentimento</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-legal">
                <a href="termos.php">Termos e Condições</a>
                <a href="privacidade.php">Política de Privacidade</a>
                <a href="consentimento.php">Aviso de Consentimento</a>
            </div>
            <p class="footer-copyright">© 2025 Caixa Brasília Basquete. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="assets/js/main.js"></script>
</body>
</html>
