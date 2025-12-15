<?php
/**
 * Script de teste de conexão com banco de dados
 * Execute este arquivo para verificar se a integração está funcionando
 */

echo "<h1>Teste de Integração - Blog do Brasília Basquete</h1>";
echo "<style>body { font-family: Arial, sans-serif; padding: 2rem; } .success { color: green; } .error { color: red; } .info { background: #f0f0f0; padding: 1rem; margin: 1rem 0; border-radius: 4px; }</style>";

// 1. Test database connection
echo "<h2>1. Testando conexão com banco de dados...</h2>";
try {
    require_once 'admin/config/database.php';
    $db = getDB();
    echo "<p class='success'>✓ Conexão com banco de dados estabelecida com sucesso!</p>";
} catch (Exception $e) {
    echo "<p class='error'>✗ Erro na conexão: " . $e->getMessage() . "</p>";
    echo "<div class='info'><strong>Solução:</strong> Verifique se o arquivo admin/config/db_credentials.php existe e se a senha está configurada corretamente.</div>";
    exit;
}

// 2. Check tables
echo "<h2>2. Verificando tabelas do banco...</h2>";
$tables = ['users', 'players', 'categories', 'posts'];
foreach ($tables as $table) {
    try {
        $result = $db->query("SELECT COUNT(*) as count FROM $table");
        $count = $result->fetch()['count'];
        echo "<p class='success'>✓ Tabela '$table' existe e contém $count registro(s)</p>";
    } catch (Exception $e) {
        echo "<p class='error'>✗ Erro na tabela '$table': " . $e->getMessage() . "</p>";
    }
}

// 3. Check for published posts
echo "<h2>3. Verificando posts publicados...</h2>";
try {
    $stmt = $db->query("SELECT COUNT(*) as count FROM posts WHERE published = 1");
    $published_count = $stmt->fetch()['count'];

    if ($published_count > 0) {
        echo "<p class='success'>✓ Existem $published_count post(s) publicado(s)</p>";

        // Show some posts
        $stmt = $db->query("SELECT id, title, slug, created_at FROM posts WHERE published = 1 ORDER BY created_at DESC LIMIT 5");
        $posts = $stmt->fetchAll();

        echo "<div class='info'>";
        echo "<strong>Últimos posts publicados:</strong><ul>";
        foreach ($posts as $post) {
            echo "<li><a href='post.php?slug=" . htmlspecialchars($post['slug']) . "'>" . htmlspecialchars($post['title']) . "</a> (ID: {$post['id']})</li>";
        }
        echo "</ul></div>";
    } else {
        echo "<p style='color: orange;'>⚠ Nenhum post publicado ainda</p>";
        echo "<div class='info'><strong>Próximo passo:</strong> Acesse o painel admin em <a href='admin/auth/login.php'>admin/auth/login.php</a> e crie alguns posts!</div>";
    }
} catch (Exception $e) {
    echo "<p class='error'>✗ Erro ao verificar posts: " . $e->getMessage() . "</p>";
}

// 4. Check categories
echo "<h2>4. Verificando categorias...</h2>";
try {
    $stmt = $db->query("SELECT * FROM categories ORDER BY name");
    $categories = $stmt->fetchAll();

    if (!empty($categories)) {
        echo "<p class='success'>✓ Existem " . count($categories) . " categoria(s) cadastrada(s)</p>";
        echo "<div class='info'><strong>Categorias disponíveis:</strong> ";
        echo implode(', ', array_map(function($cat) {
            return htmlspecialchars($cat['name']);
        }, $categories));
        echo "</div>";
    } else {
        echo "<p style='color: orange;'>⚠ Nenhuma categoria encontrada</p>";
    }
} catch (Exception $e) {
    echo "<p class='error'>✗ Erro ao verificar categorias: " . $e->getMessage() . "</p>";
}

// 5. Test blog.php
echo "<h2>5. Links úteis</h2>";
echo "<div class='info'>";
echo "<ul>";
echo "<li><a href='blog.php' target='_blank'>Ver Blog (blog.php)</a></li>";
echo "<li><a href='admin/auth/login.php' target='_blank'>Acessar Admin (usuário: admin, senha: admin123)</a></li>";
echo "<li><a href='admin/posts/form.php' target='_blank'>Criar Novo Post</a></li>";
echo "</ul>";
echo "</div>";

echo "<h2 class='success'>✓ Teste concluído!</h2>";
echo "<p>Se todos os itens acima passaram, a integração está funcionando corretamente.</p>";
?>
