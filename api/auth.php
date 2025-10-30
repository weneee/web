<?php
require_once '../config/database.php';
require_once '../config/session.php';

header('Content-Type: application/json');

$db = new Database();
$conn = $db->getConnection();

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'register':
        $nombre = $conn->real_escape_string($_POST['nombre'] ?? '');
        $email = $conn->real_escape_string($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($nombre) || empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Todos los campos son requeridos']);
            exit();
        }
        
        // Verificar si el email ya existe
        $check = $conn->query("SELECT id FROM usuarios WHERE email = '$email'");
        if ($check->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'El email ya está registrado']);
            exit();
        }
        
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO usuarios (nombre, email, password, tipo_usuario) VALUES ('$nombre', '$email', '$password_hash', 'cliente')";
        
        if ($conn->query($sql)) {
            $usuario_id = $conn->insert_id;
            $_SESSION['usuario_id'] = $usuario_id;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['email'] = $email;
            $_SESSION['tipo_usuario'] = 'cliente';
            
            echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar usuario']);
        }
        break;
        
    case 'login':
        $email = $conn->real_escape_string($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Email y contraseña son requeridos']);
            exit();
        }
        
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            
            if (password_verify($password, $usuario['password'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                
                echo json_encode([
                    'success' => true, 
                    'message' => 'Login exitoso',
                    'tipo_usuario' => $usuario['tipo_usuario']
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }
        break;
        
    case 'logout':
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'Sesión cerrada']);
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
}

$db->close();
?>
