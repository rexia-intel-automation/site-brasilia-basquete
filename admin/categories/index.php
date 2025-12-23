<?php
require_once '../auth/check_auth.php';
require_once '../config/database.php';

$db = getDB();

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Check if category has posts
    $stmt = $db->prepare("SELECT COUNT(*) as count FROM posts WHERE category_id = ?");
    $stmt->execute([$id]);
    $has_posts = $stmt->fetch()['count'] > 0;

    if ($has_posts) {
        $error = "Não é possível excluir esta categoria pois ela possui posts associados.";
    } else {
        $stmt = $db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: index?msg=deleted');
        exit;
    }
}

// Handle form submission (add/edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $slug = trim($_POST['slug']);
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;

    // Generate slug if empty
    if (empty($slug)) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    }

    try {
        if ($id) {
            // Update
            $stmt = $db->prepare("UPDATE categories SET name = ?, slug = ? WHERE id = ?");
            $stmt->execute([$name, $slug, $id]);
            header('Location: index?msg=updated');
        } else {
            // Insert
            $stmt = $db->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
            $stmt->execute([$name, $slug]);
            header('Location: index?msg=created');
        }
        exit;
    } catch (PDOException $e) {
        $error = "Erro ao salvar categoria: " . $e->getMessage();
    }
}

// Get category to edit
$edit_category = null;
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $stmt = $db->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_category = $stmt->fetch();
}

// Get all categories with post count
$categories = $db->query("
    SELECT c.*, COUNT(p.id) as post_count
    FROM categories c
    LEFT JOIN posts p ON c.id = p.category_id
    GROUP BY c.id
    ORDER BY c.name
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Admin Brasília Basquete</title>
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
                <h1>Categorias</h1>
                <p>Organize os posts do blog por categorias</p>
            </div>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-<?php
                echo $_GET['msg'] == 'created' ? 'success' :
                    ($_GET['msg'] == 'updated' ? 'success' : 'info');
            ?> auto-hide">
                <?php
                    if ($_GET['msg'] == 'created') echo 'Categoria criada com sucesso!';
                    elseif ($_GET['msg'] == 'updated') echo 'Categoria atualizada com sucesso!';
                    elseif ($_GET['msg'] == 'deleted') echo 'Categoria excluída com sucesso!';
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-grid" style="gap: 2rem;">
            <!-- Form -->
            <div class="form-main" style="max-width: 600px;">
                <div class="card">
                    <div class="card-header">
                        <h3><?php echo $edit_category ? 'Editar' : 'Nova'; ?> Categoria</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <?php if ($edit_category): ?>
                                <input type="hidden" name="id" value="<?php echo $edit_category['id']; ?>">
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="name" class="required">Nome *</label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       class="form-control"
                                       value="<?php echo htmlspecialchars($edit_category['name'] ?? ''); ?>"
                                       required
                                       oninput="generateSlug()"
                                       placeholder="Ex: Notícias">
                                <small>Nome da categoria que aparecerá no site</small>
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug (URL)</label>
                                <input type="text"
                                       id="slug"
                                       name="slug"
                                       class="form-control"
                                       value="<?php echo htmlspecialchars($edit_category['slug'] ?? ''); ?>"
                                       pattern="[a-z0-9-]+"
                                       placeholder="noticias">
                                <small>URL amigável (gerada automaticamente se deixado em branco)</small>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                        <polyline points="17 21 17 13 7 13 7 21"/>
                                        <polyline points="7 3 7 8 15 8"/>
                                    </svg>
                                    <?php echo $edit_category ? 'Atualizar' : 'Criar'; ?> Categoria
                                </button>

                                <?php if ($edit_category): ?>
                                    <a href="index" class="btn btn-outline">Cancelar</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List -->
            <div class="form-sidebar" style="flex: 1;">
                <div class="card">
                    <div class="card-header">
                        <h3>Categorias Existentes</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Slug</th>
                                    <th>Posts</th>
                                    <th style="width: 100px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $cat): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($cat['name']); ?></strong></td>
                                    <td><code><?php echo htmlspecialchars($cat['slug']); ?></code></td>
                                    <td>
                                        <?php if ($cat['post_count'] > 0): ?>
                                            <span class="badge badge-info"><?php echo $cat['post_count']; ?></span>
                                        <?php else: ?>
                                            <span style="opacity: 0.5;">0</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="index?edit=<?php echo $cat['id']; ?>"
                                               class="btn btn-sm btn-secondary"
                                               title="Editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </a>
                                            <?php if ($cat['post_count'] == 0): ?>
                                            <a href="index?action=delete&id=<?php echo $cat['id']; ?>"
                                               class="btn btn-sm btn-danger"
                                               title="Excluir"
                                               onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18"/>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                                </svg>
                                            </a>
                                            <?php else: ?>
                                            <button class="btn btn-sm btn-danger"
                                                    title="Não pode excluir (tem posts)"
                                                    disabled
                                                    style="opacity: 0.5; cursor: not-allowed;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M18 6 6 18"/>
                                                    <path d="m6 6 12 12"/>
                                                </svg>
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($categories)): ?>
                                <tr>
                                    <td colspan="4" class="text-center" style="padding: 2rem;">
                                        Nenhuma categoria cadastrada
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/js/admin.js"></script>
    <script>
        function generateSlug() {
            const name = document.getElementById('name').value;
            const slug = name
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '') // Remove accents
                .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric with hyphens
                .replace(/^-+|-+$/g, ''); // Remove leading/trailing hyphens

            document.getElementById('slug').value = slug;
        }
    </script>
</body>
</html>
