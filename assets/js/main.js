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
        // Nota: Ajuste o caminho ('assets/data/players.json' ou 'get-players.php') conforme sua estrutura real
        const response = await fetch('assets/data/players.json'); 
        if (!response.ok) throw new Error('Erro ao carregar jogadores');

        const players = await response.json();
        const track = document.getElementById('carouselTrack');
        if (!track) return;

        const createCardHTML = (player, isDuplicate = false) => `
            <a href="#" class="player-card" data-player="${player.number}" ${isDuplicate ? 'aria-hidden="true" tabindex="-1"' : ''}>
                <div class="player-image">
                    <img src="${player.photo}" alt="${player.name}" loading="lazy" onerror="this.parentElement.classList.add('no-image'); this.style.display='none'">
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

        let htmlContent = '';
        players.forEach(p => htmlContent += createCardHTML(p));
        players.forEach(p => htmlContent += createCardHTML(p, true));

        track.innerHTML = htmlContent;
        initCarousel(); 

    } catch (error) {
        console.error('Erro:', error);
    }
}

function initCarousel() {
    const track = document.getElementById('carouselTrack');
    const dotsContainer = document.getElementById('carouselDots');
    if (!track) return;

    let cards = [];
    let cardWidth = 0;
    let gap = 0;
    let totalOriginalCards = 0;
    let currentIndex = 0;
    let autoPlayInterval;
    let isDragging = false;
    let startPos = 0;

    function updateMetrics() {
        const allCards = Array.from(track.querySelectorAll('.player-card'));
        if (allCards.length === 0) return;
        
        cards = allCards;
        totalOriginalCards = cards.length / 2;
        
        const style = window.getComputedStyle(track);
        gap = parseFloat(style.gap) || 30;
        cardWidth = cards[0].getBoundingClientRect().width;
        
        updatePosition();
    }

    function updatePosition(smooth = true) {
        const moveDistance = (cardWidth + gap) * currentIndex;
        const offset = -moveDistance;

        track.style.transition = smooth ? 'transform 0.5s ease-out' : 'none';
        track.style.transform = `translateX(${offset}px)`;

        cards.forEach(c => c.classList.remove('selected', 'active'));
        
        const activeCardIndex = currentIndex % totalOriginalCards;
        if (cards[activeCardIndex]) cards[activeCardIndex].classList.add('active');
        if (cards[activeCardIndex + totalOriginalCards]) cards[activeCardIndex + totalOriginalCards].classList.add('active');

        updateDots(activeCardIndex);
    }

    function createDots() {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        for (let i = 0; i < totalOriginalCards; i++) {
            const dot = document.createElement('button');
            dot.className = 'carousel-dot';
            dot.ariaLabel = `Ir para slide ${i + 1}`;
            dot.onclick = () => goToIndex(i);
            dotsContainer.appendChild(dot);
        }
    }

    function updateDots(index) {
        if (!dotsContainer) return;
        const dots = dotsContainer.children;
        for (let dot of dots) dot.classList.remove('active');
        if (dots[index]) dots[index].classList.add('active');
    }

    function goToIndex(index) {
        currentIndex = index;

        if (currentIndex >= cards.length) {
            currentIndex = 0;
            updatePosition(false);
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    currentIndex = 1;
                    updatePosition(true);
                });
            });
            return;
        } 
        
        if (currentIndex < 0) {
            currentIndex = totalOriginalCards * 2 - 1;
            updatePosition(false);
            return;
        }

        if (currentIndex === totalOriginalCards) {
            updatePosition(true);
            setTimeout(() => {
                currentIndex = 0;
                updatePosition(false);
            }, 500);
            return;
        }

        updatePosition(true);
    }

    function next() { goToIndex(currentIndex + 1); }
    function prev() { goToIndex(currentIndex - 1); }

    function startAutoPlay() {
        stopAutoPlay();
        autoPlayInterval = setInterval(next, 4000);
    }

    function stopAutoPlay() { clearInterval(autoPlayInterval); }

    document.getElementById('prevBtn')?.addEventListener('click', () => { prev(); startAutoPlay(); });
    document.getElementById('nextBtn')?.addEventListener('click', () => { next(); startAutoPlay(); });

    track.addEventListener('mouseenter', stopAutoPlay);
    track.addEventListener('mouseleave', startAutoPlay);
    
    track.addEventListener('touchstart', e => {
        startPos = e.touches[0].clientX;
        isDragging = true;
        stopAutoPlay();
    }, {passive: true});

    track.addEventListener('touchend', e => {
        if (!isDragging) return;
        const endPos = e.changedTouches[0].clientX;
        const diff = startPos - endPos;
        if (Math.abs(diff) > 50) {
            if (diff > 0) next();
            else prev();
        }
        isDragging = false;
        startAutoPlay();
    });

    window.addEventListener('resize', updateMetrics);

    setTimeout(() => {
        updateMetrics();
        createDots();
        startAutoPlay();
    }, 100);
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

        // Pausa a animação automática durante o touch
        if (isAutoMode) {
            track.style.animationPlayState = 'paused';
        }
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
            } else {
                // Swipe muito curto - retoma animação se estava em auto mode
                if (isAutoMode) {
                    track.style.animationPlayState = 'running';
                }
            }
        } else {
            // Swipe vertical - retoma animação se estava em auto mode
            if (isAutoMode) {
                track.style.animationPlayState = 'running';
            }
        }
    });

    // Cancela o touch se o usuário sair da área
    track.addEventListener('touchcancel', () => {
        if (isDragging) {
            isDragging = false;
            // Retoma animação se estava em auto mode
            if (isAutoMode) {
                track.style.animationPlayState = 'running';
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
