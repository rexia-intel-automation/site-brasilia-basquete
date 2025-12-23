<?php
require_once '../auth/check_auth.php';
require_once '../config/database.php';

$db = getDB();

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index?msg=deleted');
    exit;
}

// Get filter parameters
$filter_category = $_GET['category'] ?? '';
$filter_status = $_GET['status'] ?? '';
$search = $_GET['search'] ?? '';

// Build query
$where_conditions = [];
$params = [];

if ($filter_category) {
    $where_conditions[] = "p.category_id = ?";
    $params[] = $filter_category;
}

if ($filter_status !== '') {
    $where_conditions[] = "p.published = ?";
    $params[] = $filter_status;
}

if ($search) {
    $where_conditions[] = "(p.title LIKE ? OR p.content LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// Get posts
$query = "
    SELECT p.*, c.name as category_name, u.username as author_name
    FROM posts p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN users u ON p.author_id = u.id
    $where_clause
    ORDER BY p.created_at DESC
";

$stmt = $db->prepare($query);
$stmt->execute($params);
$posts = $stmt->fetchAll();

// Get categories for filter
$categories = $db->query("SELECT * FROM categories ORDER BY name")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts - Admin Brasília Basquete</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1>Posts do Blog</h1>
                <p>Gerencie as publicações do blog</p>
            </div>
            <a href="form" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Novo Post
            </a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-<?php echo $_GET['msg'] == 'success' ? 'success' : ($_GET['msg'] == 'deleted' ? 'info' : 'success'); ?> auto-hide">
                <?php
                    if ($_GET['msg'] == 'success') echo 'Post salvo com sucesso!';
                    elseif ($_GET['msg'] == 'deleted') echo 'Post excluído com sucesso!';
                    else echo 'Operação realizada com sucesso!';
                ?>
            </div>
        <?php endif; ?>

        <!-- Filters -->
        <div class="card mb-4">
            <form method="GET" class="filter-form">
                <div class="filter-row">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar posts..." value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="form-group">
                        <select name="category" class="form-control">
                            <option value="">Todas as categorias</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo $filter_category == $cat['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="">Todos os status</option>
                            <option value="1" <?php echo $filter_status === '1' ? 'selected' : ''; ?>>Publicado</option>
                            <option value="0" <?php echo $filter_status === '0' ? 'selected' : ''; ?>>Rascunho</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary">Filtrar</button>
                    <?php if ($search || $filter_category || $filter_status !== ''): ?>
                        <a href="index" class="btn btn-outline">Limpar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Posts Table -->
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Título</th>
                            <th>Categoria</th>
                            <th>Autor</th>
                            <th>Status</th>
                            <th>Visualizações</th>
                            <th>Data</th>
                            <th style="width: 120px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($post['title']); ?></strong>
                                <?php if ($post['is_featured']): ?>
                                    <span class="badge badge-warning">★ Destaque</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($post['category_name'] ?? 'Sem categoria'); ?></td>
                            <td><?php echo htmlspecialchars($post['author_name'] ?? 'Desconhecido'); ?></td>
                            <td>
                                <?php if ($post['published']): ?>
                                    <span class="badge badge-success">Publicado</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Rascunho</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo number_format($post['views']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="form?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-secondary" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>
                                    <a href="index?action=delete&id=<?php echo $post['id']; ?>"
                                       class="btn btn-sm btn-danger"
                                       title="Excluir"
                                       onclick="return confirm('Tem certeza que deseja excluir este post?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"/>
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($posts)): ?>
                        <tr>
                            <td colspan="7" class="text-center" style="padding: 3rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.3; margin-bottom: 1rem;">
                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                </svg>
                                <p style="opacity: 0.7;">Nenhum post encontrado</p>
                                <a href="form" class="btn btn-primary" style="margin-top: 1rem;">Criar Primeiro Post</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer" style="margin-top: 1rem; padding: 1rem; background: var(--card-bg); border-radius: var(--border-radius);">
            <p style="margin: 0; opacity: 0.7;">
                Total: <strong><?php echo count($posts); ?></strong> post(s)
            </p>
        </div>
    </main>

    <script src="../assets/js/admin.js"></script>
</body>
</html>
