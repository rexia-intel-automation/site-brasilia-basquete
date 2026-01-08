<?php
require_once '../auth/check_auth.php';
require_once '../config/database.php';

$db = getDB();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM players WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index?msg=deleted');
    exit;
}

// Get filter parameter
$filter_status = $_GET['status'] ?? '';

// Build query based on filter
if ($filter_status === 'inactive') {
    $players = $db->query("SELECT * FROM players WHERE active = 0 ORDER BY number ASC")->fetchAll();
} else {
    $players = $db->query("SELECT * FROM players ORDER BY number ASC")->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogadores - Admin</title>
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
                <h1>Jogadores</h1>
                <p>Gerencie o elenco do Brasília Basquete</p>
            </div>
            <a href="form" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
                Novo Jogador
            </a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success">
                <?php
                $messages = [
                    'saved' => 'Jogador salvo com sucesso!',
                    'deleted' => 'Jogador excluído com sucesso!'
                ];
                echo $messages[$_GET['msg']] ?? 'Operação realizada com sucesso!';
                ?>
            </div>
        <?php endif; ?>

        <div class="content-section">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="80">#</th>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Posição</th>
                            <th>Nacionalidade</th>
                            <th>Status</th>
                            <th width="120">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($players as $player): ?>
                        <tr>
                            <td><strong class="player-number">#<?php echo $player['number']; ?></strong></td>
                            <td>
                                <?php if ($player['photo']): ?>
                                    <img src="<?php echo htmlspecialchars($player['photo']); ?>" alt="<?php echo htmlspecialchars($player['name']); ?>" class="player-thumb">
                                <?php else: ?>
                                    <div class="player-thumb-placeholder"><?php echo substr($player['name'], 0, 1); ?></div>
                                <?php endif; ?>
                            </td>
                            <td><strong><?php echo htmlspecialchars($player['name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($player['position']); ?></td>
                            <td><?php echo htmlspecialchars($player['nationality'] ?? 'Brasileiro'); ?></td>
                            <td>
                                <?php if ($player['active']): ?>
                                    <span class="badge badge-success">Ativo</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Inativo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="form?id=<?php echo $player['id']; ?>" class="btn-icon" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                                        </svg>
                                    </a>
                                    <a href="?delete=<?php echo $player['id']; ?>" class="btn-icon btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este jogador?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"/>
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($players)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhum jogador cadastrado</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="../assets/js/admin.js"></script>
</body>
</html>
