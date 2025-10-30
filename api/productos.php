<?php
require_once '../config/database.php';
require_once '../config/session.php';

header('Content-Type: application/json');

$db = new Database();
$conn = $db->getConnection();

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'list':
        $sql = "SELECT * FROM productos ORDER BY fecha_creacion DESC";
        $result = $conn->query($sql);
        
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
        
        echo json_encode(['success' => true, 'productos' => $productos]);
        break;
        
    case 'get':
        $id = intval($_GET['id'] ?? 0);
        $sql = "SELECT * FROM productos WHERE id = $id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo json_encode(['success' => true, 'producto' => $result->fetch_assoc()]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        }
        break;
    
    case 'obtener_por_ids':
        $ids = $_GET['ids'] ?? '';
        if (empty($ids)) {
            echo json_encode([]);
            break;
        }
        
        $ids_array = explode(',', $ids);
        $ids_array = array_map('intval', $ids_array);
        $placeholders = implode(',', array_fill(0, count($ids_array), '?'));
        
        $sql = "SELECT * FROM productos WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat('i', count($ids_array)), ...$ids_array);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
        
        echo json_encode($productos);
        break;
        
    case 'create':
        requireAdmin();
        
        $nombre = $conn->real_escape_string($_POST['nombre'] ?? '');
        $descripcion = $conn->real_escape_string($_POST['descripcion'] ?? '');
        $precio = floatval($_POST['precio'] ?? 0);
        $categoria = $conn->real_escape_string($_POST['categoria'] ?? '');
        $stock = intval($_POST['stock'] ?? 0);
        
        $imagen = '';
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            $upload_dir = '../uploads/productos/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $imagen = uniqid() . '.' . $extension;
            
            // Corregida: agregada barra diagonal entre directorio y nombre de archivo
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $upload_dir . $imagen)) {
                // Imagen subida exitosamente
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al subir la imagen']);
                exit;
            }
        }
        
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen, categoria, stock) 
                VALUES ('$nombre', '$descripcion', $precio, '$imagen', '$categoria', $stock)";
        
        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'message' => 'Producto creado exitosamente', 'id' => $conn->insert_id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear producto: ' . $conn->error]);
        }
        break;
        
    case 'update':
        requireAdmin();
        
        $id = intval($_POST['id'] ?? 0);
        $nombre = $conn->real_escape_string($_POST['nombre'] ?? '');
        $descripcion = $conn->real_escape_string($_POST['descripcion'] ?? '');
        $precio = floatval($_POST['precio'] ?? 0);
        $categoria = $conn->real_escape_string($_POST['categoria'] ?? '');
        $stock = intval($_POST['stock'] ?? 0);
        
        $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', 
                precio=$precio, categoria='$categoria', stock=$stock WHERE id=$id";
        
        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'message' => 'Producto actualizado']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar producto']);
        }
        break;
        
    case 'delete':
        requireAdmin();
        
        $id = intval($_POST['id'] ?? 0);
        $sql = "DELETE FROM productos WHERE id = $id";
        
        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'message' => 'Producto eliminado']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar producto']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
}

$db->close();
?>
