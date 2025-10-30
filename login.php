<?php
require_once 'config/session.php';

// Si ya está logueado, redirigir
if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Winbeaut</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="auth-container">
        <div class="auth-box">
            <h2 class="auth-title">Iniciar Sesión</h2>
            
            <form id="loginForm" class="auth-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn-primary">Iniciar Sesión</button>
                
                <div id="message" class="message"></div>
            </form>
            
            <p class="auth-switch">
                ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
            </p>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData();
            formData.append('action', 'login');
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            
            try {
                const response = await fetch('api/auth.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                const messageDiv = document.getElementById('message');
                
                if (data.success) {
                    messageDiv.className = 'message success';
                    messageDiv.textContent = data.message;
                    
                    setTimeout(() => {
                        if (data.tipo_usuario === 'admin') {
                            window.location.href = 'admin/index.php';
                        } else {
                            window.location.href = 'index.php';
                        }
                    }, 1000);
                } else {
                    messageDiv.className = 'message error';
                    messageDiv.textContent = data.message;
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
</body>
</html>
