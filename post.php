<?php
require_once 'admin/config/database.php';

$db = getDB();

// Get slug from URL
$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('Location: blog.php');
    exit;
}

// Get post by slug
$query = "
    SELECT p.*, c.name as category_name, c.slug as category_slug, u.username as author_name
    FROM posts p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN users u ON p.author_id = u.id
    WHERE p.slug = ? AND p.published = 1
";

$stmt = $db->prepare($query);
$stmt->execute([$slug]);
$post = $stmt->fetch();

// If post not found, redirect to blog
if (!$post) {
    header('Location: blog.php');
    exit;
}

// Increment view counter (only once per session)
$view_key = 'viewed_post_' . $post['id'];
if (!isset($_SESSION[$view_key])) {
    $update_views = $db->prepare("UPDATE posts SET views = views + 1 WHERE id = ?");
    $update_views->execute([$post['id']]);
    $_SESSION[$view_key] = true;
}

// Get related posts (same category, excluding current post)
$related_query = "
    SELECT p.*, c.name as category_name
    FROM posts p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.published = 1
    AND p.category_id = ?
    AND p.id != ?
    ORDER BY p.created_at DESC
    LIMIT 3
";
$stmt = $db->prepare($related_query);
$stmt->execute([$post['category_id'], $post['id']]);
$related_posts = $stmt->fetchAll();

// Helper function to format date
function formatPostDate($date) {
    $timestamp = strtotime($date);
    return date('d M Y', $timestamp);
}

