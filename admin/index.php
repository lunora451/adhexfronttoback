<?php
require_once "config.php";

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$request_method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');


error_log("Path reçu : " . $path);

switch ($path) {
    case 'users':
    case 'admin/index.php/users':
        if ($request_method == 'GET') {
            getUsers($pdo);
        }
        break;

    case (preg_match('/^users\/(\d+)$/', $path, $matches) ? true : false):
        if ($request_method == 'GET') {
            getUser($pdo, $matches[1]);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => $path]);
        break;
}

// Récupérer tous les utilisateurs
function getUsers($pdo)
{


    try {
        $stmt = $pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

// Récupérer un utilisateur par ID
function getUser($pdo, $id)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Utilisateur non trouvé']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
