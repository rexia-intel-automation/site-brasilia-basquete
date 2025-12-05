<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso de Consentimento - Caixa Brasília Basquete</title>
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

        .nav-links a:hover {
            color: var(--primary-orange);
        }

        .nav-links a:hover::after {
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

        /* CONSENT PAGE CONTENT */
        .consent-hero {
            margin-top: 140px;
            padding: 80px 40px 60px;
            background: linear-gradient(135deg, var(--secondary-gray) 0%, var(--primary-black) 100%);
            border-bottom: 1px solid rgba(0, 92, 169, 0.2);
        }

        .consent-hero-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .consent-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(50px, 8vw, 80px);
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-orange) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
        }

        .consent-subtitle {
            font-size: 18px;
            color: var(--text-gray);
            letter-spacing: 1px;
        }

        .consent-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 80px 40px;
        }

        .consent-card {
            background: linear-gradient(135deg, rgba(0, 92, 169, 0.15) 0%, rgba(209, 125, 0, 0.15) 100%);
            border: 3px solid var(--primary-blue);
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 50px;
            box-shadow: 0 10px 40px rgba(0, 92, 169, 0.2);
        }

        .consent-intro {
            font-size: 19px;
            line-height: 1.9;
            color: var(--text-white);
            margin-bottom: 40px;
            text-align: center;
        }

        .consent-section {
            background: rgba(0, 0, 0, 0.3);
            border-left: 4px solid var(--primary-orange);
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 10px;
        }

        .consent-section h3 {
            font-family: 'Bebas Neue', cursive;
            font-size: 28px;
            color: var(--primary-orange);
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .consent-section ul {
            margin-left: 25px;
            margin-bottom: 15px;
        }

        .consent-section li {
            font-size: 17px;
            line-height: 1.8;
            color: var(--text-gray);
            margin-bottom: 12px;
        }

        .consent-section p {
            font-size: 17px;
            line-height: 1.8;
            color: var(--text-gray);
            margin-bottom: 15px;
        }

        .rights-box {
            background: rgba(209, 125, 0, 0.2);
            border: 2px solid var(--primary-orange);
            border-radius: 15px;
            padding: 35px;
            margin-top: 40px;
        }

        .rights-box h3 {
            font-family: 'Bebas Neue', cursive;
            font-size: 32px;
            color: var(--text-white);
            margin-bottom: 25px;
            text-align: center;
        }

        .rights-box ul {
            list-style: none;
            margin: 0;
        }

        .rights-box li {
            font-size: 18px;
            line-height: 1.8;
            color: var(--text-white);
            margin-bottom: 15px;
            padding-left: 35px;
            position: relative;
        }

        .rights-box li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--primary-orange);
            font-weight: bold;
            font-size: 24px;
        }

        .contact-box {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #0070c9 100%);
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            margin-top: 60px;
            box-shadow: 0 15px 50px rgba(0, 92, 169, 0.4);
        }

        .contact-box h3 {
            font-family: 'Bebas Neue', cursive;
            font-size: 36px;
            margin-bottom: 20px;
            color: var(--text-white);
        }

        .contact-box p {
            font-size: 18px;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.95);
        }

        .contact-email {
            display: inline-block;
            padding: 18px 50px;
            background: var(--primary-orange);
            color: var(--text-white);
            text-decoration: none;
            font-weight: 700;
            font-size: 20px;
            letter-spacing: 1px;
            border-radius: 35px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(209, 125, 0, 0.4);
        }

        .contact-email:hover {
            background: var(--text-white);
            color: var(--primary-blue);
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(255, 255, 255, 0.4);
        }

        .lgpd-badge {
            text-align: center;
            margin-top: 50px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
        }

        .lgpd-badge p {
            font-size: 16px;
            color: var(--text-gray);
            margin-bottom: 10px;
        }

        .lgpd-badge strong {
            font-size: 18px;
            color: var(--primary-orange);
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

            .consent-hero {
                margin-top: 100px;
                padding: 60px 20px 40px;
            }

            .consent-content {
                padding: 60px 20px;
            }

            .consent-card {
                padding: 30px 20px;
            }

            .consent-section {
                padding: 25px 20px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        /* CHAT BUTTON (Floating) */
        .chat-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
            box-shadow: 0 4px 20px rgba(0, 92, 169, 0.4);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .chat-button:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 30px rgba(0, 92, 169, 0.6);
        }

        .chat-button img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }

        @media (max-width: 768px) {
            .chat-button {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
            }

            .chat-button img {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <!-- CHAT BUTTON (Floating) -->
    <a href="https://primary-production-55af6.up.railway.app/webhook/532cd781-988a-45b3-a190-fd18a6c999e5/chat" class="chat-button" aria-label="Chat" onclick="event.preventDefault(); window.open(this.href, 'ChatPopup', 'width=400,height=600,resizable=yes,scrollbars=yes'); return false;">
        <img src="https://i.imgur.com/bgExqAD.png" alt="Chat">
    </a>

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
                <li><a href="blog.html">Canal do Time</a></li>
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

    <!-- HERO -->
    <section class="consent-hero">
        <div class="consent-hero-content">
            <h1 class="consent-title">Aviso de Consentimento</h1>
            <p class="consent-subtitle">Proteção de Dados e LGPD</p>
        </div>
    </section>

    <!-- CONTENT -->
    <main class="consent-content">
        <div class="consent-card">
            <p class="consent-intro">
                Ao fornecer seus dados e clicar em "Confirmar", você declara estar ciente e concorda voluntariamente com:
            </p>

            <div class="consent-section">
                <h3>Tratamento de Dados Pessoais</h3>
                <p>O tratamento de seus dados pessoais pelo Brasília Basquete (LB Produções LTDA, CNPJ nº 11.923.946/0001-46), conforme as finalidades descritas em nossa Política de Privacidade.</p>
            </div>

            <div class="consent-section">
                <h3>Comunicações do Clube</h3>
                <p>O recebimento de comunicações sobre:</p>
                <ul>
                    <li>Jogos e partidas do Brasília Basquete</li>
                    <li>Eventos especiais e comemorações</li>
                    <li>Promoções exclusivas para torcedores</li>
                    <li>Produtos oficiais do Clube</li>
                    <li>Novidades e atualizações importantes</li>
                </ul>
            </div>

            <div class="consent-section">
                <h3>Reconhecimento Facial - Dado Sensível</h3>
                <p>O tratamento da sua imagem (foto), considerada dado sensível, para fins exclusivos de:</p>
                <ul>
                    <li>Reconhecimento facial no Ginásio Nilson Nelson</li>
                    <li>Acesso seguro e controlado aos eventos</li>
                    <li>Prevenção à fraude e garantia da segurança</li>
                </ul>
                <p>Com base no art. 11, I e II, "g" da Lei Geral de Proteção de Dados (LGPD).</p>
            </div>

            <div class="rights-box">
                <h3>Seus Direitos</h3>
                <p style="text-align: center; margin-bottom: 25px; color: rgba(255, 255, 255, 0.9);">
                    Você poderá, a qualquer momento, solicitar:
                </p>
                <ul>
                    <li>O cancelamento de seu cadastro</li>
                    <li>A exclusão ou anonimização de seus dados pessoais</li>
                    <li>A revogação do consentimento, sem prejuízo do tratamento realizado até então</li>
                    <li>Confirmação da existência de tratamento de dados</li>
                    <li>Acesso aos seus dados armazenados</li>
                    <li>Correção de dados incompletos, inexatos ou desatualizados</li>
                </ul>
            </div>
        </div>

        <div class="contact-box">
            <h3>Exercer Seus Direitos</h3>
            <p>Para exercer qualquer um de seus direitos previstos na LGPD, entre em contato com nosso Encarregado de Dados</p>
            <a href="mailto:supervisor@bsbbkt.com.br" class="contact-email">supervisor@bsbbkt.com.br</a>
        </div>

        <div class="lgpd-badge">
            <p>Este documento está em conformidade com:</p>
            <strong>Lei Geral de Proteção de Dados - LGPD (Lei nº 13.709/2018)</strong>
        </div>
    </main>

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
                    <li><a href="mailto:suporte@bsbbkt.com.br">suporte@bsbbkt.com.br</a></li>
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

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
