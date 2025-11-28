<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canal do Time - Caixa Brasília Basquete</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #005CA9;
            --primary-orange: #D17D00;
            --primary-black: #0A0A0A;
            --secondary-gray: #1A1A1A;
            --accent-blue-light: #B8DDFF;
            --text-white: #FFFFFF;
            --text-gray: #CCCCCC;
        }

        body {
            font-family: 'Rajdhani', sans-serif;
            background: var(--primary-black);
            color: var(--text-white);
            overflow-x: hidden;
        }

        /* MENU NAVIGATION */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: linear-gradient(180deg, rgba(10, 10, 10, 0.98) 0%, rgba(10, 10, 10, 0.85) 100%);
            backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid rgba(0, 92, 169, 0.1);
        }

        .navbar.scrolled {
            background: rgba(10, 10, 10, 0.95);
            box-shadow: 0 4px 30px rgba(0, 92, 169, 0.1);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 140px;
            transition: height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar.scrolled .nav-container {
            height: 100px;
        }

        .logo-container {
            flex: 1;
            display: flex;
            justify-content: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .logo {
            height: 120px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 4px 20px rgba(0, 92, 169, 0.3));
        }

        .navbar.scrolled .logo {
            height: 80px;
        }

        .nav-links {
            display: flex;
            gap: 45px;
            list-style: none;
            align-items: center;
        }

        .nav-links.left {
            flex: 1;
            justify-content: flex-end;
            padding-right: 200px;
        }

        .nav-links.right {
            flex: 1;
            justify-content: flex-start;
            padding-left: 200px;
        }

        .nav-links a {
            color: var(--text-white);
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-orange);
            transition: width 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary-orange);
        }

        .nav-links a:hover::after,
        .nav-links a.active::after {
            width: 100%;
        }

        .social-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .social-links a {
            color: var(--text-white);
            font-size: 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid rgba(0, 92, 169, 0.3);
        }

        .social-links a:hover {
            color: var(--primary-orange);
            border-color: var(--primary-orange);
            transform: translateY(-3px);
        }

        /* BLOG HERO */
        .blog-hero {
            margin-top: 140px;
            padding: 80px 40px 60px;
            background: linear-gradient(135deg, var(--secondary-gray) 0%, var(--primary-black) 100%);
            border-bottom: 1px solid rgba(0, 92, 169, 0.2);
        }

        .blog-hero-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        .blog-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(50px, 8vw, 90px);
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-orange) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
        }

        .blog-subtitle {
            font-size: 20px;
            color: var(--text-gray);
            letter-spacing: 2px;
        }

        /* BLOG FILTERS */
        .blog-filters {
            padding: 40px 40px 20px;
            background: var(--primary-black);
            border-bottom: 1px solid rgba(0, 92, 169, 0.1);
        }

        .filters-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 12px 30px;
            background: transparent;
            border: 2px solid rgba(0, 92, 169, 0.3);
            color: var(--text-white);
            font-family: 'Rajdhani', sans-serif;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-orange);
            border-color: var(--primary-orange);
            transform: translateY(-2px);
        }

        /* FEATURED POST */
        .featured-section {
            padding: 60px 40px;
            background: var(--secondary-gray);
        }

        .featured-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-label {
            font-family: 'Bebas Neue', cursive;
            font-size: 24px;
            color: var(--primary-orange);
            letter-spacing: 3px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-orange) 0%, transparent 100%);
        }

        .featured-post {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 40px;
            background: var(--primary-black);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(0, 92, 169, 0.2);
            transition: all 0.4s ease;
        }

        .featured-post:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 92, 169, 0.3);
            border-color: var(--primary-orange);
        }

        .featured-image {
            position: relative;
            overflow: hidden;
            height: 500px;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .featured-post:hover .featured-image img {
            transform: scale(1.05);
        }

        .featured-tag {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--primary-orange);
            color: var(--text-white);
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .featured-content {
            padding: 50px 40px 50px 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .featured-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            font-size: 14px;
            color: var(--text-gray);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .featured-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 48px;
            line-height: 1.1;
            margin-bottom: 20px;
            color: var(--text-white);
        }

        .featured-excerpt {
            font-size: 18px;
            line-height: 1.8;
            color: var(--text-gray);
            margin-bottom: 30px;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 40px;
            background: var(--primary-blue);
            color: var(--text-white);
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-radius: 30px;
            transition: all 0.3s ease;
            align-self: flex-start;
        }

        .read-more:hover {
            background: var(--primary-orange);
            transform: translateX(5px);
        }

        /* POSTS GRID */
        .posts-section {
            padding: 60px 40px;
            background: var(--primary-black);
        }

        .posts-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 60px;
        }

        .post-card {
            background: var(--secondary-gray);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(0, 92, 169, 0.2);
            transition: all 0.4s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .post-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-orange);
            box-shadow: 0 20px 60px rgba(209, 125, 0, 0.3);
        }

        .post-image {
            position: relative;
            width: 100%;
            height: 280px;
            overflow: hidden;
        }

        .post-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .post-card:hover .post-image img {
            transform: scale(1.1);
        }

        .post-tag {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: var(--primary-orange);
            color: var(--text-white);
            padding: 6px 15px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .post-content {
            padding: 30px;
        }

        .post-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 13px;
            color: var(--text-gray);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .post-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 28px;
            line-height: 1.2;
            margin-bottom: 12px;
            color: var(--text-white);
        }

        .post-excerpt {
            font-size: 16px;
            line-height: 1.6;
            color: var(--text-gray);
        }

        .load-more {
            text-align: center;
            margin-top: 40px;
        }

        .load-more-btn {
            display: inline-block;
            padding: 18px 50px;
            background: transparent;
            border: 2px solid var(--primary-blue);
            color: var(--text-white);
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .load-more-btn:hover {
            background: var(--primary-blue);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 92, 169, 0.4);
        }

        /* FOOTER */
        footer {
            background: var(--primary-black);
            padding: 80px 40px 40px;
            border-top: 1px solid rgba(0, 92, 169, 0.2);
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 60px;
            margin-bottom: 60px;
        }

        .footer-section h3 {
            font-family: 'Bebas Neue', cursive;
            font-size: 28px;
            margin-bottom: 25px;
            color: var(--primary-orange);
            letter-spacing: 2px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--primary-orange);
            transform: translateX(5px);
        }

        .footer-social {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .footer-social a {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 92, 169, 0.1);
            border: 2px solid rgba(0, 92, 169, 0.3);
            border-radius: 50%;
            color: var(--text-white);
            text-decoration: none;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            background: var(--primary-orange);
            border-color: var(--primary-orange);
            transform: translateY(-5px);
        }

        .footer-bottom {
            padding-top: 40px;
            border-top: 1px solid rgba(0, 92, 169, 0.1);
            text-align: center;
        }

        .footer-legal {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .footer-legal a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-legal a:hover {
            color: var(--primary-orange);
        }

        .footer-copyright {
            color: var(--text-gray);
            font-size: 14px;
            margin-top: 20px;
        }

        /* MOBILE MENU */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            z-index: 1001;
        }

        .mobile-menu-toggle span {
            width: 30px;
            height: 3px;
            background: var(--text-white);
            transition: all 0.3s ease;
            border-radius: 3px;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .nav-links.left,
            .nav-links.right {
                display: none;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .logo-container {
                position: static;
                transform: none;
            }

            .nav-container {
                justify-content: space-between;
            }

            .featured-post {
                grid-template-columns: 1fr;
            }

            .featured-image {
                height: 400px;
            }

            .featured-content {
                padding: 40px;
            }

            .posts-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                padding: 0 20px;
                height: 100px;
            }

            .navbar.scrolled .nav-container {
                height: 80px;
            }

            .logo {
                height: 90px;
            }

            .navbar.scrolled .logo {
                height: 60px;
            }

            .blog-hero {
                margin-top: 100px;
                padding: 60px 20px 40px;
            }

            .blog-filters,
            .featured-section,
            .posts-section {
                padding: 40px 20px;
            }

            .posts-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .featured-title {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <!-- NAVIGATION -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <ul class="nav-links left">
                <li><a href="index.html#inicio">Início</a></li>
                <li><a href="index.html#elenco">Elenco</a></li>
                <li><a href="index.html#recordes">Recordes</a></li>
            </ul>

            <div class="logo-container">
                <a href="index.html">
                    <img src="https://i.imgur.com/bgExqAD.png" alt="Brasília Basquete" class="logo">
                </a>
            </div>

            <ul class="nav-links right">
                <li><a href="index.html#história">História</a></li>
                <li><a href="blog.html" class="active">Canal do Time</a></li>
                <li class="social-links">
                    <a href="https://www.instagram.com/brasilia.basquete/" target="_blank" aria-label="Instagram">📷</a>
                    <a href="https://www.tiktok.com/@brasilia.basquete" target="_blank" aria-label="TikTok">🎵</a>
                    <a href="https://www.youtube.com/@CaixaBrasiliaBasquete" target="_blank" aria-label="YouTube">▶</a>
                    <a href="https://x.com/brasiliabasquet" target="_blank" aria-label="X/Twitter">✖</a>
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
                    <a href="#" class="read-more">Leia Mais</a>
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
                    <li><a href="index.html#inicio">Início</a></li>
                    <li><a href="index.html#elenco">Elenco</a></li>
                    <li><a href="index.html#recordes">Recordes</a></li>
                    <li><a href="index.html#história">História</a></li>
                    <li><a href="blog.html">Canal do Time</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Redes Sociais</h3>
                <div class="footer-social">
                    <a href="https://www.instagram.com/brasilia.basquete/" target="_blank" aria-label="Instagram">📷</a>
                    <a href="https://www.tiktok.com/@brasilia.basquete" target="_blank" aria-label="TikTok">🎵</a>
                    <a href="https://www.youtube.com/@CaixaBrasiliaBasquete" target="_blank" aria-label="YouTube">▶</a>
                    <a href="https://x.com/brasiliabasquet" target="_blank" aria-label="X/Twitter">✖</a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Contato</h3>
                <ul class="footer-links">
                    <li><a href="/cdn-cgi/l/email-protection#d3a0a6a3bca1a7b693b1a0b1b1b8a7fdb0bcbefdb1a1"><span class="__cf_email__" data-cfemail="e29197928d909687a2809180808996cc818d8fcc8090">[email&#160;protected]</span></a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Institucional</h3>
                <ul class="footer-links">
                    <li><a href="termos.html">Termos e Condições</a></li>
                    <li><a href="privacidade.html">Política de Privacidade</a></li>
                    <li><a href="consentimento.html">Aviso de Consentimento</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-legal">
                <a href="termos.html">Termos e Condições</a>
                <a href="privacidade.html">Política de Privacidade</a>
                <a href="consentimento.html">Aviso de Consentimento</a>
            </div>
            <p class="footer-copyright">© 2025 Caixa Brasília Basquete. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Filter buttons
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Load more functionality
        const loadMoreBtn = document.querySelect
