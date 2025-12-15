/* ===============================================
   BRASÍLIA BASQUETE - MAIN JAVASCRIPT
   Sistema completo de interatividade e dark/light mode
   =============================================== */

// ===========================================
// THEME MANAGEMENT (Dark/Light Mode)
// ===========================================

class ThemeManager {
    constructor() {
        this.theme = localStorage.getItem('theme') || 'dark';
        this.init();
    }

    init() {
        // Apply stored theme
        document.documentElement.setAttribute('data-theme', this.theme);

        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupToggle());
        } else {
            this.setupToggle();
        }
    }

    setupToggle() {
        const toggleBtn = document.getElementById('themeToggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => this.toggleTheme());
        }
    }

    toggleTheme() {
        this.theme = this.theme === 'light' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', this.theme);
        localStorage.setItem('theme', this.theme);
    }

    getTheme() {
        return this.theme;
    }
}

// Initialize theme manager
const themeManager = new ThemeManager();

// ===========================================
// NAVBAR SCROLL EFFECT
// ===========================================

function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

// ===========================================
// SMOOTH SCROLLING
// ===========================================

function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');

            // Ignore empty fragments and single #
            if (href === '#' || href.length <= 1) {
                e.preventDefault();
                return;
            }

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offsetTop = target.offsetTop - 100;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// ===========================================
// PLAYER CAROUSEL
// ===========================================

async function loadPlayers() {
    try {
        const response = await fetch('get-players.php');
        if (!response.ok) {
            console.warn('Could not load players from API');
            return;
        }

        const players = await response.json();
        const track = document.getElementById('carouselTrack');

        if (!track) return;

        // Clear existing content
        track.innerHTML = '';

        // Create player card HTML
        const createPlayerCard = (player) => {
            return `
                <a href="#" class="player-card" data-player="${player.number}">
                    <div class="player-image">
                        <img src="${player.photo}" alt="${player.name}"
                             onerror="this.src='https://via.placeholder.com/280x350/1A1A1A/FFFFFF?text=${player.number}'">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#${player.number}</div>
                        <h3 class="player-name">${player.name}</h3>
                        <p class="player-position">${player.position}</p>
                    </div>
                </a>
            `;
        };

        // Add players (first set)
        players.forEach(player => {
            track.innerHTML += createPlayerCard(player);
        });

        // Add players again (second set for infinite loop)
        players.forEach(player => {
            track.innerHTML += createPlayerCard(player);
        });

    } catch (error) {
        console.error('Error loading players:', error);
    }
}

function initCarousel() {
    const track = document.getElementById('carouselTrack');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (!track) return;

    let isPaused = false;

    // Previous button
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            track.style.animationPlayState = 'paused';
            isPaused = true;
            setTimeout(() => {
                if (isPaused) {
                    track.style.animationPlayState = 'running';
                    isPaused = false;
                }
            }, 3000);
        });
    }

    // Next button
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            track.style.animationPlayState = 'paused';
            isPaused = true;
            setTimeout(() => {
                if (isPaused) {
                    track.style.animationPlayState = 'running';
                    isPaused = false;
                }
            }, 3000);
        });
    }

    // Pause on hover
    track.addEventListener('mouseenter', () => {
        if (!isPaused) {
            track.style.animationPlayState = 'paused';
        }
    });

    track.addEventListener('mouseleave', () => {
        if (!isPaused) {
            track.style.animationPlayState = 'running';
        }
    });
}

// ===========================================
// BLOG FILTERS
// ===========================================

function initBlogFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));

            // Add active to clicked button
            this.classList.add('active');

            // Here you can add filtering logic if needed
            const category = this.textContent.trim();
            console.log('Filtering by:', category);
        });
    });
}

// ===========================================
// LOAD MORE BUTTON (Blog)
// ===========================================

function initLoadMore() {
    const loadMoreBtn = document.querySelector('.load-more-btn');

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            console.log('Loading more posts...');
            // Add your load more logic here

            // Example: show loading state
            this.textContent = 'Carregando...';

            setTimeout(() => {
                this.textContent = 'Carregar Mais Notícias';
            }, 1000);
        });
    }
}

// ===========================================
// INTERSECTION OBSERVER FOR ANIMATIONS
// ===========================================

function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const elementsToAnimate = document.querySelectorAll(
        '.record-card, .timeline-item, .sponsor-logo, .post-card'
    );

    elementsToAnimate.forEach(element => {
        // Set initial state
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

        // Start observing
        observer.observe(element);
    });
}

// ===========================================
// MOBILE MENU
// ===========================================

function initMobileMenu() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinksLeft = document.querySelector('.nav-links.left');
    const navLinksRight = document.querySelector('.nav-links.right');
    const body = document.body;

    // Create overlay if it doesn't exist
    let overlay = document.querySelector('.mobile-menu-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'mobile-menu-overlay';
        document.body.insertBefore(overlay, document.body.firstChild);
    }

    if (!menuToggle || !navLinksLeft || !navLinksRight) return;

    // Combine both nav-links for mobile
    const mobileMenu = navLinksLeft;

    function openMenu() {
        menuToggle.classList.add('active');
        mobileMenu.classList.add('mobile-active');
        overlay.classList.add('active');
        body.classList.add('menu-open');

        // Trigger animation
        setTimeout(() => {
            mobileMenu.classList.add('show');
        }, 10);
    }

    function closeMenu() {
        menuToggle.classList.remove('active');
        mobileMenu.classList.remove('show');
        overlay.classList.remove('active');
        body.classList.remove('menu-open');

        // Wait for animation before removing mobile-active
        setTimeout(() => {
            mobileMenu.classList.remove('mobile-active');
        }, 300);
    }

    // Toggle menu on button click
    menuToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        if (menuToggle.classList.contains('active')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    // Close menu when clicking overlay
    overlay.addEventListener('click', closeMenu);

    // Close menu when clicking on a link
    const menuLinks = mobileMenu.querySelectorAll('a:not(.social-links a)');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            closeMenu();
        });
    });

    // Close menu on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && menuToggle.classList.contains('active')) {
            closeMenu();
        }
    });

    // Close menu on window resize if open
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024 && menuToggle.classList.contains('active')) {
            closeMenu();
        }
    });
}

// ===========================================
// INITIALIZATION
// ===========================================

function init() {
    // Initialize all features
    initNavbar();
    initSmoothScroll();
    initCarousel();
    initBlogFilters();
    initLoadMore();
    initScrollAnimations();
    initMobileMenu();

    // Load players if on home page
    const carouselTrack = document.getElementById('carouselTrack');
    if (carouselTrack) {
        loadPlayers();
    }
}

// Wait for DOM to be ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

// ===========================================
// UTILITY FUNCTIONS
// ===========================================

// Debounce function for performance
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Export for use in other scripts if needed
window.BrasiliaBasquete = {
    themeManager,
    loadPlayers,
    debounce
};
