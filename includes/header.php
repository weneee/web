<?php
if (!isset($_SESSION)) {
    session_start();
}
$usuario = getCurrentUser();
?>
<header class="header">
    <div class="container">
        <div class="header-content">
            <a href="/index.php" class="logo">
                <h1>Winbeaut</h1>
            </a>
            
            <nav class="nav">
                <a href="index.php">Inicio</a>
                <a href="api/productos.php">Productos</a>
                
                <?php if ($usuario): ?>
                    <?php if ($usuario['tipo_usuario'] === 'admin'): ?>
                        <a href="/admin/index.php">Panel Admin</a>
                    <?php endif; ?>
                    <a href="carrito.php">Carrito <span id="carrito-count" class="badge">0</span></a>
                    <div class="user-menu">
                        <span>Hola, <?php echo htmlspecialchars($usuario['nombre']); ?></span>
                        <a href="#" onclick="logout()">Cerrar Sesión</a>
                    </div>
                <?php else: ?>
                    <a href="login.php">Iniciar Sesión</a>
                    <a href="registro.php" class="btn-register">Registrarse</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>
