<?php
require_once '../auth/check_auth.php';
require_once '../config/database.php';

$db = getDB();

$success = '';
$error = '';

// Handle password change
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Get current user
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['admin_id']]);
    $user = $stmt->fetch();

    if (!password_verify($current_password, $user['password'])) {
        $error = "Senha atual incorreta!";
    } elseif ($new_password !== $confirm_password) {
        $error = "As senhas não coincidem!";
    } elseif (strlen($new_password) < 6) {
        $error = "A nova senha deve ter pelo menos 6 caracteres!";
    } else {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashed, $_SESSION['admin_id']]);
        $success = "Senha alterada com sucesso!";
    }
}

// Handle profile update
if (isset($_POST['update_profile'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    if (empty($username)) {
        $error = "O nome de usuário é obrigatório!";
    } else {
        try {
            $stmt = $db->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            $stmt->execute([$username, $email, $_SESSION['admin_id']]);
            $_SESSION['admin_username'] = $username;
            $success = "Perfil atualizado com sucesso!";
        } catch (PDOException $e) {
            $error = "Erro ao atualizar perfil: Nome de usuário já existe!";
        }
    }
}

// Get current user info
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['admin_id']]);
$user = $stmt->fetch();

// Get system stats
$stats = [
    'total_users' => $db->query("SELECT COUNT(*) as count FROM users")->fetch()['count'],
    'total_players' => $db->query("SELECT COUNT(*) as count FROM players")->fetch()['count'],
    'total_posts' => $db->query("SELECT COUNT(*) as count FROM posts")->fetch()['count'],
    'total_categories' => $db->query("SELECT COUNT(*) as count FROM categories")->fetch()['count'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Admin Brasília Basquete</title>
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
                <h1>Configurações</h1>
                <p>Gerencie suas preferências e configurações do sistema</p>
            </div>
        </div>

        <?php if ($success): ?>
            <div class="alert alert-success auto-hide"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="content-grid" style="gap: 2rem;">
            <!-- Profile Settings -->
            <div class="content-section">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 0.5rem;">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            Informações do Perfil
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="username" class="required">Nome de Usuário *</label>
                                <input type="text"
                                       id="username"
                                       name="username"
                                       class="form-control"
                                       value="<?php echo htmlspecialchars($user['username']); ?>"
                                       required>
                                <small>Nome usado para fazer login</small>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       class="form-control"
                                       value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                                <small>Email para notificações (opcional)</small>
                            </div>

                            <div class="form-group">
                                <label>Membro desde</label>
                                <input type="text"
                                       class="form-control"
                                       value="<?php echo date('d/m/Y', strtotime($user['created_at'])); ?>"
                                       readonly
                                       style="background: var(--input-disabled-bg); cursor: not-allowed;">
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="update_profile" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                        <polyline points="17 21 17 13 7 13 7 21"/>
                                        <polyline points="7 3 7 8 15 8"/>
                                    </svg>
                                    Atualizar Perfil
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 0.5rem;">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            Alterar Senha
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="current_password" class="required">Senha Atual *</label>
                                <input type="password"
                                       id="current_password"
                                       name="current_password"
                                       class="form-control"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="new_password" class="required">Nova Senha *</label>
                                <input type="password"
                                       id="new_password"
                                       name="new_password"
                                       class="form-control"
                                       minlength="6"
                                       required>
                                <small>Mínimo de 6 caracteres</small>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password" class="required">Confirmar Nova Senha *</label>
                                <input type="password"
                                       id="confirm_password"
                                       name="confirm_password"
                                       class="form-control"
                                       minlength="6"
                                       required>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="change_password" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/>
                                    </svg>
                                    Alterar Senha
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- System Info -->
            <div class="content-section">
                <!-- Statistics -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 0.5rem;">
                                <line x1="12" y1="20" x2="12" y2="10"/>
                                <line x1="18" y1="20" x2="18" y2="4"/>
                                <line x1="6" y1="20" x2="6" y2="16"/>
                            </svg>
                            Estatísticas do Sistema
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="stat-item" style="padding: 1rem 0; border-bottom: 1px solid var(--border-color);">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span>Total de Usuários</span>
                                <strong style="font-size: 1.25rem; color: var(--primary-color);"><?php echo $stats['total_users']; ?></strong>
                            </div>
                        </div>

                        <div class="stat-item" style="padding: 1rem 0; border-bottom: 1px solid var(--border-color);">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span>Total de Jogadores</span>
                                <strong style="font-size: 1.25rem; color: var(--primary-color);"><?php echo $stats['total_players']; ?></strong>
                            </div>
                        </div>

                        <div class="stat-item" style="padding: 1rem 0; border-bottom: 1px solid var(--border-color);">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span>Total de Posts</span>
                                <strong style="font-size: 1.25rem; color: var(--primary-color);"><?php echo $stats['total_posts']; ?></strong>
                            </div>
                        </div>

                        <div class="stat-item" style="padding: 1rem 0;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span>Total de Categorias</span>
                                <strong style="font-size: 1.25rem; color: var(--primary-color);"><?php echo $stats['total_categories']; ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Info -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 0.5rem;">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 16v-4"/>
                                <path d="M12 8h.01"/>
                            </svg>
                            Informações do Sistema
                        </h3>
                    </div>
                    <div class="card-body" style="font-size: 0.875rem;">
                        <div class="stat-item" style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                            <div><strong>Versão do PHP:</strong></div>
                            <div style="margin-top: 0.25rem; opacity: 0.8;"><?php echo phpversion(); ?></div>
                        </div>

                        <div class="stat-item" style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                            <div><strong>Banco de Dados:</strong></div>
                            <div style="margin-top: 0.25rem; opacity: 0.8;">
                                MySQL <?php echo $db->query("SELECT VERSION()")->fetchColumn(); ?>
                            </div>
                        </div>

                        <div class="stat-item" style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                            <div><strong>Servidor:</strong></div>
                            <div style="margin-top: 0.25rem; opacity: 0.8; word-break: break-all;">
                                <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'N/A'; ?>
                            </div>
                        </div>

                        <div class="stat-item" style="padding: 0.75rem 0;">
                            <div><strong>Versão do Painel:</strong></div>
                            <div style="margin-top: 0.25rem; opacity: 0.8;">1.0.0</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-header">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 0.5rem;">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                            Ações Rápidas
                        </h3>
                    </div>
                    <div class="card-body">
                        <a href="../" class="btn btn-outline btn-block" style="margin-bottom: 0.5rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            </svg>
                            Ir para o Dashboard
                        </a>

                        <a href="../../index.php" target="_blank" class="btn btn-outline btn-block" style="margin-bottom: 0.5rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <polyline points="15 3 21 3 21 9"/>
                                <line x1="10" y1="14" x2="21" y2="3"/>
                            </svg>
                            Ver Site Público
                        </a>

                        <a href="../auth/logout" class="btn btn-danger btn-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <polyline points="16 17 21 12 16 7"/>
                                <line x1="21" y1="12" x2="9" y2="12"/>
                            </svg>
                            Sair do Sistema
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/js/admin.js"></script>
</body>
</html>
