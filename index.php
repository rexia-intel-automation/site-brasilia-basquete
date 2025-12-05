<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Brasília Basquete - MONUMENTAL!</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- CHAT BUTTON (Floating) -->
    <a href="https://primary-production-55af6.up.railway.app/webhook/532cd781-988a-45b3-a190-fd18a6c999e5/chat" target="_blank" class="chat-button" aria-label="Chat">
        <img src="https://i.imgur.com/bgExqAD.png" alt="Chat">
    </a>

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
                <li><a href="#inicio">Início</a></li>
                <li><a href="#elenco">Elenco</a></li>
                <li><a href="#recordes">Recordes</a></li>
            </ul>

            <div class="logo-container">
                <a href="#inicio">
                    <img src="https://i.imgur.com/bgExqAD.png" alt="Brasília Basquete" class="logo">
                </a>
            </div>

            <ul class="nav-links right">
                <li><a href="#história">História</a></li>
                <li><a href="blog.php">Canal do Time</a></li>
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

    <!-- HERO SECTION -->
    <section class="hero" id="inicio">
        <div class="hero-content">
            <h1 class="hero-title">CAIXA BRASÍLIA BASQUETE</h1>
            <p class="hero-subtitle">MONUMENTAL!</p>
            <a href="#elenco" class="hero-cta">Conheça o Time</a>
        </div>
    </section>

    <!-- SPONSORS SECTION -->
    <section class="sponsors">
        <h2 class="sponsors-title">Nossos Patrocinadores</h2>
        <div class="sponsors-grid">
            <div class="sponsor-logo">
                <img src="https://caixabrasiliabasquete.com.br/wp-content/uploads/2024/12/Copia-de-caixa_azul-1024x232.png" alt="Caixa">
            </div>
            <div class="sponsor-logo">
                <img src="https://caixabrasiliabasquete.com.br/wp-content/uploads/2024/12/Copia-de-jade-horizontal-1-1024x319.png" alt="Jade Hotel">
            </div>
            <div class="sponsor-logo">
                <img src="https://imgur.com/NFE2P10.png" alt="Heavenly International School">
            </div>
            <div class="sponsor-logo">
                <img src="https://i.imgur.com/eFarzCB.png" alt="Gráfica Movimento">
            </div>
        </div>
    </section>

    <!-- ELENCO SECTION -->
    <section id="elenco">
        <h2 class="section-title">Elenco 2024/25</h2>
        <p class="section-subtitle">Os guerreiros do basquete brasiliense</p>

        <div class="carousel-container">
            <div class="carousel-track" id="carouselTrack">
                <!-- Players will be loaded dynamically via JavaScript -->
                <!-- Fallback static content -->
                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/NZ9MQQH.jpeg" alt="Mosquito">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#1</div>
                        <h3 class="player-name">Mosquito</h3>
                        <p class="player-position">Armador</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/DsFTwbS.jpeg" alt="Crescenzi">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#2</div>
                        <h3 class="player-name">Crescenzi</h3>
                        <p class="player-position">Ala-armador</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/I6A5l08.jpeg" alt="Gustavo">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#6</div>
                        <h3 class="player-name">Gustavo</h3>
                        <p class="player-position">Armador</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/Owsi001.jpeg" alt="Corvalán">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#7</div>
                        <h3 class="player-name">Corvalán</h3>
                        <p class="player-position">Ala-armador</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/1MSNOeq.jpeg" alt="Pedro">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#9</div>
                        <h3 class="player-name">Pedro</h3>
                        <p class="player-position">Ala</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/uxKFMhs.jpeg" alt="Lucas">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#10</div>
                        <h3 class="player-name">Lucas</h3>
                        <p class="player-position">Armador</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/tweN5FJ.jpeg" alt="Brunão">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#11</div>
                        <h3 class="player-name">Brunão</h3>
                        <p class="player-position">Pivô</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/xrxtgK5.jpeg" alt="Paulichi">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#13</div>
                        <h3 class="player-name">Paulichi</h3>
                        <p class="player-position">Ala-Pivô</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/PsFVGHd.jpeg" alt="Buiu">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#14</div>
                        <h3 class="player-name">Buiu</h3>
                        <p class="player-position">Ala-armador</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/FjIYznN.jpeg" alt="Carbonari">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#15</div>
                        <h3 class="player-name">Carbonari</h3>
                        <p class="player-position">Pivô</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/8HYz263.jpeg" alt="Zago">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#27</div>
                        <h3 class="player-name">Zago</h3>
                        <p class="player-position">Ala</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/eQdiXei.jpeg" alt="Von Haydin">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#30</div>
                        <h3 class="player-name">Von Haydin</h3>
                        <p class="player-position">Ala</p>
                    </div>
                </a>

                <a href="#" class="player-card">
                    <div class="player-image">
                        <img src="https://i.imgur.com/QcpuFl5.jpeg" alt="Beller">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#77</div>
                        <h3 class="player-name">Beller</h3>
                        <p class="player-position">Ala-Pivô</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="carousel-navigation">
            <button class="nav-button" id="prevBtn" aria-label="Anterior">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
            </button>
            <button class="nav-button" id="nextBtn" aria-label="Próximo">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </button>
        </div>
    </section>

    <!-- CTA APP SECTION -->
    <section class="cta-app">
        <div class="cta-content">
            <h2 class="cta-title">Baixe o App Oficial</h2>
            <p class="cta-description">Acompanhe jogos ao vivo, notícias exclusivas, estatísticas dos jogadores e muito mais. Tenha o Brasília Basquete na palma da sua mão!</p>
            <div class="app-buttons">
                <a href="#" class="app-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/>
                    </svg>
                    <span>App Store</span>
                </a>
                <a href="#" class="app-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                    </svg>
                    <span>Google Play</span>
                </a>
            </div>
        </div>
    </section>

    <!-- RECORDES SECTION -->
    <section id="recordes">
        <h2 class="section-title">Recordes Individuais no NBB</h2>
        <p class="section-subtitle">Lendas do basquete brasileiro</p>
        <div class="records-grid">
            <div class="record-card">
                <h2>Guilherme Giovannoni</h2>
                <div class="record-image-container">
                    <img src="https://i.imgur.com/2QnSGXY.png" alt="Guilherme Giovannoni">
                </div>
                <ul>
                    <li>5.072 pontos no NBB.</li>
                    <li>1.984 rebotes no NBB.</li>
                    <li>Jogou por 8 temporadas.</li>
                    <li>Tricampeão do NBB.</li>
                    <li>MVP em duas finais.</li>
                </ul>
            </div>

            <div class="record-card">
                <h2>Nezinho</h2>
                <div class="record-image-container">
                    <img src="https://i.imgur.com/s4N6zGc.png" alt="Nezinho">
                </div>
                <ul>
                    <li>1.509 assistências no NBB.</li>
                    <li>Jogou por 8 temporadas.</li>
                    <li>Tricampeão do NBB.</li>
                </ul>
            </div>

            <div class="record-card">
                <h2>Arthur</h2>
                <div class="record-image-container">
                    <img src="https://i.imgur.com/OZoAwh3.png" alt="Arthur">
                </div>
                <ul>
                    <li>380 jogos no NBB.</li>
                    <li>Jogou por 13 temporadas.</li>
                    <li>Único jogador presente em todos os títulos do Brasília Basquete.</li>
                    <li>Único atleta com a camisa aposentada pelo time.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- SPONSORS SECTION 2 -->
    <section class="sponsors">
        <h2 class="sponsors-title">Apoio</h2>
        <div class="sponsors-grid">
            <div class="sponsor-logo">
                <img src="https://caixabrasiliabasquete.com.br/wp-content/uploads/2024/12/Copia-de-caixa_azul-1024x232.png" alt="Caixa">
            </div>
            <div class="sponsor-logo">
                <img src="https://caixabrasiliabasquete.com.br/wp-content/uploads/2024/12/Copia-de-jade-horizontal-1-1024x319.png" alt="Jade Hotel">
            </div>
            <div class="sponsor-logo">
                <img src="https://imgur.com/NFE2P10.png" alt="Heavenly">
            </div>
            <div class="sponsor-logo">
                <img src="https://i.imgur.com/eFarzCB.png" alt="Gráfica Movimento">
            </div>
        </div>
    </section>

    <!-- HISTÓRIA SECTION -->
    <section id="história">
        <h2 class="section-title">História do Brasília Basquete</h2>
        <p class="section-subtitle">Décadas de tradição e conquistas</p>
        <div class="history-content">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2000–2003</div>
                        <p class="timeline-description">Fundação do Universo/Brasília (2000), projeto ligado à Universidade Salgado de Oliveira, levando Brasília ao cenário nacional.<br><br>
                        Em 2003, conquista da Supercopa do Brasil, abrindo caminho para o Campeonato Nacional.</p>
                        <img src="https://assets.zyrosite.com/YZ9EnnVP4kFWg320/2025.10.10_universo_01-YbN4LQBq9XuVZlPe.jpg" alt="Brasília Basquete 2000-2003" class="timeline-image">
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2004–2008</div>
                        <p class="timeline-description">Bicampeão da Supercopa (2004).<br><br>
                        2007 – Campeão Brasileiro (CBB) sob José Carlos Vidal, com recorde histórico de público no Nilson Nelson: 24.286 torcedores (01/05/2007).</p>
                        <img src="https://assets.zyrosite.com/YZ9EnnVP4kFWg320/copia-de-caixa_brasiliabasquete-1202x1536-Yle4L21XqMSo7oaD.png" alt="Brasília Basquete 2004-2008" class="timeline-image">
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2008–2009</div>
                        <p class="timeline-description">Título da Liga das Américas 2008/09 — primeiro clube brasileiro campeão do torneio continental.</p>
                        <img src="https://assets.zyrosite.com/YZ9EnnVP4kFWg320/copia-de-caixa_brasiliabasquete-1202x1536-Yle4L21XqMSo7oaD.png" alt="Liga das Américas" class="timeline-image">
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2009/2010</div>
                        <p class="timeline-description">Primeiro título do NBB.<br><br>
                        Técnico: Lula Ferreira. Campanha sólida e final vencida por 3–2 contra o Flamengo, com jogo decisivo em Anápolis (GO).</p>
                        <img src="https://i.imgur.com/RvYkpM1.jpeg" alt="Campeão 2009/2010" class="timeline-image">
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2010/2011</div>
                        <p class="timeline-description">Bicampeonato do NBB sob José Carlos Vidal. Finais contra o Franca no Ginásio Nilson Nelson, com mais de 16 mil torcedores.</p>
                        <img src="https://assets.zyrosite.com/YZ9EnnVP4kFWg320/brasiilia-campeaio-trofeiu_2010-2011-Aq2GM3Wqe3urvENK.jpg" alt="Bicampeão 2010/2011" class="timeline-image">
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2011/2012</div>
                        <p class="timeline-description">Tricampeonato do NBB. Base mantida (Nezinho, Alex, Arthur, Giovannoni, Cipriano). Vence São José na final e se consolida como potência nacional.</p>
                        <img src="https://i.imgur.com/faxcxL3.jpeg" alt="Tricampeão 2011/2012" class="timeline-image">
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2024/2025</div>
                        <p class="timeline-description">Melhor campanha desde o retorno: equipe termina a fase de classificação no top da tabela, em 4º lugar, reacendendo a esperança.</p>
                        <img src="https://assets.zyrosite.com/YZ9EnnVP4kFWg320/copia-de-caixa_brasiliabasquete-1202x1536-Yle4L21XqMSo7oaD.png" alt="Temporada 2024/2025" class="timeline-image">
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-year">2025/2026</div>
                        <h3 class="timeline-title">Temporada Monumental</h3>
                        <p class="timeline-description">25 anos do clube. Entrega dentro e fora das quadras, experiências na Arena BRB Nilson Nelson e conexão com a cidade.</p>
                        <img src="https://i.imgur.com/qF1dLbN.jpeg" alt="Temporada Monumental" class="timeline-image">
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-year">Títulos</div>
                        <h3 class="timeline-title">Conquistas Históricas</h3>
                        <p class="timeline-description">Tricampeão do NBB (2009/10, 2010/11, 2011/12).<br>
                        Campeão da Liga das Américas (2008/09).<br>
                        Tricampeão da Liga Sul-Americana (2010, 2013, 2015).<br>
                        Campeão Brasileiro (2006/2007 – CBB).<br><br>
                        Recorde de público do basquete brasileiro: 24.286 torcedores (01/05/2007).</p>
                        <img src="https://assets.zyrosite.com/YZ9EnnVP4kFWg320/copia-de-caixa_brasiliabasquete-1202x1536-Yle4L21XqMSo7oaD.png" alt="Conquistas" class="timeline-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Navegação</h3>
                <ul class="footer-links">
                    <li><a href="#inicio">Início</a></li>
                    <li><a href="#elenco">Elenco</a></li>
                    <li><a href="#recordes">Recordes</a></li>
                    <li><a href="#história">História</a></li>
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
