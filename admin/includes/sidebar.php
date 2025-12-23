<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <img src="../assets/images/logo.png" alt="Logo" class="sidebar-logo" onerror="this.style.display='none'">
        <h2>Admin Panel</h2>
    </div>

    <nav class="sidebar-nav">
        <a href="index" class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="7" height="9" x="3" y="3" rx="1"/>
                <rect width="7" height="5" x="14" y="3" rx="1"/>
                <rect width="7" height="9" x="14" y="12" rx="1"/>
                <rect width="7" height="5" x="3" y="16" rx="1"/>
            </svg>
            <span>Dashboard</span>
        </a>

        <div class="nav-section">
            <h3>Conteúdo</h3>
        </div>

        <a href="players/index" class="nav-item has-submenu <?php echo strpos($_SERVER['PHP_SELF'], 'players/') !== false ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <span>Jogadores</span>
        </a>
        <div class="submenu">
            <a href="players/index" class="nav-item">
                <span>Todos Jogadores</span>
            </a>
            <a href="players/form" class="nav-item">
                <span>Novo Jogador</span>
            </a>
            <a href="players/index?status=inactive" class="nav-item">
                <span>Inativos</span>
            </a>
        </div>

        <a href="posts/index" class="nav-item has-submenu <?php echo strpos($_SERVER['PHP_SELF'], 'posts/') !== false ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                <polyline points="14 2 14 8 20 8"/>
            </svg>
            <span>Posts</span>
            <?php
            $db = getDB();
            $drafts_count = $db->query("SELECT COUNT(*) as count FROM posts WHERE published = 0")->fetch()['count'];
            if ($drafts_count > 0):
            ?>
                <span class="badge badge-warning"><?php echo $drafts_count; ?></span>
            <?php endif; ?>
        </a>
        <div class="submenu">
            <a href="posts/index" class="nav-item">
                <span>Todos Posts</span>
            </a>
            <a href="posts/form" class="nav-item">
                <span>Novo Post</span>
            </a>
            <a href="posts/index?status=draft" class="nav-item">
                <span>Rascunhos</span>
                <?php if ($drafts_count > 0): ?>
                    <span class="badge badge-secondary"><?php echo $drafts_count; ?></span>
                <?php endif; ?>
            </a>
        </div>

        <a href="categories/index" class="nav-item <?php echo strpos($_SERVER['PHP_SELF'], 'categories/') !== false ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
            <span>Categorias</span>
        </a>

        <div class="nav-section">
            <h3>Mídia</h3>
        </div>

        <a href="media/index" class="nav-item <?php echo strpos($_SERVER['PHP_SELF'], 'media/') !== false ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                <circle cx="9" cy="9" r="2"/>
                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
            </svg>
            <span>Galeria</span>
        </a>

        <div class="nav-section">
            <h3>Configurações</h3>
        </div>

        <a href="settings/index" class="nav-item <?php echo strpos($_SERVER['PHP_SELF'], 'settings/') !== false ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
            <span>Configurações</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <p>&copy; 2025 Brasília Basquete</p>
    </div>
</aside>
