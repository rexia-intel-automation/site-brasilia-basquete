<?php
/**
 * Database Configuration and Connection
 * Brasília Basquete Admin Panel
 */

class Database {
    private $conn;
    private $credentials;

    public function __construct() {
        $this->loadCredentials();
        $this->connect();
        $this->createTables();
    }

    private function loadCredentials() {
        $credentials_file = __DIR__ . '/db_credentials.php';
        if (!file_exists($credentials_file)) {
            die("Arquivo de credenciais não encontrado. Certifique-se de que db_credentials.php existe.");
        }
        $this->credentials = require $credentials_file;

        // Validate required fields
        if (empty($this->credentials['password'])) {
            die("ATENÇÃO: Configure a senha do banco de dados em admin/config/db_credentials.php");
        }
    }

    private function connect() {
        try {
            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                $this->credentials['host'],
                $this->credentials['database'],
                $this->credentials['charset']
            );

            $this->conn = new PDO(
                $dsn,
                $this->credentials['username'],
                $this->credentials['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch(PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    private function createTables() {
        // Users table
        $sql_users = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        // Players table
        $sql_players = "CREATE TABLE IF NOT EXISTS players (
            id INT AUTO_INCREMENT PRIMARY KEY,
            number INT NOT NULL,
            name VARCHAR(100) NOT NULL,
            position VARCHAR(50) NOT NULL,
            photo TEXT,
            height VARCHAR(20),
            weight VARCHAR(20),
            birth_date DATE,
            nationality VARCHAR(50) DEFAULT 'Brasileiro',
            active TINYINT(1) DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        // Categories table
        $sql_categories = "CREATE TABLE IF NOT EXISTS categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) UNIQUE NOT NULL,
            slug VARCHAR(100) UNIQUE NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        // Posts table
        $sql_posts = "CREATE TABLE IF NOT EXISTS posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            slug VARCHAR(255) UNIQUE NOT NULL,
            excerpt TEXT,
            content LONGTEXT,
            featured_image TEXT,
            category_id INT,
            author_id INT,
            is_featured TINYINT(1) DEFAULT 0,
            published TINYINT(1) DEFAULT 1,
            views INT DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
            FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        try {
            $this->conn->exec($sql_users);
            $this->conn->exec($sql_players);
            $this->conn->exec($sql_categories);
            $this->conn->exec($sql_posts);

            // Insert default admin user if not exists (password: admin123)
            $check_user = $this->conn->query("SELECT COUNT(*) as count FROM users")->fetch();
            if ($check_user['count'] == 0) {
                $password = password_hash('admin123', PASSWORD_DEFAULT);
                $stmt = $this->conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                $stmt->execute(['admin', $password, 'admin@bsbbkt.com.br']);
            }

            // Insert default categories if not exist
            $check_categories = $this->conn->query("SELECT COUNT(*) as count FROM categories")->fetch();
            if ($check_categories['count'] == 0) {
                $categories = [
                    ['name' => 'Notícias', 'slug' => 'noticias'],
                    ['name' => 'Bastidores', 'slug' => 'bastidores'],
                    ['name' => 'Entrevistas', 'slug' => 'entrevistas'],
                    ['name' => 'Jogos', 'slug' => 'jogos'],
                    ['name' => 'Elenco', 'slug' => 'elenco'],
                    ['name' => 'História', 'slug' => 'historia']
                ];

                $stmt = $this->conn->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
                foreach ($categories as $cat) {
                    $stmt->execute([$cat['name'], $cat['slug']]);
                }
            }

        } catch(PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }
}

// Helper function to get database connection
function getDB() {
    static $db = null;
    if ($db === null) {
        $db = new Database();
    }
    return $db->getConnection();
}
