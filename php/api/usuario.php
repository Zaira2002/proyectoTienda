<?php
header("Content-Type: application/json");
include '../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Obtener todos los usuarios o uno por ID
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $pdo->query("SELECT * FROM usuario");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($result);
        break;

    case 'POST':
        // Crear un nuevo usuario
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO usuario (nombreUsuario, idRol) VALUES (?, ?)");
        $stmt->execute([$data['nombreUsuario'], $data['idRol']]);
        echo json_encode(['id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        // Actualizar un usuario existente
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("UPDATE usuario SET nombreUsuario = ?, idRol = ? WHERE id = ?");
        $stmt->execute([$data['nombreUsuario'], $data['idRol'], $data['id']]);
        echo json_encode(['success' => true]);
        break;

    case 'DELETE':
        // Eliminar un usuario
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM usuario WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode(['success' => true]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
}
?>