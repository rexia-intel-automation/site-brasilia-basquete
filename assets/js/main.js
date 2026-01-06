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
        document.documentElement.setAttribute('data-theme', this.theme);
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
}

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
            if (href === '#' || href.length <= 1) {
                e.preventDefault();
                return;
            }
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offsetTop = target.offsetTop - 100;
                window.scrollTo({ top: offsetTop, behavior: 'smooth' });
            }
        });
    });
}

// ===========================================
// PLAYER CAROUSEL (CORRIGIDO)
// ===========================================

async function loadPlayers() {
    try {
        const response = await fetch('assets/data/players.json'); 
        if (!response.ok) throw new Error('Erro ao carregar jogadores');

        const players = await response.json();
        const track = document.getElementById('carouselTrack');
        if (!track) return;

        // Função auxiliar para criar o HTML do card
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
        // Conjunto Original
        players.forEach(p => htmlContent += createCardHTML(p));
        // Conjunto Duplicado (para loop infinito)
        players.forEach(p => htmlContent += createCardHTML(p, true));

        track.innerHTML = htmlContent;
        
        // Pequeno delay para garantir que o DOM renderizou antes de calcular larguras
        setTimeout(() => initCarousel(), 100);

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
    let isTransitioning = false; // Nova flag para evitar conflitos

    function updateMetrics() {
        const allCards = Array.from(track.querySelectorAll('.player-card'));
        if (allCards.length === 0) return;
        
        cards = allCards;
        totalOriginalCards = cards.length / 2;
        
        // Pega o gap computado do CSS ou usa 30 como fallback
        const style = window.getComputedStyle(track);
        gap = parseFloat(style.gap) || 30;
        
        // Usa offsetWidth para garantir a largura correta incluindo paddings/borders se houver
        cardWidth = cards[0].offsetWidth;
        
        updatePosition(false); // Atualiza posição sem animação ao redimensionar
    }

    function updatePosition(smooth = true) {
        // Cálculo preciso da distância
        const moveDistance = (cardWidth + gap) * currentIndex;
        const offset = -moveDistance;

        track.style.transition = smooth ? 'transform 0.5s ease-out' : 'none';
        track.style.transform = `translateX(${offset}px)`;

        // Atualiza classes ativas para efeitos visuais
        cards.forEach(c => c.classList.remove('selected', 'active'));
        
        const activeCardIndex = currentIndex % totalOriginalCards;
        
        // Destaca o card atual no conjunto original e no duplicado
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
            dot.onclick = () => {
                stopAutoPlay();
                goToIndex(i);
                startAutoPlay();
            };
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
        if (isTransitioning) return; // Bloqueia se já estiver resetando o loop

        currentIndex = index;

        // LÓGICA DO LOOP INFINITO (DIREITA)
        if (currentIndex === totalOriginalCards) {
            // Move visualmente para o primeiro duplicado
            updatePosition(true);
            
            // Trava interações
            isTransitioning = true;

            // Aguarda o fim da transição CSS (500ms) e pula instantaneamente para o início real
            setTimeout(() => {
                track.style.transition = 'none';
                currentIndex = 0;
                // Recalcula posição no índice 0 instantaneamente
                const moveDistance = (cardWidth + gap) * currentIndex;
                track.style.transform = `translateX(${-moveDistance}px)`;
                
                // Libera interações
                isTransitioning = false;
            }, 500);
            return;
        }

        // LÓGICA DO LOOP INFINITO (ESQUERDA)
        if (currentIndex < 0) {
            isTransitioning = true;
            track.style.transition = 'none';
            // Pula instantaneamente para o fim do conjunto duplicado
            currentIndex = totalOriginalCards;
            const moveDistance = (cardWidth + gap) * currentIndex;
            track.style.transform = `translateX(${-moveDistance}px)`;

            // Força um reflow (atualização do navegador)
            void track.offsetWidth;

            // Anima de volta para o último card original
            setTimeout(() => {
                track.style.transition = 'transform 0.5s ease-out';
                currentIndex = totalOriginalCards - 1;
                updatePosition(true);
                isTransitioning = false;
            }, 10);
            return;
        }

        updatePosition(true);
    }

    function next() { 
        if (!isTransitioning) goToIndex(currentIndex + 1); 
    }
    
    function prev() { 
        if (!isTransitioning) goToIndex(currentIndex - 1); 
    }

    function startAutoPlay() {
        stopAutoPlay(); // Garante que não haja múltiplos intervalos
        autoPlayInterval = setInterval(next, 4000);
    }

    function stopAutoPlay() { 
        if (autoPlayInterval) clearInterval(autoPlayInterval); 
    }

    // Event Listeners dos Botões
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (prevBtn) {
        prevBtn.onclick = (e) => {
            e.preventDefault();
            stopAutoPlay();
            prev();
            startAutoPlay();
        };
    }
    
    if (nextBtn) {
        nextBtn.onclick = (e) => {
            e.preventDefault();
            stopAutoPlay();
            next();
            startAutoPlay();
        };
    }

    // Pausa no hover/touch
    track.addEventListener('mouseenter', stopAutoPlay);
    track.addEventListener('mouseleave', startAutoPlay);
    
    // Suporte a Touch (Swipe)
    track.addEventListener('touchstart', e => {
        startPos = e.touches[0].clientX;
        isDragging = true;
        stopAutoPlay();
    }, {passive: true});

    track.addEventListener('touchend', e => {
        if (!isDragging) return;
        const endPos = e.changedTouches[0].clientX;
        const diff = startPos - endPos;
        
        // Swipe threshold de 50px
        if (Math.abs(diff) > 50) {
            if (diff > 0) next();
            else prev();
        }
        
        isDragging = false;
        startAutoPlay();
    });

    // Resize Observer para manter métricas atualizadas
    window.addEventListener('resize', debounce(() => {
        updateMetrics();
        // Garante alinhamento correto após resize
        updatePosition(false);
    }, 200));

    // Inicialização
    setTimeout(() => {
        updateMetrics();
        createDots();
        startAutoPlay();
    }, 100);
}

// ===========================================
// BLOG FILTERS
// ===========================================

function initBlogFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
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
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    const elementsToAnimate = document.querySelectorAll('.record-card, .timeline-item, .sponsor-logo, .post-card');
    elementsToAnimate.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
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

    let overlay = document.querySelector('.mobile-menu-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'mobile-menu-overlay';
        document.body.insertBefore(overlay, document.body.firstChild);
    }

    if (!menuToggle || !navLinksLeft || !navLinksRight) return;

    let mobileMenu = document.querySelector('.mobile-menu-unified');
    if (!mobileMenu) {
        mobileMenu = document.createElement('ul');
        mobileMenu.className = 'nav-links mobile-menu-unified';

        const leftLinks = navLinksLeft.querySelectorAll('li:not(.social-links)');
        leftLinks.forEach(li => mobileMenu.appendChild(li.cloneNode(true)));

        const rightLinks = navLinksRight.querySelectorAll('li:not(.social-links)');
        rightLinks.forEach(li => mobileMenu.appendChild(li.cloneNode(true)));

        const socialLinks = navLinksRight.querySelector('.social-links');
        if (socialLinks) {
            mobileMenu.appendChild(socialLinks.cloneNode(true));
        }
        document.body.appendChild(mobileMenu);
    }

    function openMenu() {
        menuToggle.classList.add('active');
        mobileMenu.classList.add('mobile-active');
        overlay.classList.add('active');
        body.classList.add('menu-open');
        setTimeout(() => mobileMenu.classList.add('show'), 10);
    }

    function closeMenu() {
        menuToggle.classList.remove('active');
        mobileMenu.classList.remove('show');
        overlay.classList.remove('active');
        body.classList.remove('menu-open');
        setTimeout(() => mobileMenu.classList.remove('mobile-active'), 300);
    }

    menuToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        if (menuToggle.classList.contains('active')) closeMenu();
        else openMenu();
    });

    overlay.addEventListener('click', closeMenu);

    const menuLinks = mobileMenu.querySelectorAll('a:not(.social-links a)');
    menuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && menuToggle.classList.contains('active')) closeMenu();
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024 && menuToggle.classList.contains('active')) closeMenu();
    });
}

// ===========================================
// INITIALIZATION
// ===========================================

function init() {
    initNavbar();
    initSmoothScroll();
    initBlogFilters();
    initLoadMore();
    initScrollAnimations();
    initMobileMenu();

    const carouselTrack = document.getElementById('carouselTrack');
    if (carouselTrack) {
        loadPlayers();
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

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

window.BrasiliaBasquete = {
    themeManager,
    loadPlayers,
    debounce
};
