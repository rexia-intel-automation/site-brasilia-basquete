/* ===============================================
   BRASÍLIA BASQUETE - MAIN JAVASCRIPT
   Refatorado para Modularidade e Robustez
   =============================================== */

// ===========================================
// CONFIGURAÇÕES GLOBAIS
// ===========================================
const CONFIG = {
    api: {
        players: 'get-players.php' // Usa o endpoint PHP
    },
    carousel: {
        interval: 4000,
        transitionDuration: 500 // Deve bater com o CSS
    }
};

// ===========================================
// THEME MANAGEMENT
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
// NAVBAR & SCROLL
// ===========================================
function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 50);
    });
}

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
// PLAYER CAROUSEL (REFATORADO - CLASS BASED)
// ===========================================

class PlayerCarousel {
    constructor(trackId, dotsId) {
        this.track = document.getElementById(trackId);
        this.dotsContainer = document.getElementById(dotsId);
        
        if (!this.track) return;

        // Estado
        this.cards = [];
        this.totalOriginal = 0;
        this.currentIndex = 0;
        this.cardWidth = 0;
        this.gap = 0;
        this.autoPlayTimer = null;
        this.isDragging = false;
        this.startPos = 0;
        this.isTransitioning = false;

        // Bindings
        this.next = this.next.bind(this);
        this.prev = this.prev.bind(this);
        this.handleTransitionEnd = this.handleTransitionEnd.bind(this);
        
        this.loadData();
    }

    async loadData() {
        try {
            const response = await fetch(CONFIG.api.players);
            if (!response.ok) throw new Error('Falha na API de jogadores');
            
            const players = await response.json();
            this.render(players);
        } catch (error) {
            console.error('Erro ao carregar carrossel:', error);
            // Fallback opcional ou mensagem de erro na UI
            if (this.track) this.track.innerHTML = '<p style="color:white;text-align:center;width:100%">Não foi possível carregar o elenco.</p>';
        }
    }

