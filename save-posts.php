<?php
/**
 * Endpoint para salvar posts no blog
 * Brasília Basquete - Sistema de Posts
 */

// Caminho para o posts.json
$JSON_FILE = __DIR__ . '/assets/data/posts.json';

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

// Validar se veio o post
if (!isset($data['post']) || !is_array($data['post'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing post object']);
    exit;
}

$newPost = $data['post'];

// Ler posts existentes
if (file_exists($JSON_FILE)) {
    $existing = json_decode(file_get_contents($JSON_FILE), true);
    if (!is_array($existing)) {
        $existing = [];
    }
} else {
    $existing = [];
}

// Verificar se já existe post com mesmo slug
$updated = false;
foreach ($existing as $i => $p) {
    if (isset($p['slug']) && $p['slug'] === $newPost['slug']) {
        $existing[$i] = $newPost;
        $updated = true;
        break;
    }
}

// Se novo post, adicionar
if (!$updated) {
    $existing[] = $newPost;
}

// Salvar de volta no JSON
if (file_put_contents($JSON_FILE, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to write posts.json']);
    exit;
}

// Resposta OK
echo json_encode([
    'status' => 'ok',
    'updated' => $updated,
    'totalPosts' => count($existing),
    'slug' => $newPost['slug']
]);
