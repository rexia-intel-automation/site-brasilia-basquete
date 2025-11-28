<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidade - Caixa Brasília Basquete</title>
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

        /* LEGAL PAGE CONTENT */
        .legal-hero {
            margin-top: 140px;
            padding: 80px 40px 60px;
            background: linear-gradient(135deg, var(--secondary-gray) 0%, var(--primary-black) 100%);
            border-bottom: 1px solid rgba(0, 92, 169, 0.2);
        }

        .legal-hero-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .legal-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(50px, 8vw, 80px);
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-orange) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
        }

        .legal-subtitle {
            font-size: 18px;
            color: var(--text-gray);
            letter-spacing: 1px;
        }

        .legal-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 80px 40px;
        }

        .legal-section {
            background: rgba(255, 255, 255, 0.03);
            border-left: 4px solid var(--primary-orange);
            padding: 40px;
            margin-bottom: 40px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .legal-section:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(5px);
        }

        .legal-section h2 {
            font-family: 'Bebas Neue', cursive;
            font-size: 32px;
            color: var(--primary-blue);
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .legal-section h3 {
            font-size: 20px;
            color: var(--primary-orange);
            margin-top: 25px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .legal-section p {
            font-size: 17px;
            line-height: 1.8;
            color: var(--text-gray);
            margin-bottom: 20px;
        }

        .legal-section ul {
            margin-left: 25px;
            margin-bottom: 20px;
        }

        .legal-section li {
            font-size: 17px;
            line-height: 1.8;
            color: var(--text-gray);
            margin-bottom: 10px;
        }

        .highlight-box {
            background: rgba(0, 92, 169, 0.1);
            border: 2px solid var(--primary-blue);
            border-radius: 10px;
            padding: 25px;
            margin: 30px 0;
        }

        .highlight-box strong {
            color: var(--primary-orange);
        }

        .contact-info {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #0070c9 100%);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            margin-top: 60px;
        }

        .contact-info h3 {
            font-family: 'Bebas Neue', cursive;
            font-size: 32px;
            margin-bottom: 20px;
            color: var(--text-white);
        }

        .contact-info p {
            font-size: 18px;
            margin-bottom: 25px;
            color: rgba(255, 255, 255, 0.9);
        }

        .contact-email {
            display: inline-block;
            padding: 15px 40px;
            background: var(--primary-orange);
            color: var(--text-white);
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 1px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .contact-email:hover {
            background: var(--text-white);
            color: var(--primary-blue);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
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

            .legal-hero {
                margin-top: 100px;
                padding: 60px 20px 40px;
            }

            .legal-content {
                padding: 60px 20px;
            }

            .legal-section {
                padding: 30px 20px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
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
    <section class="legal-hero">
        <div class="legal-hero-content">
            <h1 class="legal-title">Política de Privacidade</h1>
            <p class="legal-subtitle">Atualizada em 28 de novembro de 2025</p>
        </div>
    </section>

    <!-- CONTENT -->
    <main class="legal-content">
        <div class="legal-section">
            <h2>1. Introdução</h2>
            <p>O Brasília Basquete valoriza a privacidade de seus torcedores e usuários. Esta Política descreve como coletamos, usamos, armazenamos e protegemos suas informações pessoais, em conformidade com a Lei Geral de Proteção de Dados – LGPD (Lei nº 13.709/2018).</p>
        </div>

        <div class="legal-section">
            <h2>2. Dados Coletados</h2>
            <p>Para fornecer nossos serviços, coletamos os seguintes dados pessoais:</p>
            <ul>
                <li><strong>Nome Completo</strong></li>
                <li><strong>CPF</strong></li>
                <li><strong>E-mail</strong></li>
                <li><strong>Telefone</strong></li>
                <li><strong>Foto</strong> (dado sensível, utilizado exclusivamente para reconhecimento facial e acesso ao Ginásio Nilson Nelson, com fundamento no consentimento e na finalidade de segurança)</li>
            </ul>
        </div>

        <div class="legal-section">
            <h2>3. Finalidades do Uso</h2>
            <p>Os dados pessoais coletados são utilizados para as seguintes finalidades:</p>
            <ul>
                <li>Comunicação oficial do Clube (novidades, promoções, eventos, ingressos e produtos)</li>
                <li>Controle de acesso a eventos e partidas</li>
                <li>Processamento de compras de ingressos e produtos oficiais</li>
            </ul>
        </div>

        <div class="legal-section">
            <h2>4. Bases Legais do Tratamento</h2>
            <p>O tratamento de dados pessoais possui como fundamentos:</p>
            <ul>
                <li><strong>Execução de contrato</strong> (Art. 7º, V, LGPD): Para fornecimento dos serviços contratados</li>
                <li><strong>Consentimento</strong> (Art. 7º, I, e Art. 11, I, da LGPD): Especialmente para envio de comunicações e uso de dados sensíveis</li>
                <li><strong>Prevenção à fraude e segurança do titular</strong> (Art. 11, II, "g")</li>
                <li><strong>Cumprimento de obrigação legal</strong> (Art. 7º, II, LGPD), quando aplicável</li>
            </ul>
        </div>

        <div class="legal-section">
            <h2>5. Compartilhamento de Dados</h2>
            <p>Os dados poderão ser compartilhados com prestadores de serviços essenciais (ex.: bilhetagem, tecnologia, segurança), mediante contratos com cláusulas específicas de proteção de dados, ou quando houver obrigação legal ou ordem judicial.</p>
            <div class="highlight-box">
                <p><strong>Importante:</strong> Todos os prestadores de serviços que têm acesso aos seus dados são rigorosamente selecionados e contratualmente obrigados a manter o mesmo nível de proteção de dados que implementamos.</p>
            </div>
        </div>

        <div class="legal-section">
            <h2>6. Armazenamento e Prazo de Retenção</h2>
            <p>Os dados serão armazenados pelo período necessário para a execução das finalidades informadas e conforme prazos legais aplicáveis. Após esse período, serão eliminados ou anonimizados.</p>
        </div>

        <div class="legal-section">
            <h2>7. Direitos do Usuário</h2>
            <p>Nos termos da LGPD, o Usuário poderá:</p>
            <ul>
                <li>Solicitar confirmação da existência de tratamento</li>
                <li>Acessar, corrigir ou solicitar a exclusão de seus dados</li>
                <li>Revogar o consentimento concedido a qualquer momento</li>
                <li>Solicitar informações sobre compartilhamento de dados</li>
            </ul>
            <p>Os pedidos deverão ser encaminhados ao Encarregado de Dados pelo e-mail: <strong>supervisor@bsbbkt.com.br</strong></p>
        </div>

        <div class="legal-section">
            <h2>8. Segurança</h2>
            <p>Adotamos medidas técnicas e administrativas para proteger os dados contra acessos não autorizados, perda, alteração ou divulgação indevida, conforme o art. 46 da LGPD.</p>
            <p>Nossa infraestrutura de segurança inclui:</p>
            <ul>
                <li>Criptografia de dados sensíveis</li>
                <li>Controles de acesso rigorosos</li>
                <li>Monitoramento contínuo de ameaças</li>
                <li>Auditorias regulares de segurança</li>
            </ul>
        </div>

        <div class="legal-section">
            <h2>9. Encarregado de Dados (DPO)</h2>
            <p>O responsável pelo tratamento de dados pessoais (DPO) do Brasília Basquete poderá ser contatado pelo e-mail acima. Sua identidade e função estão divulgadas publicamente conforme art. 41, §1º da LGPD.</p>
        </div>

        <div class="contact-info">
            <h3>Dúvidas sobre sua Privacidade?</h3>
            <p>Entre em contato com nosso Encarregado de Dados</p>
            <a href="mailto:supervisor@bsbbkt.com.br" class="contact-email">supervisor@bsbbkt.com.br</a>
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
