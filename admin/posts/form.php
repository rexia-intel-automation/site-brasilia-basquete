<?php
require_once '../auth/check_auth.php';
require_once '../config/database.php';

$db = getDB();

// Check if editing
$is_edit = isset($_GET['id']);
$post = null;

if ($is_edit) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();

    if (!$post) {
        header('Location: index.php');
        exit;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $excerpt = trim($_POST['excerpt']);
    $content = trim($_POST['content']);
    $featured_image = trim($_POST['featured_image']);
    $category_id = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $published = isset($_POST['published']) ? 1 : 0;
    $author_id = $_SESSION['admin_id'];

    // Generate slug if empty
    if (empty($slug)) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    }

    try {
        if ($is_edit) {
            $stmt = $db->prepare("
                UPDATE posts SET
                    title = ?,
                    slug = ?,
                    excerpt = ?,
                    content = ?,
                    featured_image = ?,
                    category_id = ?,
                    is_featured = ?,
                    published = ?,
                    updated_at = CURRENT_TIMESTAMP
                WHERE id = ?
            ");
            $stmt->execute([
                $title, $slug, $excerpt, $content, $featured_image,
                $category_id, $is_featured, $published, $id
            ]);
        } else {
            $stmt = $db->prepare("
                INSERT INTO posts (title, slug, excerpt, content, featured_image, category_id, author_id, is_featured, published)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $title, $slug, $excerpt, $content, $featured_image,
                $category_id, $author_id, $is_featured, $published
            ]);
        }

        header('Location: index.php?msg=success');
        exit;
    } catch (PDOException $e) {
        $error = "Erro ao salvar post: " . $e->getMessage();
    }
}

// Get categories
$categories = $db->query("SELECT * FROM categories ORDER BY name")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $is_edit ? 'Editar' : 'Novo'; ?> Post - Admin Brasília Basquete</title>
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
                <h1><?php echo $is_edit ? 'Editar' : 'Novo'; ?> Post</h1>
                <p><?php echo $is_edit ? 'Atualize as informações do post' : 'Crie uma nova publicação para o blog'; ?></p>
            </div>
            <a href="index.php" class="btn btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7"/>
                    <path d="M19 12H5"/>
                </svg>
                Voltar
            </a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" class="form-layout">
            <div class="form-grid">
                <!-- Main Content -->
                <div class="form-main">
                    <div class="card">
                        <div class="card-header">
                            <h3>Conteúdo do Post</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title" class="required">Título *</label>
                                <input type="text"
                                       id="title"
                                       name="title"
                                       class="form-control"
                                       value="<?php echo htmlspecialchars($post['title'] ?? ''); ?>"
                                       required
                                       oninput="generateSlug()">
                                <small>O título principal do post que aparecerá no blog</small>
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug (URL)</label>
                                <input type="text"
                                       id="slug"
                                       name="slug"
                                       class="form-control"
                                       value="<?php echo htmlspecialchars($post['slug'] ?? ''); ?>"
                                       pattern="[a-z0-9-]+"
                                       placeholder="titulo-do-post">
                                <small>URL amigável (gerada automaticamente se deixado em branco)</small>
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Resumo</label>
                                <textarea id="excerpt"
                                          name="excerpt"
                                          class="form-control"
                                          rows="3"
                                          maxlength="500"><?php echo htmlspecialchars($post['excerpt'] ?? ''); ?></textarea>
                                <small>Breve descrição que aparece nas listagens (máx. 500 caracteres)</small>
                            </div>

                            <div class="form-group">
                                <label for="content" class="required">Conteúdo *</label>
                                <textarea id="content"
                                          name="content"
                                          class="form-control"
                                          rows="15"
                                          required><?php echo htmlspecialchars($post['content'] ?? ''); ?></textarea>
                                <small>Conteúdo completo do post (aceita HTML)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="form-sidebar">
                    <!-- Publish -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Publicação</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox"
                                           name="published"
                                           <?php echo ($post['published'] ?? 1) ? 'checked' : ''; ?>>
                                    <span>Publicar post</span>
                                </label>
                                <small>Se desmarcado, o post ficará como rascunho</small>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox"
                                           name="is_featured"
                                           <?php echo ($post['is_featured'] ?? 0) ? 'checked' : ''; ?>>
                                    <span>Marcar como destaque</span>
                                </label>
                                <small>Posts em destaque aparecem no topo</small>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                        <polyline points="17 21 17 13 7 13 7 21"/>
                                        <polyline points="7 3 7 8 15 8"/>
                                    </svg>
                                    <?php echo $is_edit ? 'Atualizar' : 'Publicar'; ?> Post
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Categoria</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select name="category_id" class="form-control">
                                    <option value="">Sem categoria</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>"
                                                <?php echo ($post['category_id'] ?? '') == $cat['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($cat['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small>Organize posts por categoria</small>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Imagem Destacada</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="featured_image">URL da Imagem</label>
                                <input type="url"
                                       id="featured_image"
                                       name="featured_image"
                                       class="form-control"
                                       value="<?php echo htmlspecialchars($post['featured_image'] ?? ''); ?>"
                                       placeholder="https://exemplo.com/imagem.jpg">
                                <small style="display: block; margin-top: 0.5rem; color: var(--text-secondary);">
                                    <strong>Recomendado:</strong> 1200 x 630 pixels (JPG até 500KB)<br>
                                    Proporção ideal: Landscape (horizontal) para melhor visualização em blog e redes sociais
                                </small>
                            </div>

                            <?php if (!empty($post['featured_image'])): ?>
                            <div class="image-preview" style="margin-top: 1rem;">
                                <img src="<?php echo htmlspecialchars($post['featured_image']); ?>"
                                     alt="Preview"
                                     style="width: 100%; border-radius: var(--border-radius);"
                                     onerror="this.style.display='none'">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Info -->
                    <?php if ($is_edit && $post): ?>
                    <div class="card">
                        <div class="card-header">
                            <h3>Informações</h3>
                        </div>
                        <div class="card-body" style="font-size: 0.875rem;">
                            <p style="margin-bottom: 0.5rem;">
                                <strong>Criado:</strong><br>
                                <?php echo date('d/m/Y H:i', strtotime($post['created_at'])); ?>
                            </p>
                            <p style="margin-bottom: 0.5rem;">
                                <strong>Atualizado:</strong><br>
                                <?php echo date('d/m/Y H:i', strtotime($post['updated_at'])); ?>
                            </p>
                            <p style="margin: 0;">
                                <strong>Visualizações:</strong><br>
                                <?php echo number_format($post['views']); ?>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </main>

    <script src="../assets/js/admin.js"></script>
    <script>
        function generateSlug() {
            const title = document.getElementById('title').value;
            const slug = title
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
