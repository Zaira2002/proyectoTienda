<?php
header("Content-Type: application/json");
include '../config.php';
$method = $_SERVER['REQUEST_METHOD'];

try {
   
    // Consultar la cantidad de usuarios
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM usuario");
    $usuarios = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Consultar la cantidad de categorías
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM tipo");
    $categorias = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Consultar la cantidad de productos
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM producto");
    $productos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Consultar la cantidad de ventas
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM factura");
    $ventas = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Construir la respuesta en formato JSON
    echo json_encode([
        'usuarios' => $usuarios,
        'categorias' => $categorias,
        'productos' => $productos,
        'ventas' => $ventas
    ]);
} catch (PDOException $e) {
    // En caso de error, devolver un mensaje de error
    echo json_encode(['error' => $e->getMessage()]);
}
?>