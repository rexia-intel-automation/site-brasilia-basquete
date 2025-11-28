<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Brasília Basquete - MONUMENTAL!</title>
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

        /* HERO SECTION */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0A0A0A 0%, #1A1A1A 100%);
            margin-top: 140px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(0, 92, 169, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(209, 125, 0, 0.1) 0%, transparent 50%);
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .hero-content {
            text-align: center;
            z-index: 1;
            max-width: 1200px;
            padding: 0 40px;
        }

        .hero-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(60px, 10vw, 140px);
            line-height: 0.9;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #005CA9 0%, #D17D00 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: slideDown 1s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-subtitle {
            font-size: clamp(20px, 3vw, 32px);
            font-weight: 300;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 50px;
            opacity: 0;
            animation: fadeIn 1s ease-out 0.3s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .hero-cta {
            display: inline-block;
            padding: 18px 50px;
            background: var(--primary-orange);
            color: var(--text-white);
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 40px rgba(209, 125, 0, 0.4);
            opacity: 0;
            animation: fadeIn 1s ease-out 0.6s forwards;
        }

        .hero-cta:hover {
            background: var(--primary-blue);
            color: var(--text-white);
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 92, 169, 0.5);
        }

        /* SPONSORS SECTION */
        .sponsors {
            padding: 80px 40px;
            background: var(--secondary-gray);
            border-top: 1px solid rgba(0, 92, 169, 0.2);
            border-bottom: 1px solid rgba(0, 92, 169, 0.2);
        }

        .sponsors-title {
            text-align: center;
            font-family: 'Bebas Neue', cursive;
            font-size: 42px;
            letter-spacing: 3px;
            margin-bottom: 50px;
            color: var(--text-white);
            position: relative;
        }

        .sponsors-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary-orange);
            border-radius: 2px;
        }

        .sponsors-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            align-items: center;
        }

        .sponsor-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 92, 169, 0.1);
            min-height: 140px;
        }

        .sponsor-logo:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-10px);
            border-color: var(--primary-orange);
            box-shadow: 0 8px 25px rgba(209, 125, 0, 0.3);
        }

        .sponsor-logo img {
            max-width: 100%;
            height: auto;
            max-height: 80px;
            transition: all 0.3s ease;
        }

        .sponsor-logo:hover img {
            transform: scale(1.05);
        }

        /* ELENCO SECTION */
        #elenco {
            padding: 120px 40px;
            background: var(--primary-black);
        }

        .section-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(60px, 8vw, 100px);
            text-align: center;
            margin-bottom: 30px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-orange) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            text-align: center;
            font-size: 20px;
            color: var(--text-gray);
            margin-bottom: 80px;
            letter-spacing: 2px;
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
            margin-top: 40px;
        }

        .carousel-track {
            display: flex;
            gap: 30px;
            padding: 20px 0;
            animation: infiniteScroll 40s linear infinite;
        }

        @keyframes infiniteScroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-50% - 15px));
            }
        }

        .carousel-track:hover {
            animation-play-state: paused;
        }

        .player-card {
            min-width: 280px;
            flex-shrink: 0;
            background: linear-gradient(135deg, rgba(26, 26, 26, 0.8) 0%, rgba(10, 10, 10, 0.8) 100%);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid rgba(0, 92, 169, 0.2);
            position: relative;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .player-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-blue), var(--primary-orange));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .player-card:hover {
            transform: translateY(-10px) scale(1.05);
            border-color: var(--primary-orange);
            box-shadow: 0 20px 60px rgba(209, 125, 0, 0.3);
            z-index: 10;
        }

        .player-card:hover::before {
            transform: scaleX(1);
        }

        .player-image {
            width: 100%;
            height: 350px;
            background: var(--secondary-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .player-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .player-info {
            padding: 25px;
        }

        .player-number {
            font-family: 'Bebas Neue', cursive;
            font-size: 48px;
            color: var(--primary-orange);
            line-height: 1;
        }

        .player-name {
            font-family: 'Bebas Neue', cursive;
            font-size: 32px;
            margin: 10px 0;
            letter-spacing: 1px;
            color: var(--primary-blue);
        }

        .player-position {
            font-size: 16px;
            color: var(--text-gray);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .carousel-navigation {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        .nav-button {
            background: var(--primary-orange);
            border: none;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(209, 125, 0, 0.3);
        }

        .nav-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(209, 125, 0, 0.5);
            background: var(--primary-blue);
        }

        /* CTA APP SECTION */
        .cta-app {
            padding: 120px 40px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, #0070c9 100%);
            position: relative;
            overflow: hidden;
        }

        .cta-app::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .cta-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .cta-title {
            font-family: 'Bebas Neue', cursive;
            font-size: clamp(50px, 8vw, 90px);
            margin-bottom: 25px;
            color: var(--text-white);
            line-height: 1.1;
        }

        .cta-description {
            font-size: 22px;
            margin-bottom: 50px;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.6;
        }

        .app-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .app-button {
            display: inline-flex;
            align-items: center;
            gap: 15px;
            padding: 18px 40px;
            background: var(--primary-orange);
            color: var(--text-white);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-orange);
        }

        .app-button:hover {
            background: transparent;
            border-color: var(--text-white);
            transform: translateY(-5px);
        }

        .app-icon {
            font-size: 28px;
        }

        /* RECORDES SECTION */
        #recordes {
            padding: 120px 40px;
            background: var(--primary-black);
        }

        .records-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
        }

        .record-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            padding: 40px;
            transition: all 0.4s ease;
            border: 2px solid rgba(0, 92, 169, 0.2);
            position: relative;
            overflow: hidden;
        }

        .record-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 92, 169, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .record-card:hover {
            border-color: var(--primary-orange);
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(209, 125, 0, 0.3);
        }

        .record-card:hover::before {
            left: 100%;
        }

        .record-card h2 {
            color: var(--primary-blue);
            font-family: 'Bebas Neue', cursive;
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: 1px;
        }

        .record-image-container {
            width: 100%;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .record-image-container img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            border: 2px solid var(--primary-orange);
            border-radius: 25px;
            padding: 8px;
            background: white;
        }

        .record-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .record-card ul li {
            margin-bottom: 12px;
            padding-left: 20px;
            position: relative;
            line-height: 1.6;
            color: #333;
            font-size: 16px;
        }

        .record-card ul li::before {
            content: "•";
            color: var(--primary-orange);
            position: absolute;
            left: 0;
            font-weight: bold;
            font-size: 1.5em;
        }

        /* HISTÓRIA SECTION */
        #história {
            padding: 120px 40px;
            background: var(--secondary-gray);
        }

        .history-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .timeline {
            position: relative;
            padding: 40px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--primary-blue) 0%, var(--primary-orange) 100%);
            transform: translateX(-50%);
            border-radius: 4px;
        }

        .timeline-item {
            margin-bottom: 80px;
            position: relative;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            margin-left: auto;
            margin-right: 0;
            text-align: left;
            padding-left: 60px;
        }

        .timeline-item:nth-child(even) .timeline-content {
            margin-right: auto;
            margin-left: 0;
            text-align: right;
            padding-right: 60px;
        }

        .timeline-content {
            width: 48%;
            background: rgba(255, 255, 255, 0.98);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(0, 92, 169, 0.2);
            transition: all 0.4s ease;
            color: #333;
        }

        .timeline-content:hover {
            border-color: var(--primary-orange);
            transform: scale(1.02);
            box-shadow: 0 15px 50px rgba(209, 125, 0, 0.3);
        }

        .timeline-year {
            font-family: 'Bebas Neue', cursive;
            font-size: 56px;
            color: var(--primary-blue);
            margin-bottom: 15px;
            line-height: 1;
        }

        .timeline-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 32px;
            margin-bottom: 15px;
            letter-spacing: 1px;
            color: var(--primary-blue);
        }

        .timeline-description {
            font-size: 18px;
            line-height: 1.8;
            color: #555;
        }

        .timeline-image {
            width: 100%;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .timeline-dot {
            position: absolute;
            left: 50%;
            top: 30px;
            transform: translateX(-50%);
            width: 18px;
            height: 18px;
            background: white;
            border: 4px solid var(--primary-blue);
            border-radius: 50%;
            z-index: 1;
            box-shadow: 0 0 0 4px var(--accent-blue-light);
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

            .timeline::before {
                left: 20px;
            }

            .timeline-content {
                width: calc(100% - 80px);
                margin-left: 80px !important;
                text-align: left !important;
                padding: 30px !important;
            }

            .timeline-dot {
                left: 20px;
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

            .hero {
                margin-top: 100px;
                padding: 60px 0;
            }

            .sponsors,
            #elenco,
            #recordes,
            #história,
            .cta-app {
                padding: 80px 20px;
            }

            .records-grid {
                grid-template-columns: 1fr;
            }

            .app-buttons {
                flex-direction: column;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .sponsors-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }
    </style>
</head>
<body>
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
                <!-- Primeiro conjunto de jogadores -->
                <a href="#" class="player-card" data-player="mosquito">
                    <div class="player-image">
                        <img src="https://i.imgur.com/NZ9MQQH.jpeg" alt="Mosquito">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#1</div>
                        <h3 class="player-name">Mosquito</h3>
                        <p class="player-position">Armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="crescenzi">
                    <div class="player-image">
                        <img src="https://i.imgur.com/DsFTwbS.jpeg" alt="Crescenzi">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#2</div>
                        <h3 class="player-name">Crescenzi</h3>
                        <p class="player-position">Ala-armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="gustavo">
                    <div class="player-image">
                        <img src="https://i.imgur.com/I6A5l08.jpeg" alt="Gustavo">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#6</div>
                        <h3 class="player-name">Gustavo</h3>
                        <p class="player-position">Armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="corvalan">
                    <div class="player-image">
                        <img src="https://i.imgur.com/Owsi001.jpeg" alt="Corvalán">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#7</div>
                        <h3 class="player-name">Corvalán</h3>
                        <p class="player-position">Ala-armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="pedro">
                    <div class="player-image">
                        <img src="https://i.imgur.com/1MSNOeq.jpeg" alt="Pedro">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#9</div>
                        <h3 class="player-name">Pedro</h3>
                        <p class="player-position">Ala</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="lucas">
                    <div class="player-image">
                        <img src="https://i.imgur.com/uxKFMhs.jpeg" alt="Lucas">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#10</div>
                        <h3 class="player-name">Lucas</h3>
                        <p class="player-position">Armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="brunao">
                    <div class="player-image">
                        <img src="https://i.imgur.com/tweN5FJ.jpeg" alt="Brunão">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#11</div>
                        <h3 class="player-name">Brunão</h3>
                        <p class="player-position">Pivô</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="paulichi">
                    <div class="player-image">
                        <img src="https://i.imgur.com/xrxtgK5.jpeg" alt="Paulichi">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#13</div>
                        <h3 class="player-name">Paulichi</h3>
                        <p class="player-position">Ala-Pivô</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="buiu">
                    <div class="player-image">
                        <img src="https://i.imgur.com/PsFVGHd.jpeg" alt="Buiu">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#14</div>
                        <h3 class="player-name">Buiu</h3>
                        <p class="player-position">Ala-armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="carbonari">
                    <div class="player-image">
                        <img src="https://i.imgur.com/FjIYznN.jpeg" alt="Carbonari">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#15</div>
                        <h3 class="player-name">Carbonari</h3>
                        <p class="player-position">Pivô</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="zago">
                    <div class="player-image">
                        <img src="https://i.imgur.com/8HYz263.jpeg" alt="Zago">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#27</div>
                        <h3 class="player-name">Zago</h3>
                        <p class="player-position">Ala</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="vonhaydin">
                    <div class="player-image">
                        <img src="https://i.imgur.com/eQdiXei.jpeg" alt="Von Haydin">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#30</div>
                        <h3 class="player-name">Von Haydin</h3>
                        <p class="player-position">Ala</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="beller">
                    <div class="player-image">
                        <img src="https://i.imgur.com/QcpuFl5.jpeg" alt="Beller">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#77</div>
                        <h3 class="player-name">Beller</h3>
                        <p class="player-position">Ala-Pivô</p>
                    </div>
                </a>

                <!-- Segundo conjunto - duplicação para efeito infinito -->
                <a href="#" class="player-card" data-player="mosquito">
                    <div class="player-image">
                        <img src="https://i.imgur.com/NZ9MQQH.jpeg" alt="Mosquito">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#1</div>
                        <h3 class="player-name">Mosquito</h3>
                        <p class="player-position">Armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="crescenzi">
                    <div class="player-image">
                        <img src="https://i.imgur.com/DsFTwbS.jpeg" alt="Crescenzi">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#2</div>
                        <h3 class="player-name">Crescenzi</h3>
                        <p class="player-position">Ala-armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="gustavo">
                    <div class="player-image">
                        <img src="https://i.imgur.com/I6A5l08.jpeg" alt="Gustavo">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#6</div>
                        <h3 class="player-name">Gustavo</h3>
                        <p class="player-position">Armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="corvalan">
                    <div class="player-image">
                        <img src="https://i.imgur.com/Owsi001.jpeg" alt="Corvalán">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#7</div>
                        <h3 class="player-name">Corvalán</h3>
                        <p class="player-position">Ala-armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="pedro">
                    <div class="player-image">
                        <img src="https://i.imgur.com/1MSNOeq.jpeg" alt="Pedro">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#9</div>
                        <h3 class="player-name">Pedro</h3>
                        <p class="player-position">Ala</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="lucas">
                    <div class="player-image">
                        <img src="https://i.imgur.com/uxKFMhs.jpeg" alt="Lucas">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#10</div>
                        <h3 class="player-name">Lucas</h3>
                        <p class="player-position">Armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="brunao">
                    <div class="player-image">
                        <img src="https://i.imgur.com/tweN5FJ.jpeg" alt="Brunão">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#11</div>
                        <h3 class="player-name">Brunão</h3>
                        <p class="player-position">Pivô</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="paulichi">
                    <div class="player-image">
                        <img src="https://i.imgur.com/xrxtgK5.jpeg" alt="Paulichi">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#13</div>
                        <h3 class="player-name">Paulichi</h3>
                        <p class="player-position">Ala-Pivô</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="buiu">
                    <div class="player-image">
                        <img src="https://i.imgur.com/PsFVGHd.jpeg" alt="Buiu">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#14</div>
                        <h3 class="player-name">Buiu</h3>
                        <p class="player-position">Ala-armador</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="carbonari">
                    <div class="player-image">
                        <img src="https://i.imgur.com/FjIYznN.jpeg" alt="Carbonari">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#15</div>
                        <h3 class="player-name">Carbonari</h3>
                        <p class="player-position">Pivô</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="zago">
                    <div class="player-image">
                        <img src="https://i.imgur.com/8HYz263.jpeg" alt="Zago">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#27</div>
                        <h3 class="player-name">Zago</h3>
                        <p class="player-position">Ala</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="vonhaydin">
                    <div class="player-image">
                        <img src="https://i.imgur.com/eQdiXei.jpeg" alt="Von Haydin">
                    </div>
                    <div class="player-info">
                        <div class="player-number">#30</div>
                        <h3 class="player-name">Von Haydin</h3>
                        <p class="player-position">Ala</p>
                    </div>
                </a>

                <a href="#" class="player-card" data-player="beller">
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
            <button class="nav-button" id="prevBtn">‹</button>
            <button class="nav-button" id="nextBtn">›</button>
        </div>
    </section>

    <!-- CTA APP SECTION -->
    <section class="cta-app">
        <div class="cta-content">
            <h2 class="cta-title">Baixe o App Oficial</h2>
            <p class="cta-description">Acompanhe jogos ao vivo, notícias exclusivas, estatísticas dos jogadores e muito mais. Tenha o Brasília Basquete na palma da sua mão!</p>
            <div class="app-buttons">
                <a href="#" class="app-button">
                    <span class="app-icon">📱</span>
                    <span>App Store</span>
                </a>
                <a href="#" class="app-button">
                    <span class="app-icon">🤖</span>
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
                    <li><a href="/cdn-cgi/l/email-protection#d3a0a6a3bca1a7b693b1a0b1b1b8a7fdb0bcbefdb1a1"><span class="__cf_email__" data-cfemail="235056534c515746634150414148570d404c4e0d4151">[email&#160;protected]</span></a></li>
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

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.length > 1) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const offsetTop = target.offsetTop - 100;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Load players dynamically
        async function loadPlayers() {
            try {
                const response = await fetch('get-players.php');
                if (!response.ok) {
                    console.error('Failed to load players');
                    return;
                }
                
                const players = await response.json();
                const track = document.getElementById('carouselTrack');
                
                // Limpar conteúdo existente
                track.innerHTML = '';
                
                // Criar cards dos jogadores
                const createPlayerCard = (player) => {
                    return `
                        <a href="#" class="player-card" data-player="${player.number}">
                            <div class="player-image">
                                <img src="${player.photo}" alt="${player.name}" onerror="this.src='https://via.placeholder.com/280x350/1A1A1A/FFFFFF?text=${player.number}'">
                            </div>
                            <div class="player-info">
                                <div class="player-number">#${player.number}</div>
                                <h3 class="player-name">${player.name}</h3>
                                <p class="player-position">${player.position}</p>
                            </div>
                        </a>
                    `;
                };
                
                // Adicionar jogadores (primeiro conjunto)
                players.forEach(player => {
                    track.innerHTML += createPlayerCard(player);
                });
                
                // Adicionar jogadores novamente (segundo conjunto para loop infinito)
                players.forEach(player => {
                    track.innerHTML += createPlayerCard(player);
                });
                
            } catch (error) {
                console.error('Erro ao carregar jogadores:', error);
            }
        }

        // Carregar jogadores quando a página carregar
        document.addEventListener('DOMContentLoaded', loadPlayers);

        // Carousel controls
        const track = document.getElementById('carouselTrack');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        let isPaused = false;
        
        prevBtn.addEventListener('click', () => {
            track.style.animationPlayState = 'paused';
            isPaused = true;
            setTimeout(() => {
                track.style.animationPlayState = 'running';
                isPaused = false;
            }, 3000);
        });

        nextBtn.addEventListener('click', () => {
            track.style.animationPlayState = 'paused';
            isPaused = true;
            setTimeout(() => {
                track.style.animationPlayState = 'running';
                isPaused = false;
            }, 3000);
        });

        // Pause on hover
        track.addEventListener('mouseenter', () => {
            if (!isPaused) {
                track.style.animationPlayState = 'paused';
            }
        });

        track.addEventListener('mouseleave', () => {
            if (!isPaused) {
                track.style.animationPlayState = 'running';
            }
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.record-card, .timeline-item, .sponsor-logo').forEach(e
