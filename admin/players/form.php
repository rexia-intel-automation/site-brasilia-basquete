<?php
require_once '../auth/check_auth.php';
require_once '../config/database.php';

$db = getDB();
$player = null;
$is_edit = false;

// Load player for editing
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM players WHERE id = ?");
    $stmt->execute([$id]);
    $player = $stmt->fetch();
    $is_edit = true;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number = (int)$_POST['number'];
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $photo = trim($_POST['photo'] ?? '');
    $height = trim($_POST['height'] ?? '');
    $weight = trim($_POST['weight'] ?? '');
    $birth_date = $_POST['birth_date'] ?? null;
    $nationality = trim($_POST['nationality'] ?? 'Brasileiro');
    $active = isset($_POST['active']) ? 1 : 0;

    if ($is_edit) {
        $stmt = $db->prepare("UPDATE players SET number = ?, name = ?, position = ?, photo = ?, height = ?, weight = ?, birth_date = ?, nationality = ?, active = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$number, $name, $position, $photo, $height, $weight, $birth_date, $nationality, $active, $_GET['id']]);
    } else {
        $stmt = $db->prepare("INSERT INTO players (number, name, position, photo, height, weight, birth_date, nationality, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$number, $name, $position, $photo, $height, $weight, $birth_date, $nationality, $active]);
    }

    header('Location: index.php?msg=saved');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $is_edit ? 'Editar' : 'Novo'; ?> Jogador - Admin</title>
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
                <h1><?php echo $is_edit ? 'Editar' : 'Novo'; ?> Jogador</h1>
                <p>Preencha os dados do jogador</p>
            </div>
            <a href="index.php" class="btn btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7"/>
                    <path d="M19 12H5"/>
                </svg>
                Voltar
            </a>
        </div>

        <div class="content-section">
            <form method="POST" class="form-grid">
                <div class="form-row">
                    <div class="form-group">
                        <label for="number">Número *</label>
                        <input type="number" id="number" name="number" required
                               value="<?php echo $player['number'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="name">Nome Completo *</label>
                        <input type="text" id="name" name="name" required
                               value="<?php echo htmlspecialchars($player['name'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="position">Posição *</label>
                        <select id="position" name="position" required>
                            <option value="">Selecione...</option>
                            <option value="Armador" <?php echo ($player['position'] ?? '') == 'Armador' ? 'selected' : ''; ?>>Armador</option>
                            <option value="Ala-armador" <?php echo ($player['position'] ?? '') == 'Ala-armador' ? 'selected' : ''; ?>>Ala-armador</option>
                            <option value="Ala" <?php echo ($player['position'] ?? '') == 'Ala' ? 'selected' : ''; ?>>Ala</option>
                            <option value="Ala-Pivô" <?php echo ($player['position'] ?? '') == 'Ala-Pivô' ? 'selected' : ''; ?>>Ala-Pivô</option>
                            <option value="Pivô" <?php echo ($player['position'] ?? '') == 'Pivô' ? 'selected' : ''; ?>>Pivô</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nationality">Nacionalidade</label>
                        <input type="text" id="nationality" name="nationality"
                               value="<?php echo htmlspecialchars($player['nationality'] ?? 'Brasileiro'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="photo">URL da Foto</label>
                    <input type="url" id="photo" name="photo"
                           value="<?php echo htmlspecialchars($player['photo'] ?? ''); ?>"
                           placeholder="https://exemplo.com/foto.jpg">
                    <small>Cole a URL completa da imagem do jogador</small>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="height">Altura</label>
                        <input type="text" id="height" name="height"
                               value="<?php echo htmlspecialchars($player['height'] ?? ''); ?>"
                               placeholder="ex: 1,98m">
                    </div>

                    <div class="form-group">
                        <label for="weight">Peso</label>
                        <input type="text" id="weight" name="weight"
                               value="<?php echo htmlspecialchars($player['weight'] ?? ''); ?>"
                               placeholder="ex: 95kg">
                    </div>

                    <div class="form-group">
                        <label for="birth_date">Data de Nascimento</label>
                        <input type="date" id="birth_date" name="birth_date"
                               value="<?php echo $player['birth_date'] ?? ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="active" value="1"
                               <?php echo ($player['active'] ?? 1) ? 'checked' : ''; ?>>
                        <span>Jogador ativo no elenco</span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Salvar Jogador
                    </button>
                    <a href="index.php" class="btn btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <script src="../assets/js/admin.js"></script>
</body>
</html>
