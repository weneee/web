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
    <title>Registro - Winbeaut</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main class="auth-container">
        <div class="auth-box">
            <h2 class="auth-title">Crear Cuenta</h2>
            
            <form id="registerForm" class="auth-form">
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required minlength="6">
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirmar Contraseña</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="btn-primary">Registrarse</button>
                
                <div id="message" class="message"></div>
            </form>
            
            <p class="auth-switch">
                ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
            </p>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const messageDiv = document.getElementById('message');
            
            if (password !== confirmPassword) {
                messageDiv.className = 'message error';
                messageDiv.textContent = 'Las contraseñas no coinciden';
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'register');
            formData.append('nombre', document.getElementById('nombre').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', password);
            
            try {
                const response = await fetch('api/auth.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    messageDiv.className = 'message success';
                    messageDiv.textContent = data.message;
                    
                    setTimeout(() => {
                        window.location.href = 'index.php';
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
