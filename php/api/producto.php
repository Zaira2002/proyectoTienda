<?php
header("Content-Type: application/json");
include '../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("SELECT * FROM producto WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $pdo->query("SELECT * FROM producto");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO producto (nombre, descripcion, idTipo, cantidad, precioUnitario) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['idTipo'], $data['cantidad'], $data['precioUnitario']]);
        echo json_encode(['id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("UPDATE producto SET nombre = ?, descripcion = ?, idTipo = ?, cantidad = ?, precioUnitario = ? WHERE id = ?");
        $stmt->execute([$data['nombre'], $data['descripcion'], $data['idTipo'], $data['cantidad'], $data['precioUnitario'], $data['id']]);
        echo json_encode(['success' => true]);
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM producto WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode(['success' => true]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
}
?>