<?php
require_once '../config/session.php';
require_once '../config/database.php';

requireLogin();
requireAdmin();

$db = new Database();
$conn = $db->getConnection();

// Obtener todos los productos
$sql = "SELECT * FROM productos ORDER BY fecha_creacion DESC";
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
    <title>Panel de Administración - Winbeaut</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <h2>Winbeaut Admin</h2>
            </div>
            <nav class="admin-nav">
                <a href="index.php" class="active">Productos</a>
                <a href="..api/pedidos.php">Pedidos</a>
                <a href="../index.php">Ver Tienda</a>
                <a href="#" onclick="logout()">Cerrar Sesión</a>
            </nav>
        </aside>
        
        <main class="admin-main">
            <header class="admin-header">
                <h1>Gestión de Productos</h1>
                <button class="btn-primary" onclick="mostrarFormulario()">Agregar Producto</button>
            </header>
            
             Formulario para agregar/editar producto 
            <div id="productoForm" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="cerrarFormulario()">&times;</span>
                    <h2 id="formTitle">Agregar Producto</h2>
                    
                    <form id="formProducto" enctype="multipart/form-data">
                        <input type="hidden" id="producto_id" name="id">
                        
                        <div class="form-group">
                            <label for="nombre">Nombre del Producto</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="precio">Precio ($)</label>
                                <input type="number" id="precio" name="precio" step="0.01" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" id="stock" name="stock" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <input type="text" id="categoria" name="categoria" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="imagen">Imagen del Producto</label>
                            <input type="file" id="imagen" name="imagen" accept="image/*">
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn-primary">Guardar Producto</button>
                            <button type="button" class="btn-secondary" onclick="cerrarFormulario()">Cancelar</button>
                        </div>
                        
                        <div id="formMessage" class="message"></div>
                    </form>
                </div>
            </div>
            
             Lista de productos 
            <div class="productos-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo $producto['id']; ?></td>
                                <td>
                                    <?php if ($producto['imagen']): ?>
                                        <img src="../uploads/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" 
                                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                             class="producto-thumb">
                                    <?php else: ?>
                                        <div class="producto-thumb-placeholder">Sin imagen</div>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                                <td><?php echo $producto['stock']; ?></td>
                                <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                                <td>
                                    <button class="btn-edit" onclick="editarProducto(<?php echo $producto['id']; ?>)">Editar</button>
                                    <button class="btn-delete" onclick="eliminarProducto(<?php echo $producto['id']; ?>)">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
    <script src="../assets/js/admin.js"></script>
</body>
</html>
<?php $db->close(); ?>
