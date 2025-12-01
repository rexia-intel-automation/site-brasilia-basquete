<?php
/**
 * Database Configuration and Connection
 * Brasília Basquete Admin Panel
 */

class Database {
    private $db_file = __DIR__ . '/../data/brasilia_basquete.db';
    private $conn;

    public function __construct() {
        $this->connect();
        $this->createTables();
    }

    private function connect() {
        try {
            // Create data directory if it doesn't exist
            $data_dir = dirname($this->db_file);
            if (!file_exists($data_dir)) {
                mkdir($data_dir, 0755, true);
            }

            $this->conn = new PDO('sqlite:' . $this->db_file);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    private function createTables() {
        // Users table
        $sql_users = "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL,
            email TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";

        // Players table
        $sql_players = "CREATE TABLE IF NOT EXISTS players (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            number INTEGER NOT NULL,
            name TEXT NOT NULL,
            position TEXT NOT NULL,
            photo TEXT,
            height TEXT,
            weight TEXT,
            birth_date DATE,
            nationality TEXT DEFAULT 'Brasileiro',
            active INTEGER DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";

        // Categories table
        $sql_categories = "CREATE TABLE IF NOT EXISTS categories (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT UNIQUE NOT NULL,
            slug TEXT UNIQUE NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";

        // Posts table
        $sql_posts = "CREATE TABLE IF NOT EXISTS posts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            slug TEXT UNIQUE NOT NULL,
            excerpt TEXT,
            content TEXT,
            featured_image TEXT,
            category_id INTEGER,
            author_id INTEGER,
            is_featured INTEGER DEFAULT 0,
            published INTEGER DEFAULT 1,
            views INTEGER DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id),
            FOREIGN KEY (author_id) REFERENCES users(id)
        )";

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