// Helper function to format full date
function formatFullDate($date) {
    $timestamp = strtotime($date);
    setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');
    return strftime('%d de %B de %Y', $timestamp);
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
    <title><?php echo htmlspecialchars($post['title']); ?> - Caixa Brasília Basquete</title>

    <!-- Meta Tags -->
    <meta name="description" content="<?php echo htmlspecialchars($post['excerpt'] ?? truncateExcerpt(strip_tags($post['content']), 160)); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo htmlspecialchars($post['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($post['excerpt'] ?? truncateExcerpt(strip_tags($post['content']), 200)); ?>">
    <?php if (!empty($post['featured_image'])): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($post['featured_image']); ?>">
    <?php endif; ?>

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($post['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($post['excerpt'] ?? truncateExcerpt(strip_tags($post['content']), 200)); ?>">
    <?php if (!empty($post['featured_image'])): ?>
    <meta name="twitter:image" content="<?php echo htmlspecialchars($post['featured_image']); ?>">
    <?php endif; ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <style>
        .post-single {
            max-width: 1200px;
            margin: 0 auto;
            padding: 8rem 2rem 4rem;
        }

        .post-header {
            margin-bottom: 3rem;
        }

        .post-breadcrumb {
            display: flex;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        .post-breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .post-breadcrumb a:hover {
            text-decoration: underline;
        }

        .post-category-badge {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
        }

        .post-single h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--text-primary);
        }

        .post-single-meta {
            display: flex;
            gap: 2rem;
            align-items: center;
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .post-single-meta span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .post-featured-image {
            width: 100%;
            max-height: 600px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 3rem;
        }

        .post-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 3rem;
        }

        .post-content p {
            margin-bottom: 1.5rem;
        }

        .post-content h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            margin: 2rem 0 1rem;
            color: var(--text-primary);
        }

        .post-content h3 {
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 1.5rem 0 1rem;
            color: var(--text-primary);
        }

        .post-content ul, .post-content ol {
            margin: 1.5rem 0;
            padding-left: 2rem;
        }

        .post-content li {
            margin-bottom: 0.5rem;
        }

        .post-content blockquote {
            border-left: 4px solid var(--primary-color);
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: var(--text-secondary);
        }

        .post-share {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 2rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 3rem;
        }

        .post-share-title {
            font-weight: 600;
            color: var(--text-primary);
        }

        .post-share-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .share-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--bg-secondary);
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }

        .related-posts {
            margin-top: 4rem;
        }

        .related-posts h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--text-primary);
        }

        .related-posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .post-single {
                padding: 6rem 1.5rem 3rem;
            }

            .post-single h1 {
                font-size: 2.5rem;
            }

            .post-single-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .related-posts-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
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

    <!-- POST SINGLE -->
    <article class="post-single">
        <div class="post-header">
            <!-- Breadcrumb -->
            <div class="post-breadcrumb">
                <a href="index.php">Início</a>
                <span>/</span>
                <a href="blog.php">Canal do Time</a>
                <span>/</span>
                <?php if ($post['category_name']): ?>
                    <a href="blog.php?category=<?php echo $post['category_id']; ?>"><?php echo htmlspecialchars($post['category_name']); ?></a>
                    <span>/</span>
                <?php endif; ?>
                <span><?php echo htmlspecialchars($post['title']); ?></span>
            </div>

            <!-- Category Badge -->
            <?php if ($post['category_name']): ?>
            <div class="post-category-badge">
                <?php echo htmlspecialchars($post['category_name']); ?>
            </div>
            <?php endif; ?>

            <!-- Title -->
            <h1><?php echo htmlspecialchars($post['title']); ?></h1>

            <!-- Meta -->
            <div class="post-single-meta">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                    <?php echo formatPostDate($post['created_at']); ?>
                </span>
                <?php if ($post['author_name']): ?>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    Por <?php echo htmlspecialchars($post['author_name']); ?>
                </span>
                <?php endif; ?>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <?php echo number_format($post['views']); ?> visualizações
                </span>
            </div>
        </div>

        <!-- Featured Image -->
        <?php if (!empty($post['featured_image'])): ?>
        <img src="<?php echo htmlspecialchars($post['featured_image']); ?>"
             alt="<?php echo htmlspecialchars($post['title']); ?>"
             class="post-featured-image">
        <?php endif; ?>

        <!-- Excerpt -->
        <?php if (!empty($post['excerpt'])): ?>
        <div class="post-content">
            <p><strong><?php echo htmlspecialchars($post['excerpt']); ?></strong></p>
        </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="post-content">
            <?php echo $post['content']; ?>
        </div>

        <!-- Share Buttons -->
        <div class="post-share">
            <div class="post-share-title">Compartilhar:</div>
            <div class="post-share-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>"
                   target="_blank"
                   class="share-btn"
                   title="Compartilhar no Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>"
                   target="_blank"
                   class="share-btn"
                   title="Compartilhar no Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4l11.733 16h4.267l-11.733 -16z"/>
                        <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/>
                    </svg>
                </a>
                <a href="https://wa.me/?text=<?php echo urlencode($post['title'] . ' - ' . 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>"
                   target="_blank"
                   class="share-btn"
                   title="Compartilhar no WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Related Posts -->
        <?php if (!empty($related_posts)): ?>
        <div class="related-posts">
            <h2>Posts Relacionados</h2>
            <div class="related-posts-grid">
                <?php foreach ($related_posts as $related): ?>
                    <a href="post.php?slug=<?php echo urlencode($related['slug']); ?>" class="post-card">
                        <div class="post-image">
                            <?php if (!empty($related['featured_image'])): ?>
                                <img src="<?php echo htmlspecialchars($related['featured_image']); ?>"
                                     alt="<?php echo htmlspecialchars($related['title']); ?>">
                            <?php else: ?>
                                <img src="https://i.imgur.com/bgExqAD.png" alt="<?php echo htmlspecialchars($related['title']); ?>">
                            <?php endif; ?>
                            <span class="post-tag"><?php echo htmlspecialchars($related['category_name'] ?? 'Geral'); ?></span>
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span><?php echo formatPostDate($related['created_at']); ?></span>
                            </div>
                            <h3 class="post-title"><?php echo htmlspecialchars($related['title']); ?></h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </article>

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
