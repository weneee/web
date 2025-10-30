<?php
require_once 'config/session.php';
require_once 'config/database.php';

// Verificar que el usuario esté logueado
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$db = new Database();
$conn = $db->getConnection();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Winbeaut</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="main-content">
        <div class="container">
            <h1 class="page-title">Mi Carrito</h1>
            
            <div class="carrito-container">
                <div class="carrito-items" id="carrito-items">
                    <!-- Los items se cargarán con JavaScript -->
                </div>
                
                <div class="carrito-resumen">
                    <h2>Resumen del pedido</h2>
                    <div class="resumen-linea">
                        <span>Subtotal:</span>
                        <span id="subtotal">$0.00</span>
                    </div>
                    <div class="resumen-linea">
                        <span>Envío:</span>
                        <span>Gratis</span>
                    </div>
                    <div class="resumen-linea total">
                        <span>Total:</span>
                        <span id="total">$0.00</span>
                    </div>
                    <button class="btn-primary btn-finalizar" onclick="finalizarCompra()">
                        Finalizar compra
                    </button>
                </div>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="assets/js/main.js"></script>
    <script>
        // Cargar productos del carrito
        async function cargarCarrito() {
            const carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
            
            if (carrito.length === 0) {
                document.getElementById('carrito-items').innerHTML = '<p class="carrito-vacio">Tu carrito está vacío</p>';
                return;
            }
            
            const ids = carrito.map(item => item.id).join(',');
            const response = await fetch(`api/productos.php?action=obtener_por_ids&ids=${ids}`);
            const productos = await response.json();
            
            let html = '';
            let subtotal = 0;
            
            carrito.forEach(item => {
                const producto = productos.find(p => p.id == item.id);
                if (producto) {
                    const total = producto.precio * item.cantidad;
                    subtotal += total;
                    
                    html += `
                        <div class="carrito-item">
                            <img src="uploads/productos/${producto.imagen}" alt="${producto.nombre}">
                            <div class="item-info">
                                <h3>${producto.nombre}</h3>
                                <p class="item-precio">$${parseFloat(producto.precio).toFixed(2)}</p>
                            </div>
                            <div class="item-cantidad">
                                <button onclick="cambiarCantidad(${producto.id}, -1)">-</button>
                                <span>${item.cantidad}</span>
                                <button onclick="cambiarCantidad(${producto.id}, 1)">+</button>
                            </div>
                            <div class="item-total">
                                <p>$${total.toFixed(2)}</p>
                                <button class="btn-eliminar" onclick="eliminarDelCarrito(${producto.id})">Eliminar</button>
                            </div>
                        </div>
                    `;
                }
            });
            
            document.getElementById('carrito-items').innerHTML = html;
            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `$${subtotal.toFixed(2)}`;
        }
        
        function cambiarCantidad(productoId, cambio) {
            let carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
            const item = carrito.find(i => i.id === productoId);
            
            if (item) {
                item.cantidad += cambio;
                if (item.cantidad <= 0) {
                    carrito = carrito.filter(i => i.id !== productoId);
                }
                localStorage.setItem('carrito', JSON.stringify(carrito));
                cargarCarrito();
                actualizarContadorCarrito();
            }
        }
        
        function eliminarDelCarrito(productoId) {
            let carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
            carrito = carrito.filter(i => i.id !== productoId);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            cargarCarrito();
            actualizarContadorCarrito();
        }
        
        async function finalizarCompra() {
            const carrito = JSON.parse(localStorage.getItem('carrito') || '[]');
            
            if (carrito.length === 0) {
                alert('Tu carrito está vacío');
                return;
            }
            
            const response = await fetch('api/pedidos.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ items: carrito })
            });
            
            const result = await response.json();
            
            if (result.success) {
                localStorage.removeItem('carrito');
                alert('¡Pedido realizado con éxito!');
                window.location.href = 'mis-pedidos.php';
            } else {
                alert('Error al procesar el pedido: ' + result.message);
            }
        }
        
        // Cargar carrito al iniciar
        cargarCarrito();
    </script>
</body>
</html>
<?php $db->close(); ?>
