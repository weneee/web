<?php
require_once 'config/session.php';
require_once 'config/database.php';

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
    <title>Mis Pedidos - Winbeaut</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="main-content">
        <div class="container">
            <h1 class="page-title">Mis Pedidos</h1>
            
            <div class="pedidos-lista" id="pedidos-lista">
                <!-- Los pedidos se cargarán con JavaScript -->
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="assets/js/main.js"></script>
    <script>
        async function cargarPedidos() {
            const response = await fetch('api/pedidos.php');
            const pedidos = await response.json();
            
            if (pedidos.length === 0) {
                document.getElementById('pedidos-lista').innerHTML = '<p class="sin-pedidos">No tienes pedidos aún</p>';
                return;
            }
            
            let html = '';
            pedidos.forEach(pedido => {
                const fecha = new Date(pedido.fecha_pedido).toLocaleDateString('es-MX');
                const estadoClass = pedido.estado.replace(' ', '-');
                
                html += `
                    <div class="pedido-card">
                        <div class="pedido-header">
                            <div>
                                <h3>Pedido #${pedido.id}</h3>
                                <p class="pedido-fecha">${fecha}</p>
                            </div>
                            <span class="pedido-estado ${estadoClass}">${pedido.estado}</span>
                        </div>
                        <div class="pedido-body">
                            <p><strong>Total de items:</strong> ${pedido.total_items}</p>
                            <p><strong>Total:</strong> $${parseFloat(pedido.total).toFixed(2)}</p>
                        </div>
                    </div>
                `;
            });
            
            document.getElementById('pedidos-lista').innerHTML = html;
        }
        
        cargarPedidos();
    </script>
</body>
</html>
<?php $db->close(); ?>
