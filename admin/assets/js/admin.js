// Admin Panel JavaScript
// Brasília Basquete - Complete Implementation

// Theme Management
class AdminThemeManager {
    constructor() {
        this.theme = localStorage.getItem('admin_theme') || 'dark';
        this.init();
    }

    init() {
        document.documentElement.setAttribute('data-theme', this.theme);
        this.setupToggle();
    }

    setupToggle() {
        const toggleBtn = document.getElementById('adminThemeToggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => this.toggleTheme());
        }
    }

    toggleTheme() {
        this.theme = this.theme === 'light' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', this.theme);
        localStorage.setItem('admin_theme', this.theme);
    }
}

// Sidebar Management
class SidebarManager {
    constructor() {
        this.sidebar = document.getElementById('sidebar');
        this.toggle = document.getElementById('sidebarToggle');
        this.overlay = null;
        this.isCollapsed = localStorage.getItem('sidebar_collapsed') === 'true';
        this.init();
    }

    init() {
        if (!this.sidebar || !this.toggle) return;

        this.createOverlay();
        this.setupToggle();
        this.setupKeyboard();
        this.setupSubmenus();
        this.applyStoredState();
    }

    createOverlay() {
        this.overlay = document.createElement('div');
        this.overlay.className = 'sidebar-overlay';
        document.body.appendChild(this.overlay);

        this.overlay.addEventListener('click', () => this.closeMobile());
    }

    setupToggle() {
        this.toggle.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                this.toggleMobile();
            } else {
                this.toggleDesktop();
            }
        });
    }

    toggleDesktop() {
        this.isCollapsed = !this.isCollapsed;
        this.sidebar.classList.toggle('collapsed');
        localStorage.setItem('sidebar_collapsed', this.isCollapsed);
    }

    toggleMobile() {
        const isOpen = this.sidebar.classList.contains('open');
        if (isOpen) {
            this.closeMobile();
        } else {
            this.openMobile();
        }
    }

    openMobile() {
        this.sidebar.classList.add('open');
        this.overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        this.sidebar.setAttribute('aria-hidden', 'false');
        this.toggle.setAttribute('aria-expanded', 'true');
    }

    closeMobile() {
        this.sidebar.classList.remove('open');
        this.overlay.classList.remove('active');
        document.body.style.overflow = '';
        this.sidebar.setAttribute('aria-hidden', 'true');
        this.toggle.setAttribute('aria-expanded', 'false');
    }

    setupKeyboard() {
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.sidebar.classList.contains('open')) {
                this.closeMobile();
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && this.sidebar.classList.contains('open')) {
                this.closeMobile();
            }
        });
    }

    setupSubmenus() {
        const submenuToggles = document.querySelectorAll('.nav-item.has-submenu');
        submenuToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                this.toggleSubmenu(toggle);
            });
        });
    }

    toggleSubmenu(toggle) {
        const isExpanded = toggle.classList.contains('expanded');
        const submenu = toggle.nextElementSibling;

        if (isExpanded) {
            toggle.classList.remove('expanded');
            submenu.classList.remove('expanded');
        } else {
            toggle.classList.add('expanded');
            submenu.classList.add('expanded');
        }
    }

    applyStoredState() {
        if (this.isCollapsed && window.innerWidth > 768) {
            this.sidebar.classList.add('collapsed');
        }
    }
}

// User Menu Dropdown
function initUserMenu() {
    const userMenu = document.querySelector('.user-menu');
    const userToggle = document.querySelector('.user-menu-toggle');
    const userDropdown = document.querySelector('.user-menu-dropdown');

    if (!userMenu || !userToggle || !userDropdown) return;

    let isOpen = false;

    function openDropdown() {
        userDropdown.style.display = 'block';
        isOpen = true;
        userToggle.setAttribute('aria-expanded', 'true');
    }

    function closeDropdown() {
        userDropdown.style.display = 'none';
        isOpen = false;
        userToggle.setAttribute('aria-expanded', 'false');
    }

    userToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        if (isOpen) {
            closeDropdown();
        } else {
            openDropdown();
        }
    });

    document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target) && isOpen) {
            closeDropdown();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen) {
            closeDropdown();
        }
    });
}

// Quick Search
class QuickSearch {
    constructor() {
        this.input = document.getElementById('quickSearchInput');
        this.results = document.getElementById('quickSearchResults');
        this.debounceTimer = null;
        this.init();
    }

    init() {
        if (!this.input || !this.results) return;

        this.input.addEventListener('input', (e) => {
            clearTimeout(this.debounceTimer);
            this.debounceTimer = setTimeout(() => {
                this.search(e.target.value);
            }, 300);
        });

        this.input.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.close();
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.quick-search')) {
                this.close();
            }
        });
    }

    async search(query) {
        if (query.length < 2) {
            this.close();
            return;
        }

        try {
            const response = await fetch(`search.php?q=${encodeURIComponent(query)}`);
            const data = await response.json();
            this.displayResults(data);
        } catch (error) {
            console.error('Search error:', error);
        }
    }

    displayResults(results) {
        if (results.length === 0) {
            this.results.innerHTML = '<div class="search-result-item">Nenhum resultado encontrado</div>';
        } else {
            this.results.innerHTML = results.map(result => `
                <a href="${result.url}" class="search-result-item">
                    <div class="search-result-title">${result.title}</div>
                    <div class="search-result-meta">${result.type} · ${result.date}</div>
                </a>
            `).join('');
        }
        this.results.classList.add('active');
    }

    close() {
        this.results.classList.remove('active');
        this.results.innerHTML = '';
    }
}

// Auto-hide alerts
function initAlerts() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
}

// Loading State Helper
function setLoading(element, isLoading) {
    if (isLoading) {
        element.classList.add('loading');
    } else {
        element.classList.remove('loading');
    }
}

// Keyboard Shortcuts
function initKeyboardShortcuts() {
    document.addEventListener('keydown', (e) => {
        if (e.altKey && !e.ctrlKey && !e.shiftKey) {
            switch(e.key.toLowerCase()) {
                case 'h':
                    e.preventDefault();
                    window.location.href = 'index.php';
                    break;
                case 'p':
                    e.preventDefault();
                    window.location.href = 'posts/index.php';
                    break;
                case 'j':
                    e.preventDefault();
                    window.location.href = 'players/index.php';
                    break;
                case 'k':
                    e.preventDefault();
                    document.getElementById('quickSearchInput')?.focus();
                    break;
            }
        }

        if (e.ctrlKey && e.key === 'k') {
            e.preventDefault();
            document.getElementById('quickSearchInput')?.focus();
        }
    });
}

// Initialize All
document.addEventListener('DOMContentLoaded', () => {
    new AdminThemeManager();
    new SidebarManager();
    new QuickSearch();
    initUserMenu();
    initAlerts();
    initKeyboardShortcuts();
});

// Export utilities
window.AdminUtils = {
    setLoading
};
