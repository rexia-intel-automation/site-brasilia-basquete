<?php
/**
 * Endpoint para gerenciar jogadores do elenco
 * Brasília Basquete - Sistema de Jogadores
 * 
 * Permite: Adicionar, Editar e Deletar jogadores
 */

// Caminho para o players.json
$JSON_FILE = __DIR__ . '/assets/data/players.json';

// Token simples para proteger o endpoint
$SECRET_TOKEN = 'basquete_token_@@_2025';

// Cabeçalho JSON
header('Content-Type: application/json; charset=utf-8');

// Permitir somente POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Ler o conteúdo enviado
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

// Validar se é JSON
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

// Validar token
if (!isset($data['token']) || $data['token'] !== $SECRET_TOKEN) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Validar ação (add, update, delete)
if (!isset($data['action']) || !in_array($data['action'], ['add', 'update', 'delete'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid action. Use: add, update, or delete']);
    exit;
}

$action = $data['action'];

// Ler jogadores existentes
if (file_exists($JSON_FILE)) {
    $players = json_decode(file_get_contents($JSON_FILE), true);
    if (!is_array($players)) {
        $players = [];
    }
} else {
    $players = [];
}

// Processar ação
switch ($action) {
    case 'add':
    case 'update':
        // Validar se veio o jogador
        if (!isset($data['player']) || !is_array($data['player'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing player object']);
            exit;
        }

        $newPlayer = $data['player'];

        // Validar campos obrigatórios
        $requiredFields = ['number', 'name', 'position', 'photo'];
        foreach ($requiredFields as $field) {
            if (!isset($newPlayer[$field]) || empty($newPlayer[$field])) {
                http_response_code(400);
                echo json_encode(['error' => "Missing required field: $field"]);
                exit;
            }
        }

        // Verificar se já existe jogador com mesmo número
        $updated = false;
        foreach ($players as $i => $p) {
            if (isset($p['number']) && $p['number'] === $newPlayer['number']) {
                $players[$i] = $newPlayer;
                $updated = true;
                break;
            }
        }

        // Se novo jogador, adicionar
        if (!$updated) {
            // Gerar ID automático
            $maxId = 0;
            foreach ($players as $p) {
                if (isset($p['id']) && $p['id'] > $maxId) {
                    $maxId = $p['id'];
                }
            }
            $newPlayer['id'] = $maxId + 1;
            $players[] = $newPlayer;
        }

        // Ordenar por número de camisa
        usort($players, function($a, $b) {
            return (int)$a['number'] - (int)$b['number'];
        });

        $responseAction = $updated ? 'updated' : 'added';
        break;

    case 'delete':
        // Validar se veio o número do jogador
        if (!isset($data['number'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing player number']);
            exit;
        }

        $numberToDelete = $data['number'];
        $found = false;

        // Remover jogador
        $players = array_filter($players, function($p) use ($numberToDelete, &$found) {
            if (isset($p['number']) && $p['number'] === $numberToDelete) {
                $found = true;
                return false;
            }
            return true;
        });

        // Reindexar array
        $players = array_values($players);

        if (!$found) {
            http_response_code(404);
            echo json_encode(['error' => 'Player not found']);
            exit;
        }

        $responseAction = 'deleted';
        break;
}

// Salvar de volta no JSON
if (file_put_contents($JSON_FILE, json_encode($players, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to write players.json']);
    exit;
}

// Resposta OK
echo json_encode([
    'status' => 'ok',
    'action' => $responseAction,
    'totalPlayers' => count($players),
    'message' => ucfirst($responseAction) . ' successfully'
]);
