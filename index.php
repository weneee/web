<?php
require_once 'config/session.php';
require_once 'config/database.php';

$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT * FROM productos WHERE stock > 0 ORDER BY categoria, fecha_creacion DESC LIMIT 24";
$result = $conn->query($sql);
$productos = [];
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winbeaut - Productos de Belleza</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Winbeaut</h1>
                <p class="hero-subtitle">Descubre tu belleza natural</p>
                <p class="hero-description">Productos de maquillaje de alta calidad para realzar tu belleza</p>
                <!-- Agregar información de contacto del catálogo -->
                <div class="hero-contact">
                    <p>Instagram: @Winbeaut</p>
                    <p>Tel: 753 163 23 00 | 753 104 20 80</p>
                </div>
            </div>
        </section>
        
        <!-- Agregar filtros por categoría -->
        <section class="filtros-section">
            <div class="container">
                <div class="filtros">
                    <button class="filtro-btn active" onclick="filtrarCategoria('todas')">Todas</button>
                    <button class="filtro-btn" onclick="filtrarCategoria('Labiales')">Labiales</button>
                    <button class="filtro-btn" onclick="filtrarCategoria('Rostro')">Rostro</button>
                    <button class="filtro-btn" onclick="filtrarCategoria('Ojos')">Ojos</button>
                    <button class="filtro-btn" onclick="filtrarCategoria('Rubor')">Rubor</button>
                    <button class="filtro-btn" onclick="filtrarCategoria('Accesorios')">Accesorios</button>
                </div>
            </div>
        </section>
        
        <!-- Productos Destacados -->
        <section class="productos-section">
            <div class="container">
                <h2 class="section-title">Nuestros Productos</h2>
                
                <div class="productos-grid">
                    <?php foreach ($productos as $producto): ?>
                        <div class="producto-card" data-categoria="<?php echo htmlspecialchars($producto['categoria']); ?>">
                            <div class="producto-imagen">
                                <?php if ($producto['imagen']): ?>
                                    <img src="uploads/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" 
                                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                <?php else: ?>
                                    <div class="placeholder-image">
                                        <span>Sin imagen</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="producto-info">
                                <span class="producto-categoria"><?php echo htmlspecialchars($producto['categoria']); ?></span>
                                <h3 class="producto-nombre"><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                                <p class="producto-descripcion"><?php echo htmlspecialchars(substr($producto['descripcion'], 0, 60)); ?>...</p>
                                <div class="producto-footer">
                                    <span class="producto-precio">$<?php echo number_format($producto['precio'], 2); ?></span>
                                    <a href="producto-detalle.php?id=<?php echo $producto['id']; ?>" class="btn-ver-mas">Ver más</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="assets/js/main.js"></script>
    <script>
        function filtrarCategoria(categoria) {
            const productos = document.querySelectorAll('.producto-card');
            const botones = document.querySelectorAll('.filtro-btn');
            
            botones.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            productos.forEach(producto => {
                if (categoria === 'todas' || producto.dataset.categoria === categoria) {
                    producto.style.display = 'block';
                } else {
                    producto.style.display = 'none';
                }
            });
        }

        function agregarAlCarrito(productoId) {
            <?php if (!isLoggedIn()): ?>
                if (confirm('Debes iniciar sesión para comprar. ¿Deseas ir a la página de login?')) {
                    window.location.href = 'login.php';
                }
            <?php else: ?>
                // Agregar al carrito
                let carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
                const existe = carrito.find(item => item.id === productoId);
                
                if (existe) {
                    existe.cantidad++;
                } else {
                    carrito.push({ id: productoId, cantidad: 1 });
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
