<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canal do Time - Caixa Brasília Basquete</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- THEME TOGGLE (Floating Button) -->
    <button class="theme-toggle" id="themeToggle" aria-label="Alternar modo claro/escuro">
        <svg class="theme-icon sun" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="4"/>
            <path d="M12 2v2"/>
            <path d="M12 20v2"/>
            <path d="m4.93 4.93 1.41 1.41"/>
            <path d="m17.66 17.66 1.41 1.41"/>
            <path d="M2 12h2"/>
            <path d="M20 12h2"/>
            <path d="m6.34 17.66-1.41 1.41"/>
            <path d="m19.07 4.93-1.41 1.41"/>
        </svg>
        <svg class="theme-icon moon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
        </svg>
    </button>

    <!-- NAVIGATION -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <ul class="nav-links left">
                <li><a href="index.php#inicio">Início</a></li>
                <li><a href="index.php#elenco">Elenco</a></li>
                <li><a href="index.php#recordes">Recordes</a></li>
            </ul>

            <div class="logo-container">
                <a href="index.php">
                    <img src="https://i.imgur.com/bgExqAD.png" alt="Brasília Basquete" class="logo">
                </a>
            </div>

            <ul class="nav-links right">
                <li><a href="index.php#história">História</a></li>
                <li><a href="blog.php" class="active">Canal do Time</a></li>
                <li class="social-links">
                    <a href="https://www.instagram.com/brasilia.basquete/" target="_blank" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                        </svg>
                    </a>
                    <a href="https://www.tiktok.com/@brasilia.basquete" target="_blank" aria-label="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/@CaixaBrasiliaBasquete" target="_blank" aria-label="YouTube">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/>
                            <path d="m10 15 5-3-5-3z"/>
                        </svg>
                    </a>
                    <a href="https://x.com/brasiliabasquet" target="_blank" aria-label="X/Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4l11.733 16h4.267l-11.733 -16z"/>
                            <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/>
                        </svg>
                    </a>
                </li>
            </ul>

            <div class="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- BLOG HERO -->
    <section class="blog-hero">
        <div class="blog-hero-content">
            <h1 class="blog-title">Canal do Time</h1>
            <p class="blog-subtitle">Notícias, bastidores e conteúdo exclusivo</p>
        </div>
    </section>

    <!-- FILTERS -->
    <section class="blog-filters">
        <div class="filters-container">
            <button class="filter-btn active">Todas</button>
            <button class="filter-btn">Notícias</button>
            <button class="filter-btn">Bastidores</button>
            <button class="filter-btn">Entrevistas</button>
            <button class="filter-btn">Jogos</button>
            <button class="filter-btn">Elenco</button>
        </div>
    </section>

    <!-- FEATURED POST -->
    <section class="featured-section">
        <div class="featured-container">
            <div class="section-label">Destaque</div>
            <article class="featured-post">
                <div class="featured-image">
                    <img src="https://i.imgur.com/qF1dLbN.jpeg" alt="Temporada Monumental">
                    <span class="featured-tag">Destaque</span>
                </div>
                <div class="featured-content">
                    <div class="featured-meta">
                        <span>28 Nov 2025</span>
                        <span>Notícias</span>
                    </div>
                    <h2 class="featured-title">Brasília Basquete Conquista 4º Lugar na Fase de Classificação</h2>
                    <p class="featured-excerpt">
                        Em uma temporada histórica, o Caixa Brasília Basquete alcançou sua melhor campanha desde o retorno ao NBB, terminando a fase de classificação na quarta posição da tabela. A equipe demonstrou evolução constante e reacendeu a esperança da torcida brasiliense de voltar aos dias de glória.
                    </p>
                    <a href="#" class="read-more">
                        Leia Mais
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                            <path d="m12 5 7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
        </div>
    </section>

    <!-- POSTS GRID -->
    <section class="posts-section">
        <div class="posts-container">
            <div class="section-label">Últimas Notícias</div>
            <div class="posts-grid">
                <!-- Post 1 -->
                <a href="#" class="post-card">
                    <div class="post-image">
                        <img src="https://i.imgur.com/RvYkpM1.jpeg" alt="Título NBB 2009/2010">
                        <span class="post-tag">História</span>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span>27 Nov 2025</span>
                        </div>
                        <h3 class="post-title">Relembre a Conquista do Primeiro Título do NBB</h3>
                        <p class="post-excerpt">Uma olhada nostálgica na campanha histórica de 2009/2010 que marcou a primeira conquista do Brasília Basquete no Novo Basquete Brasil.</p>
                    </div>
                </a>

                <!-- Post 2 -->
                <a href="#" class="post-card">
                    <div class="post-image">
                        <img src="https://i.imgur.com/tweN5FJ.jpeg" alt="Brunão">
                        <span class="post-tag">Elenco</span>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span>26 Nov 2025</span>
                        </div>
                        <h3 class="post-title">Brunão: A Força do Garrafão do Brasília</h3>
                        <p class="post-excerpt">Conheça mais sobre o pivô que tem sido fundamental na campanha da equipe com sua presença física e liderança dentro de quadra.</p>
                    </div>
                </a>

                <!-- Post 3 -->
                <a href="#" class="post-card">
                    <div class="post-image">
                        <img src="https://i.imgur.com/NZ9MQQH.jpeg" alt="Mosquito">
                        <span class="post-tag">Entrevista</span>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span>25 Nov 2025</span>
                        </div>
                        <h3 class="post-title">Mosquito Fala Sobre a Temporada e Objetivos</h3>
                        <p class="post-excerpt">Em entrevista exclusiva, o armador #1 revela os bastidores da preparação e as expectativas para os playoffs do NBB.</p>
                    </div>
                </a>

                <!-- Post 4 -->
                <a href="#" class="post-card">
                    <div class="post-image">
                        <img src="https://assets.zyrosite.com/YZ9EnnVP4kFWg320/brasiilia-campeaio-trofeiu_2010-2011-Aq2GM3Wqe3urvENK.jpg" alt="Bicampeonato">
                        <span class="post-tag">História</span>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span>24 Nov 2025</span>
                        </div>
                        <h3 class="post-title">2010/2011: O Bicampeonato no Nilson Nelson</h3>
                        <p class="post-excerpt">Reviva os momentos épicos da segunda conquista consecutiva do NBB, com mais de 16 mil torcedores presentes na final.</p>
                    </div>
                </a>

                <!-- Post 5 -->
                <a href="#" class="post-card">
                    <div class="post-image">
                        <img src="https://i.imgur.com/DsFTwbS.jpeg" alt="Crescenzi">
                        <span class="post-tag">Jogos</span>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span>23 Nov 2025</span>
                        </div>
                        <h3 class="post-title">Crescenzi: Destaque na Vitória Sobre Minas</h3>
                        <p class="post-excerpt">O ala-armador #2 foi decisivo com 21 pontos e 7 assistências na importante vitória fora de casa contra o Minas Tênis Clube.</p>
                    </div>
                </a>

                <!-- Post 6 -->
                <a href="#" class="post-card">
                    <div class="post-image">
                        <img src="https://i.imgur.com/2QnSGXY.png" alt="Giovannoni">
                        <span class="post-tag">Recordes</span>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span>22 Nov 2025</span>
                        </div>
                        <h3 class="post-title">Giovannoni: A Lenda dos 5 Mil Pontos</h3>
                        <p class="post-excerpt">Relembre a trajetória de Guilherme Giovannoni, maior pontuador da história do Brasília Basquete no NBB com 5.072 pontos.</p>
                    </div>
                </a>

                <!-- Post 7 -->
                <a href="#" class="post-card">
                    <div class="post-image">
                        <img src="https://i.imgur.com/Owsi001.jpeg" alt="Corvalán">
                        <span class="post-tag">Bastidores</span>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span>21 Nov 2025</span>
                        </div>
                        <h3 class="post-title">Nos Bastidores do Treino com Corvalán</h3>
                        <p class="post-excerpt">Acompanhe um dia de treino intenso do ala-armador argentino e descubra os segredos da preparação física da equipe.</p>
                    </div>
                </a>

                <!-- Post 8 -->
                <a href="#" class="post-card">
                    <div class="post-image">
                        <img src="https://i.imgur.com/faxcxL3.jpeg" alt="Tricampeonato">
                        <span class="post-tag">História</span>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span>20 Nov 2025</span>
                        </div>
                        <h3 class="post-title">2011/2012: O Tricampeonato Histórico</h3>
                        <p class="post-excerpt">A conquista que consolidou o Brasília como potência nacional, com a base mantida e vitória sobre São José na final.</p>
                    </div>
                </a>

                <!-- Post 9 -->
                <a href="#" class="post-card">
                    <div class="post-image">
                        <img src="https://i.imgur.com/QcpuFl5.jpeg" alt="Beller">
                        <span class="post-tag">Elenco</span>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span>19 Nov 2025</span>
                        </div>
                        <h3 class="post-title">Beller #77: Versatilidade e Energia</h3>
                        <p class="post-excerpt">O ala-pivô se destaca pela versatilidade em ambas as extremidades da quadra e energia contagiante nos treinos e jogos.</p>
                    </div>
                </a>
            </div>

            <div class="load-more">
                <button class="load-more-btn">Carregar Mais Notícias</button>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Navegação</h3>
                <ul class="footer-links">
                    <li><a href="index.php#inicio">Início</a></li>
                    <li><a href="index.php#elenco">Elenco</a></li>
                    <li><a href="index.php#recordes">Recordes</a></li>
                    <li><a href="index.php#história">História</a></li>
                    <li><a href="blog.php">Canal do Time</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Redes Sociais</h3>
                <div class="footer-social">
                    <a href="https://www.instagram.com/brasilia.basquete/" target="_blank" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                        </svg>
                    </a>
                    <a href="https://www.tiktok.com/@brasilia.basquete" target="_blank" aria-label="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/@CaixaBrasiliaBasquete" target="_blank" aria-label="YouTube">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/>
                            <path d="m10 15 5-3-5-3z"/>
                        </svg>
                    </a>
                    <a href="https://x.com/brasiliabasquet" target="_blank" aria-label="X/Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4l11.733 16h4.267l-11.733 -16z"/>
                            <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Contato</h3>
                <ul class="footer-links">
                    <li><a href="mailto:suporte@bsbbkt.com.br">suporte@bsbbkt.com.br</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Institucional</h3>
                <ul class="footer-links">
                    <li><a href="termos.php">Termos e Condições</a></li>
                    <li><a href="privacidade.php">Política de Privacidade</a></li>
                    <li><a href="consentimento.php">Aviso de Consentimento</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-legal">
                <a href="termos.php">Termos e Condições</a>
                <a href="privacidade.php">Política de Privacidade</a>
                <a href="consentimento.php">Aviso de Consentimento</a>
            </div>
            <p class="footer-copyright">© 2025 Caixa Brasília Basquete. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="assets/js/main.js"></script>
</body>
</html>
