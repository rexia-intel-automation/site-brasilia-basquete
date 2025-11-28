<?php
/**
 * Endpoint para retornar lista de jogadores
 * Brasília Basquete - API Pública de Jogadores
 */

// Caminho para o players.json
$JSON_FILE = __DIR__ . '/assets/data/players.json';

// Cabeçalho JSON
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

// Permitir somente GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Ler jogadores
if (file_exists($JSON_FILE)) {
    $players = json_decode(file_get_contents($JSON_FILE), true);
    
    if (!is_array($players)) {
        http_response_code(500);
        echo json_encode(['error' => 'Invalid players data']);
        exit;
    }
    
    // Filtrar por número específico (opcional)
    if (isset($_GET['number'])) {
        $number = $_GET['number'];
        $filteredPlayers = array_filter($players, function($p) use ($number) {
            return isset($p['number']) && $p['number'] === $number;
        });
        
        if (empty($filteredPlayers)) {
            http_response_code(404);
            echo json_encode(['error' => 'Player not found']);
            exit;
        }
        
        echo json_encode(array_values($filteredPlayers)[0]);
    } else {
        // Retornar todos os jogadores
        echo json_encode($players);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Players file not found']);
}
