<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso de Consentimento - Caixa Brasília Basquete</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- CHAT BUTTON (Floating) -->
    <a href="https://primary-production-55af6.up.railway.app/webhook/532cd781-988a-45b3-a190-fd18a6c999e5/chat" class="chat-button" aria-label="Chat" onclick="event.preventDefault(); window.open(this.href, 'ChatPopup', 'width=400,height=600,resizable=yes,scrollbars=yes'); return false;">
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

    <!-- HERO -->
    <section class="consent-hero">
        <div class="consent-hero-content">
            <h1 class="consent-title">Aviso de Consentimento</h1>
            <p class="consent-subtitle">Coleta e Tratamento de Dados Pessoais</p>
        </div>
    </section>

    <!-- CONTENT -->
    <main class="consent-content">
        <div class="consent-card">
            <h2>Consentimento para Tratamento de Dados</h2>
            <p class="consent-text">
                Ao aceitar este aviso, você, titular dos dados pessoais, CONSENTE de forma livre, informada e inequívoca com o tratamento de seus dados pessoais pelo Caixa Brasília Basquete, conforme descrito abaixo:
            </p>

            <div class="consent-highlight">
                <h3>Dados Coletados</h3>
                <ul>
                    <li>Nome completo</li>
                    <li>CPF</li>
                    <li>Endereço de e-mail</li>
                    <li>Número de telefone</li>
                    <li>Fotografia (dado sensível)</li>
                </ul>
            </div>

            <h3>Finalidades do Tratamento</h3>
            <p>Seus dados serão utilizados para:</p>
            <ul>
                <li>Comunicação oficial sobre eventos, jogos, promoções e novidades do Clube</li>
                <li>Controle de acesso aos eventos esportivos realizados no Ginásio Nilson Nelson</li>
                <li>Processamento de compras de ingressos e produtos oficiais</li>
                <li>Reconhecimento facial para segurança e controle de acesso (somente mediante consentimento específico)</li>
            </ul>

            <h3>Compartilhamento</h3>
            <p>Seus dados poderão ser compartilhados com:</p>
            <ul>
                <li>Prestadores de serviço essenciais (ex: tecnologia, bilhetagem, segurança)</li>
                <li>Autoridades públicas, quando exigido por lei</li>
            </ul>

            <div class="consent-highlight">
                <h3>Seus Direitos</h3>
                <p>Você pode, a qualquer momento:</p>
                <ul>
                    <li>REVOGAR este consentimento</li>
                    <li>Solicitar acesso aos seus dados</li>
                    <li>Requerer correção de dados incompletos ou desatualizados</li>
                    <li>Solicitar a exclusão de seus dados</li>
                    <li>Obter informações sobre o compartilhamento</li>
                </ul>
            </div>

            <h3>Como Exercer Seus Direitos</h3>
            <p>Para exercer seus direitos ou revogar este consentimento, entre em contato com nosso Encarregado de Dados (DPO) pelo e-mail: <strong>supervisor@bsbbkt.com.br</strong></p>

            <p class="consent-text" style="margin-top: 30px;">
                <strong>Importante:</strong> A revogação do consentimento não afeta a legalidade do tratamento realizado antes da revogação. A não concessão do consentimento ou sua revogação pode impedir ou limitar sua participação em eventos, compra de ingressos e acesso a determinados serviços.
            </p>
        </div>

        <div class="contact-info">
            <h3>Dúvidas sobre o Consentimento?</h3>
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
