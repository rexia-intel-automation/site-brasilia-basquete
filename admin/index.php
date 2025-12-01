<?php
require_once 'auth/check_auth.php';
require_once 'config/database.php';

$db = getDB();

// Get statistics
$stats = [
    'players' => $db->query("SELECT COUNT(*) as count FROM players WHERE active = 1")->fetch()['count'],
    'total_players' => $db->query("SELECT COUNT(*) as count FROM players")->fetch()['count'],
    'posts' => $db->query("SELECT COUNT(*) as count FROM posts WHERE published = 1")->fetch()['count'],
    'total_posts' => $db->query("SELECT COUNT(*) as count FROM posts")->fetch()['count'],
    'categories' => $db->query("SELECT COUNT(*) as count FROM categories")->fetch()['count'],
];

// Get recent posts
$recent_posts = $db->query("
    SELECT p.*, c.name as category_name, u.username as author_name
    FROM posts p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN users u ON p.author_id = u.id
    ORDER BY p.created_at DESC
    LIMIT 5
")->fetchAll();

// Get recent players
$recent_players = $db->query("
    SELECT * FROM players
    ORDER BY created_at DESC
    LIMIT 5
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Brasília Basquete</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <h1>Dashboard</h1>
            <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #005CA9 0%, #0070c9 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['players']; ?></h3>
                    <p>Jogadores Ativos</p>
                    <small><?php echo $stats['total_players']; ?> total</small>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #D17D00 0%, #ff9500 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['posts']; ?></h3>
                    <p>Posts Publicados</p>
                    <small><?php echo $stats['total_posts']; ?> total</small>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3><?php echo $stats['categories']; ?></h3>
                    <p>Categorias</p>
                    <small>Ativas</small>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3><?php
                        $total_views = $db->query("SELECT SUM(views) as total FROM posts")->fetch()['total'] ?? 0;
                        echo number_format($total_views);
                    ?></h3>
                    <p>Visualizações</p>
                    <small>Total de posts</small>
                </div>
            </div>
        </div>

        <!-- Recent Content -->
        <div class="content-grid">
            <!-- Recent Posts -->
            <div class="content-section">
                <div class="section-header">
                    <h2>Posts Recentes</h2>
                    <a href="posts/index.php" class="btn btn-sm btn-outline">Ver Todos</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Categoria</th>
                                <th>Status</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_posts as $post): ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($post['title']); ?></strong>
                                    <?php if ($post['is_featured']): ?>
                                        <span class="badge badge-warning">Destaque</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($post['category_name'] ?? 'Sem categoria'); ?></td>
                                <td>
                                    <?php if ($post['published']): ?>
                                        <span class="badge badge-success">Publicado</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Rascunho</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($recent_posts)): ?>
                            <tr>
                                <td colspan="4" class="text-center">Nenhum post encontrado</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Players -->
            <div class="content-section">
                <div class="section-header">
                    <h2>Jogadores Recentes</h2>
                    <a href="players/index.php" class="btn btn-sm btn-outline">Ver Todos</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Posição</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_players as $player): ?>
                            <tr>
                                <td><strong>#<?php echo $player['number']; ?></strong></td>
                                <td><?php echo htmlspecialchars($player['name']); ?></td>
                                <td><?php echo htmlspecialchars($player['position']); ?></td>
                                <td>
                                    <?php if ($player['active']): ?>
                                        <span class="badge badge-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Inativo</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($recent_players)): ?>
                            <tr>
                                <td colspan="4" class="text-center">Nenhum jogador encontrado</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/js/admin.js"></script>
</body>
</html>
