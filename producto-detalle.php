<?php
require_once 'config/session.php';
require_once 'config/database.php';

$db = new Database();
$conn = $db->getConnection();

$producto_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($producto_id <= 0) {
    header('Location: index.php');
    exit();
}

// Obtener información del producto
$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $producto_id);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

if (!$producto) {
    $_SESSION['error'] = 'Producto no encontrado';
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($producto['nombre']); ?> - Winbeaut</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="main-content">
        <div class="container">
            <!-- Agregado breadcrumb para mejor navegación -->
            <div class="breadcrumb">
                <a href="index.php">Inicio</a> / 
                <span><?php echo htmlspecialchars($producto['nombre']); ?></span>
            </div>
            
            <div class="producto-detalle">
                <div class="producto-detalle-imagen">
                    <?php if ($producto['imagen']): ?>
                        <img src="uploads/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" 
                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                             onerror="this.parentElement.innerHTML='<div class=\'placeholder-image-large\'><span>Sin imagen</span></div>'">
                    <?php else: ?>
                        <div class="placeholder-image-large">
                            <span>Sin imagen</span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="producto-detalle-info">
                    <h1 class="producto-detalle-nombre"><?php echo htmlspecialchars($producto['nombre']); ?></h1>
                    <p class="producto-detalle-categoria"><?php echo htmlspecialchars($producto['categoria']); ?></p>
                    
                    <div class="producto-detalle-precio">
                        <span class="precio-actual">$<?php echo number_format($producto['precio'], 2); ?></span>
                    </div>
                    
                    <div class="producto-detalle-descripcion">
                        <h3>Descripción</h3>
                        <p><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
                    </div>
                    
                    <div class="producto-detalle-stock">
                        <?php if ($producto['stock'] > 0): ?>
                            <span class="stock-disponible">✓ Disponible (<?php echo $producto['stock']; ?> en stock)</span>
                        <?php else: ?>
                            <span class="stock-agotado">✗ Agotado</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="producto-detalle-acciones">
                        <div class="cantidad-selector">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" id="cantidad" value="1" min="1" max="<?php echo $producto['stock']; ?>">
                        </div>
                        
                        <?php if ($producto['stock'] > 0): ?>
                            <button class="btn-agregar-carrito" onclick="agregarAlCarrito(<?php echo $producto['id']; ?>)">
                                Agregar al carrito
                            </button>
                        <?php endif; ?>
                        
                        <!-- Agregado botón para volver -->
                        <a href="index.php" class="btn-volver">← Volver a productos</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="assets/js/main.js"></script>
    <script>
        function agregarAlCarrito(productoId) {
            <?php if (!isLoggedIn()): ?>
                if (confirm('Debes iniciar sesión para comprar. ¿Deseas ir a la página de login?')) {
                    window.location.href = 'login.php?redirect=producto-detalle.php?id=' + productoId;
                }
            <?php else: ?>
                const cantidad = parseInt(document.getElementById('cantidad').value);
                let carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
                const existe = carrito.find(item => item.id === productoId);
                
                if (existe) {
                    existe.cantidad += cantidad;
                } else {
                    carrito.push({ id: productoId, cantidad: cantidad });
                }
                
                localStorage.setItem('carrito', JSON.stringify(carrito));
                alert('Producto agregado al carrito');
                actualizarContadorCarrito();
            <?php endif; ?>
        }
    </script>
</body>
</html>
<?php $db->close(); ?>
