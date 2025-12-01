<?php
require_once '../auth/check_auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria - Admin Brasília Basquete</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content">
        <div class="page-header">
            <div>
                <h1>Galeria de Mídia</h1>
                <p>Gerencie imagens e arquivos</p>
            </div>
        </div>

        <div class="card" style="text-align: center; padding: 4rem 2rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.3; margin: 0 auto 2rem;">
                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                <circle cx="9" cy="9" r="2"/>
                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
            </svg>

            <h2 style="margin-bottom: 1rem; color: var(--text-primary);">Galeria de Mídia</h2>
            <p style="opacity: 0.7; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                A funcionalidade de galeria está em desenvolvimento. Por enquanto, você pode usar as seguintes alternativas para gerenciar imagens:
            </p>

            <div style="max-width: 700px; margin: 0 auto; text-align: left;">
                <div class="card" style="margin-bottom: 1.5rem; padding: 1.5rem;">
                    <h3 style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.75rem; color: var(--primary-color);">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 16v-4"/>
                            <path d="M12 8h.01"/>
                        </svg>
                        Opção 1: Serviços de Hospedagem Externa
                    </h3>
                    <p style="opacity: 0.8; margin-bottom: 1rem;">
                        Use serviços gratuitos para hospedar suas imagens:
                    </p>
                    <ul style="margin-left: 1.5rem; opacity: 0.9;">
                        <li style="margin-bottom: 0.5rem;">
                            <strong>Imgur</strong> - <a href="https://imgur.com" target="_blank" style="color: var(--primary-color);">imgur.com</a>
                        </li>
                        <li style="margin-bottom: 0.5rem;">
                            <strong>ImgBB</strong> - <a href="https://imgbb.com" target="_blank" style="color: var(--primary-color);">imgbb.com</a>
                        </li>
                        <li>
                            <strong>Postimages</strong> - <a href="https://postimages.org" target="_blank" style="color: var(--primary-color);">postimages.org</a>
                        </li>
                    </ul>
                    <p style="opacity: 0.7; margin-top: 1rem; font-size: 0.875rem;">
                        Após fazer upload, copie o link direto da imagem e cole nos formulários de jogadores ou posts.
                    </p>
                </div>

                <div class="card" style="margin-bottom: 1.5rem; padding: 1.5rem;">
                    <h3 style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.75rem; color: var(--primary-color);">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" y1="3" x2="12" y2="15"/>
                        </svg>
                        Opção 2: Upload via FTP/cPanel
                    </h3>
                    <p style="opacity: 0.8; margin-bottom: 1rem;">
                        Faça upload direto para o servidor:
                    </p>
                    <ol style="margin-left: 1.5rem; opacity: 0.9;">
                        <li style="margin-bottom: 0.5rem;">
                            Acesse seu servidor via FTP (FileZilla) ou cPanel
                        </li>
                        <li style="margin-bottom: 0.5rem;">
                            Crie/navegue até a pasta: <code style="background: var(--bg-secondary); padding: 0.25rem 0.5rem; border-radius: 4px;">/uploads/</code>
                        </li>
                        <li style="margin-bottom: 0.5rem;">
                            Faça upload das imagens
                        </li>
                        <li>
                            Use a URL: <code style="background: var(--bg-secondary); padding: 0.25rem 0.5rem; border-radius: 4px;">https://seusite.com.br/uploads/imagem.jpg</code>
                        </li>
                    </ol>
                </div>

                <div class="alert alert-info" style="margin-top: 2rem;">
                    <strong>💡 Dica:</strong> Consulte o <a href="../MANUAL.md" style="color: var(--primary-color); text-decoration: underline;">Manual Completo</a> para instruções detalhadas sobre como adicionar imagens aos posts e jogadores.
                </div>
            </div>

            <div style="margin-top: 3rem;">
                <a href="../" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7"/>
                        <path d="M19 12H5"/>
                    </svg>
                    Voltar ao Dashboard
                </a>
            </div>
        </div>
    </main>

    <script src="../assets/js/admin.js"></script>
</body>
</html>
