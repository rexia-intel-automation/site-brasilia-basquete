// Admin Panel JavaScript
// Brasília Basquete

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

// Sidebar Toggle
function initSidebar() {
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (toggle && sidebar) {
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
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

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    new AdminThemeManager();
    initSidebar();
    initAlerts();
});
