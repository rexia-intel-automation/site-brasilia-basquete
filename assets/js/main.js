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
                        <img src="${player.photo}"
                             alt="${player.name}"
                             loading="lazy"
                             onerror="this.style.display='none'; this.parentElement.classList.add('no-image');">
                        <div class="player-image-fallback">
                            <span class="player-number-large">#${player.number}</span>
                        </div>
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
    const dotsContainer = document.getElementById('carouselDots');

    if (!track) return;

    let currentIndex = 0;
    let selectedCard = null;
    let isAutoMode = true;
    let autoModeTimeout = null;
    let touchStartX = 0;
    let touchEndX = 0;
    let touchStartY = 0;
    let touchEndY = 0;
    let isDragging = false;

    function getCards() {
        const allCards = Array.from(track.querySelectorAll('.player-card'));
        return allCards.slice(0, Math.floor(allCards.length / 2));
    }

    function getCardDimensions() {
        const cards = getCards();
        if (cards.length === 0) return { width: 280, gap: 30 };

        const firstCard = cards[0];
        const cardWidth = firstCard.getBoundingClientRect().width;
        const computedStyle = window.getComputedStyle(track);
        const gap = parseFloat(computedStyle.gap) || 30;

        return { width: cardWidth, gap: gap };
    }

    function createDots() {
        if (!dotsContainer) return;

        const cards = getCards();
        dotsContainer.innerHTML = '';

        cards.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.className = 'carousel-dot';
            dot.setAttribute('aria-label', `Ir para jogador ${index + 1}`);

            if (index === 0) {
                dot.classList.add('active');
            }

            dot.addEventListener('click', () => {
                selectCard(index);
            });

            dotsContainer.appendChild(dot);
        });
    }

    function updateDots() {
        if (!dotsContainer) return;

        const dots = dotsContainer.querySelectorAll('.carousel-dot');
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    function centerCard(index, skipTransition = false) {
        const cards = getCards();
        const { width, gap } = getCardDimensions();
        const cardWidth = width + gap;
        const containerWidth = track.parentElement.offsetWidth;
        const offset = (containerWidth / 2) - (width / 2) - (index * cardWidth);

        track.style.animation = 'none';
        if (skipTransition) {
            track.style.transition = 'none';
        } else {
            track.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }
        track.style.transform = `translateX(${offset}px)`;
    }

    function selectCard(targetIndex) {
        const cards = getCards();
        const totalCards = cards.length;

        // Detecta transição primeiro <-> último para loop seamless
        if (currentIndex === 0 && targetIndex === -1) {
            // Primeiro -> Último
            jumpToCardSeamless(totalCards - 1, 'prev');
            return;
        } else if (currentIndex === totalCards - 1 && targetIndex === totalCards) {
            // Último -> Primeiro
            jumpToCardSeamless(0, 'next');
            return;
        }

        // Normaliza índice
        const normalizedIndex = ((targetIndex % totalCards) + totalCards) % totalCards;

        // Remove seleção anterior
        track.querySelectorAll('.player-card').forEach(c => {
            c.classList.remove('selected');
        });

        // Adiciona seleção ao card e duplicado
        const card = cards[normalizedIndex];
        card.classList.add('selected');

        const allCards = Array.from(track.querySelectorAll('.player-card'));
        const duplicateIndex = normalizedIndex + totalCards;
        if (allCards[duplicateIndex]) {
            allCards[duplicateIndex].classList.add('selected');
        }

        selectedCard = card;
        currentIndex = normalizedIndex;
        isAutoMode = false;

        centerCard(normalizedIndex);
        updateDots();
        startAutoModeTimer();
    }

    function jumpToCardSeamless(targetIndex, direction) {
        const cards = getCards();
        const totalCards = cards.length;

        // 1. Vai para o duplicado sem transição
        const duplicateOffset = direction === 'next' ? -totalCards : totalCards;
        centerCard(currentIndex + duplicateOffset, true);

        // 2. Força reflow
        track.offsetHeight;

        // 3. Atualiza index e vai para o card real com transição
        currentIndex = targetIndex;

        setTimeout(() => {
            // Remove seleção anterior
            track.querySelectorAll('.player-card').forEach(c => {
                c.classList.remove('selected');
            });

            // Adiciona seleção
            const card = cards[targetIndex];
            card.classList.add('selected');

            const allCards = Array.from(track.querySelectorAll('.player-card'));
            const duplicateIndex = targetIndex + totalCards;
            if (allCards[duplicateIndex]) {
                allCards[duplicateIndex].classList.add('selected');
            }

            selectedCard = card;
            isAutoMode = false;

            centerCard(targetIndex);
            updateDots();
            startAutoModeTimer();
        }, 10);
    }

    function startAutoModeTimer() {
        clearTimeout(autoModeTimeout);
        autoModeTimeout = setTimeout(() => {
            resetCarousel();
        }, 5000);
    }

    function resetCarousel() {
        track.querySelectorAll('.player-card').forEach(c => {
            c.classList.remove('selected');
        });
        selectedCard = null;
        isAutoMode = true;
        clearTimeout(autoModeTimeout);
        track.style.animation = '';
        track.style.transform = '';
        track.style.transition = '';
    }

    // Previous button
    if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            selectCard(currentIndex - 1);
        });
    }

    // Next button
    if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            selectCard(currentIndex + 1);
        });
    }

    // Touch support
    track.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
        isDragging = true;
    }, { passive: true });

    track.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        touchEndX = e.touches[0].clientX;
        touchEndY = e.touches[0].clientY;
    }, { passive: true });

    track.addEventListener('touchend', () => {
        if (!isDragging) return;
        isDragging = false;

        const swipeDistanceX = touchStartX - touchEndX;
        const swipeDistanceY = touchStartY - touchEndY;
        const threshold = 50;

        // Verifica se é swipe horizontal (evita conflito com scroll vertical)
        if (Math.abs(swipeDistanceX) > Math.abs(swipeDistanceY)) {
            if (Math.abs(swipeDistanceX) > threshold) {
                if (swipeDistanceX > 0) {
                    // Swipe left = next
                    selectCard(currentIndex + 1);
                } else {
                    // Swipe right = prev
                    selectCard(currentIndex - 1);
                }
            }
        }
    });

    // Click em um card para selecioná-lo
    track.addEventListener('click', (e) => {
        const card = e.target.closest('.player-card');
        if (card) {
            e.preventDefault();
            const cards = getCards();
            const allCards = Array.from(track.querySelectorAll('.player-card'));
            let index = allCards.indexOf(card);

            // Se for o duplicado, pega o índice original
            if (index >= cards.length) {
                index = index - cards.length;
            }

            selectCard(index);
        }
    });

    // Double click para voltar ao modo automático
    track.addEventListener('dblclick', (e) => {
        e.preventDefault();
        resetCarousel();
    });

    // Recalcula dimensões ao redimensionar
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            if (!isAutoMode && selectedCard) {
                centerCard(currentIndex, true);
            }
        }, 250);
    });

    // Inicializa dots
    createDots();
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

    // Create unified mobile menu container
    let mobileMenu = document.querySelector('.mobile-menu-unified');
    if (!mobileMenu) {
        mobileMenu = document.createElement('ul');
        mobileMenu.className = 'nav-links mobile-menu-unified';

        // Clone links from LEFT menu (Início, Elenco, Recordes)
        const leftLinks = navLinksLeft.querySelectorAll('li:not(.social-links)');
        leftLinks.forEach(li => {
            mobileMenu.appendChild(li.cloneNode(true));
        });

        // Clone links from RIGHT menu (História, Canal do Time)
        const rightLinks = navLinksRight.querySelectorAll('li:not(.social-links)');
        rightLinks.forEach(li => {
            mobileMenu.appendChild(li.cloneNode(true));
        });

        // Clone social links from RIGHT menu
        const socialLinks = navLinksRight.querySelector('.social-links');
        if (socialLinks) {
            mobileMenu.appendChild(socialLinks.cloneNode(true));
        }

        // Insert mobile menu into DOM
        document.body.appendChild(mobileMenu);
    }

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