    createCardHTML(player, isDuplicate = false) {
        return `
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
    }

    render(players) {
        let html = '';
        // Originais
        players.forEach(p => html += this.createCardHTML(p));
        // Duplicatas (Clone para loop infinito)
        players.forEach(p => html += this.createCardHTML(p, true));

        this.track.innerHTML = html;
        
        // Aguarda renderização para iniciar cálculos
        requestAnimationFrame(() => {
            this.init();
        });
    }

    init() {
        this.updateMetrics();
        this.createDots();
        this.addEventListeners();
        this.startAutoPlay();
        
        // Listener para redimensionamento
        window.addEventListener('resize', window.BrasiliaBasquete.debounce(() => {
            this.updateMetrics();
            this.updatePosition(false);
        }, 200));

        // Listener crítico para o loop infinito suave
        this.track.addEventListener('transitionend', this.handleTransitionEnd);
    }

    updateMetrics() {
        const allCards = Array.from(this.track.querySelectorAll('.player-card'));
        if (allCards.length === 0) return;

        this.cards = allCards;
        this.totalOriginal = this.cards.length / 2;
        
        const style = window.getComputedStyle(this.track);
        this.gap = parseFloat(style.gap) || 30;
        this.cardWidth = this.cards[0].offsetWidth;
    }

    updatePosition(animate = true) {
        const moveDistance = (this.cardWidth + this.gap) * this.currentIndex;
        
        this.track.style.transition = animate ? `transform ${CONFIG.carousel.transitionDuration}ms ease-out` : 'none';
        this.track.style.transform = `translateX(${-moveDistance}px)`;

        this.updateActiveClasses();
        this.updateDots();
    }

    updateActiveClasses() {
        this.cards.forEach(c => c.classList.remove('selected', 'active'));
        
        const realIndex = this.currentIndex % this.totalOriginal;
        
        // Marca o original e o clone como ativos
        if (this.cards[realIndex]) this.cards[realIndex].classList.add('active');
        if (this.cards[realIndex + this.totalOriginal]) this.cards[realIndex + this.totalOriginal].classList.add('active');
    }

    handleTransitionEnd() {
        if (!this.isTransitioning) return;

        // Loop Infinito: Direita -> Voltar para o início
        if (this.currentIndex >= this.totalOriginal) {
            this.track.style.transition = 'none';
            this.currentIndex = 0;
            this.updatePosition(false);
        }
        
        this.isTransitioning = false;
    }

    goTo(index) {
        if (this.isTransitioning) return;

        this.currentIndex = index;

        // Loop Infinito: Esquerda -> Pular para o final dos clones
        if (this.currentIndex < 0) {
            this.track.style.transition = 'none';
            this.currentIndex = this.totalOriginal; // Pula para o primeiro clone (que é igual ao index 0)
            this.updatePosition(false);
            
            // Força reflow
            void this.track.offsetWidth;
            
            // Agora anima para trás
            requestAnimationFrame(() => {
                this.isTransitioning = true;
                this.currentIndex = this.totalOriginal - 1;
                this.updatePosition(true);
            });
            return;
        }

        // Loop normal ou indo para o clone da direita
        if (this.currentIndex >= this.totalOriginal) {
            this.isTransitioning = true; // Marca flag para ser tratada no 'transitionend'
        }

        this.updatePosition(true);
    }

    next() {
        this.goTo(this.currentIndex + 1);
    }

    prev() {
        this.goTo(this.currentIndex - 1);
    }

    startAutoPlay() {
        this.stopAutoPlay();
        this.autoPlayTimer = setInterval(this.next, CONFIG.carousel.interval);
    }

    stopAutoPlay() {
        if (this.autoPlayTimer) clearInterval(this.autoPlayTimer);
    }

    // Controles de Dots (Bolinhas)
    createDots() {
        if (!this.dotsContainer) return;
        this.dotsContainer.innerHTML = '';
        
        for (let i = 0; i < this.totalOriginal; i++) {
            const dot = document.createElement('button');
            dot.className = 'carousel-dot';
            dot.ariaLabel = `Ir para jogador ${i + 1}`;
            dot.onclick = () => {
                this.stopAutoPlay();
                this.goTo(i);
                this.startAutoPlay();
            };
            this.dotsContainer.appendChild(dot);
        }
    }

    updateDots() {
        if (!this.dotsContainer) return;
        const dots = this.dotsContainer.children;
        const activeIndex = this.currentIndex % this.totalOriginal;
        
        for (let dot of dots) dot.classList.remove('active');
        if (dots[activeIndex]) dots[activeIndex].classList.add('active');
    }

    addEventListeners() {
        // Botões
        document.getElementById('prevBtn')?.addEventListener('click', (e) => {
            e.preventDefault();
            this.stopAutoPlay();
            this.prev();
            this.startAutoPlay();
        });

        document.getElementById('nextBtn')?.addEventListener('click', (e) => {
            e.preventDefault();
            this.stopAutoPlay();
            this.next();
            this.startAutoPlay();
        });

        // Mouse Hover
        this.track.addEventListener('mouseenter', () => this.stopAutoPlay());
        this.track.addEventListener('mouseleave', () => this.startAutoPlay());

        // Touch / Swipe
        this.track.addEventListener('touchstart', (e) => {
            this.startPos = e.touches[0].clientX;
            this.isDragging = true;
            this.stopAutoPlay();
        }, {passive: true});

        this.track.addEventListener('touchend', (e) => {
            if (!this.isDragging) return;
            const endPos = e.changedTouches[0].clientX;
            const diff = this.startPos - endPos;
            
            if (Math.abs(diff) > 50) {
                if (diff > 0) this.next();
                else this.prev();
            }
            
            this.isDragging = false;
            this.startAutoPlay();
        });
    }
}

// ===========================================
// OUTRAS INICIALIZAÇÕES
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

function initLoadMore() {
    const loadMoreBtn = document.querySelector('.load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const originalText = this.textContent;
            this.textContent = 'Carregando...';
            this.disabled = true;
            
            setTimeout(() => {
                this.textContent = originalText;
                this.disabled = false;
            }, 1000);
        });
    }
}

function initScrollAnimations() {
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target); // Para de observar após animar
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

function initMobileMenu() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    if (!menuToggle) return;
    
    // Lógica do menu mantida simplificada...
    const mobileMenu = document.querySelector('.nav-links.right'); // Exemplo de seletor
    // (A lógica original do menu estava ok, mantive o foco no refactor do carrossel)
    // ... inserir lógica do menu original aqui se necessário
}

// ===========================================
// BOOTSTRAP
// ===========================================

function init() {
    initNavbar();
    initSmoothScroll();
    initBlogFilters();
    initLoadMore();
    initScrollAnimations();
    
    // Inicializa Menu Mobile (chame a função original ou a refatorada)
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    if(menuToggle) {
        // ... (Insira a lógica de menu original aqui ou numa função separada)
        // Para brevidade, assumo que a função original initMobileMenu ainda existe no seu código
        // Se precisar dela refatorada também, me avise.
        initMobileMenuOriginal(); 
    }

    // Inicializa Carrossel
    if (document.getElementById('carouselTrack')) {
        window.playerCarousel = new PlayerCarousel('carouselTrack', 'carouselDots');
    }
}

// Função de debounce utilitária
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

// Helper para manter a compatibilidade com a função original do Menu se não quiser reescrever
function initMobileMenuOriginal() {
    // ... Copie o conteúdo da função initMobileMenu original aqui ...
    // Vou reinserir a versão original compactada para garantir funcionamento:
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
        if (socialLinks) mobileMenu.appendChild(socialLinks.cloneNode(true));
        document.body.appendChild(mobileMenu);
    }
    function closeMenu() {
        menuToggle.classList.remove('active');
        mobileMenu.classList.remove('show');
        overlay.classList.remove('active');
        body.classList.remove('menu-open');
        setTimeout(() => mobileMenu.classList.remove('mobile-active'), 300);
    }
    menuToggle.onclick = (e) => {
        e.stopPropagation();
        if (menuToggle.classList.contains('active')) closeMenu();
        else {
            menuToggle.classList.add('active');
            mobileMenu.classList.add('mobile-active');
            overlay.classList.add('active');
            body.classList.add('menu-open');
            setTimeout(() => mobileMenu.classList.add('show'), 10);
        }
    };
    overlay.onclick = closeMenu;
    mobileMenu.querySelectorAll('a').forEach(l => l.onclick = closeMenu);
}

window.BrasiliaBasquete = {
    themeManager,
    debounce
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
