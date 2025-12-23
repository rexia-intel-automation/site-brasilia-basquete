<?php
/**
 * Breadcrumbs Helper
 * Generates breadcrumb navigation based on current page
 */

function getBreadcrumbs() {
    $path = $_SERVER['PHP_SELF'];
    $breadcrumbs = [];

    // Always start with Dashboard
    $breadcrumbs[] = ['title' => 'Dashboard', 'url' => '/admin/index'];

    // Determine current section
    if (strpos($path, 'players/') !== false) {
        $breadcrumbs[] = ['title' => 'Jogadores', 'url' => '/admin/players/index'];

        if (strpos($path, 'form.php') !== false) {
            $isEdit = isset($_GET['id']);
            $breadcrumbs[] = ['title' => $isEdit ? 'Editar Jogador' : 'Novo Jogador', 'url' => null];
        }
    } elseif (strpos($path, 'posts/') !== false) {
        $breadcrumbs[] = ['title' => 'Posts', 'url' => '/admin/posts/index'];

        if (strpos($path, 'form.php') !== false) {
            $isEdit = isset($_GET['id']);
            $breadcrumbs[] = ['title' => $isEdit ? 'Editar Post' : 'Novo Post', 'url' => null];
        }
    } elseif (strpos($path, 'categories/') !== false) {
        $breadcrumbs[] = ['title' => 'Categorias', 'url' => '/admin/categories/index'];
    } elseif (strpos($path, 'media/') !== false) {
        $breadcrumbs[] = ['title' => 'Galeria', 'url' => '/admin/media/index'];
    } elseif (strpos($path, 'settings/') !== false) {
        $breadcrumbs[] = ['title' => 'Configurações', 'url' => '/admin/settings/index'];
    }

    return $breadcrumbs;
}

function renderBreadcrumbs() {
    $breadcrumbs = getBreadcrumbs();

    if (count($breadcrumbs) <= 1) {
        return ''; // Don't show breadcrumbs on dashboard
    }

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';

    foreach ($breadcrumbs as $index => $crumb) {
        echo '<div class="breadcrumb-item">';

        if ($crumb['url'] && $index < count($breadcrumbs) - 1) {
            echo '<a href="' . htmlspecialchars($crumb['url']) . '">' . htmlspecialchars($crumb['title']) . '</a>';
        } else {
            echo '<span>' . htmlspecialchars($crumb['title']) . '</span>';
        }

        echo '</div>';
    }

    echo '</nav>';
}
?>
