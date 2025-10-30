<?php
require_once '../config/session.php';
require_once '../config/database.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit();
}

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $items = $data['items'] ?? [];
    
    if (empty($items)) {
        echo json_encode(['success' => false, 'message' => 'Carrito vacío']);
        exit();
    }
    
    // Calcular total
    $total = 0;
    $ids = array_map(function($item) { return intval($item['id']); }, $items);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    
    $sql = "SELECT id, precio, stock FROM productos WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[$row['id']] = $row;
    }
    
    // Verificar stock y calcular total
    foreach ($items as $item) {
        $producto = $productos[$item['id']] ?? null;
        if (!$producto || $producto['stock'] < $item['cantidad']) {
            echo json_encode(['success' => false, 'message' => 'Stock insuficiente']);
            exit();
        }
        $total += $producto['precio'] * $item['cantidad'];
    }
    
    // Crear pedido
    $conn->begin_transaction();
    
    try {
        $usuario_id = $_SESSION['usuario_id'];
        $sql = "INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("id", $usuario_id, $total);
        $stmt->execute();
        $pedido_id = $conn->insert_id;
        
        // Insertar detalles del pedido
        $sql = "INSERT INTO detalle_pedidos (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        foreach ($items as $item) {
            $producto = $productos[$item['id']];
            $stmt->bind_param("iiid", $pedido_id, $item['id'], $item['cantidad'], $producto['precio']);
            $stmt->execute();
            
            // Actualizar stock
            $sql_stock = "UPDATE productos SET stock = stock - ? WHERE id = ?";
            $stmt_stock = $conn->prepare($sql_stock);
            $stmt_stock->bind_param("ii", $item['cantidad'], $item['id']);
            $stmt_stock->execute();
        }
        
        $conn->commit();
        echo json_encode(['success' => true, 'pedido_id' => $pedido_id]);
        
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Error al procesar pedido']);
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener pedidos del usuario
    $usuario_id = $_SESSION['usuario_id'];
    
    $sql = "SELECT p.*, COUNT(dp.id) as total_items 
            FROM pedidos p 
            LEFT JOIN detalle_pedidos dp ON p.id = dp.pedido_id 
            WHERE p.usuario_id = ? 
            GROUP BY p.id 
            ORDER BY p.fecha_pedido DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $pedidos = [];
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
    
    echo json_encode($pedidos);
}

$db->close();
?>
