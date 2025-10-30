# Winbeaut - Aplicación de Comercio Electrónico

Aplicación web de e-commerce desarrollada en PHP con MySQL para la tienda de productos de belleza Winbeaut.

## Características

- ✅ Sistema de autenticación (registro e inicio de sesión)
- ✅ Dos tipos de usuarios: Clientes y Administradores
- ✅ Catálogo completo de productos con imágenes
- ✅ Filtros por categoría (Labiales, Rostro, Ojos, Rubor, Accesorios)
- ✅ Panel de administración para gestionar productos
- ✅ Carrito de compras funcional
- ✅ Sistema de pedidos completo
- ✅ Gestión de stock automática
- ✅ Vista detallada de productos
- ✅ Historial de pedidos para clientes
- ✅ Base de datos MySQL local
- ✅ Diseño responsive y moderno con estética del catálogo Winbeaut

## Requisitos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- XAMPP, WAMP, MAMP o similar para desarrollo local

## Instalación

### 1. Configurar el servidor local

Si usas XAMPP:
- Descarga e instala XAMPP desde https://www.apachefriends.org/
- Inicia Apache y MySQL desde el panel de control de XAMPP

### 2. Copiar archivos

- Copia todos los archivos del proyecto a la carpeta `htdocs` de XAMPP
- Ejemplo: `C:\xampp\htdocs\winbeaut\`

### 3. Crear la base de datos

1. Abre phpMyAdmin en tu navegador: `http://localhost/phpmyadmin`
2. Haz clic en "Nueva" para crear una nueva base de datos
3. Nombre: `winbeaut_db`
4. Cotejamiento: `utf8mb4_unicode_ci`
5. Haz clic en "Crear"

### 4. Importar estructura y datos

1. Selecciona la base de datos `winbeaut_db`
2. Ve a la pestaña "Importar"
3. Importa primero: `database/schema.sql` (estructura y usuario admin)
4. Importa después: `database/productos_catalogo.sql` (todos los productos del catálogo)

### 5. Configurar la conexión

- Abre el archivo `config/database.php`
- Verifica que las credenciales sean correctas:
  \`\`\`php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'winbeaut_db');
  \`\`\`

### 6. Verificar carpeta de uploads

- La carpeta `uploads/productos/` ya incluye las imágenes de los productos
- Asegúrate de que tenga permisos de escritura para subir nuevas imágenes

### 7. Acceder a la aplicación

- Abre tu navegador y ve a: `http://localhost/winbeaut/`

## Credenciales por defecto

**Administrador:**
- Email: admin@winbeaut.com
- Contraseña: admin123

**Clientes:**
- Los clientes pueden registrarse desde la página de registro

## Estructura del proyecto

\`\`\`
winbeaut/
├── api/
│   ├── auth.php          # API de autenticación
│   ├── productos.php     # API de productos (CRUD completo)
│   └── pedidos.php       # API de pedidos
├── admin/
│   └── index.php         # Panel de administración
├── assets/
│   ├── css/
│   │   ├── style.css     # Estilos principales
│   │   └── admin.css     # Estilos del admin
│   └── js/
│       ├── main.js       # JavaScript principal
│       └── admin.js      # JavaScript del admin
├── config/
│   ├── database.php      # Configuración de BD
│   └── session.php       # Manejo de sesiones
├── database/
│   ├── schema.sql              # Esquema de la base de datos
│   └── productos_catalogo.sql  # Productos del catálogo Winbeaut
├── includes/
│   ├── header.php        # Header compartido
│   └── footer.php        # Footer compartido
├── uploads/
│   └── productos/        # Imágenes de productos (60+ productos)
├── index.php             # Página principal con filtros
├── login.php             # Página de login
├── registro.php          # Página de registro
├── producto-detalle.php  # Vista detallada de producto
├── carrito.php           # Carrito de compras
├── mis-pedidos.php       # Historial de pedidos
├── INSTRUCCIONES_INSTALACION.txt  # Guía detallada
└── README.md             # Este archivo
\`\`\`

## Uso

### Para Clientes:

1. **Registrarse** en la aplicación desde la página de registro
2. **Iniciar sesión** con tu email y contraseña
3. **Navegar** por los productos en la página principal
4. **Filtrar** productos por categoría (Labiales, Rostro, Ojos, etc.)
5. **Ver detalles** de un producto haciendo clic en "Ver más"
6. **Agregar al carrito** los productos deseados
7. **Ir al carrito** para revisar tu compra
8. **Finalizar compra** para crear el pedido
9. **Ver historial** de pedidos en "Mis Pedidos"

### Para Administradores:

1. **Iniciar sesión** con credenciales de admin
2. **Acceder al panel** de administración
3. **Agregar productos** con nombre, descripción, precio, categoría, stock e imagen
4. **Editar productos** existentes
5. **Eliminar productos** del catálogo
6. **Gestionar inventario** actualizando el stock

## Funcionalidades principales

### Sistema de Autenticación
- Registro de nuevos usuarios con validación
- Inicio de sesión seguro con contraseñas hasheadas (bcrypt)
- Sesiones PHP para mantener usuarios logueados
- Roles de usuario (cliente/admin)
- Cierre de sesión seguro

### Catálogo de Productos
- **60+ productos** del catálogo Winbeaut incluidos
- Vista de tarjetas con imágenes de alta calidad
- Filtros por categoría en tiempo real
- Información detallada: nombre, descripción, precio, stock
- Vista detallada individual de cada producto
- Indicador de disponibilidad de stock

### Carrito de Compras
- Agregar productos con cantidad personalizada
- Ver resumen del carrito
- Modificar cantidades desde el carrito
- Eliminar productos del carrito
- Cálculo automático de totales
- Persistencia con localStorage

### Sistema de Pedidos
- Creación de pedidos desde el carrito
- Actualización automática de stock
- Estados de pedido (pendiente, procesando, completado, cancelado)
- Historial completo de pedidos para cada cliente
- Detalles de cada pedido con productos y cantidades

### Gestión de Productos (Admin)
- Crear nuevos productos con formulario completo
- Subida de imágenes de productos
- Editar productos existentes
- Eliminar productos
- Gestión de stock
- Organización por categorías

### Protección de Rutas
- Redirección automática a login si usuario no autenticado intenta comprar
- Panel de administración solo accesible para admins
- Validación de permisos en todas las operaciones sensibles

### Diseño y UX
- Diseño inspirado en el catálogo Winbeaut (rosa, morado, femenino)
- Responsive para móviles, tablets y desktop
- Animaciones suaves y transiciones
- Interfaz intuitiva y fácil de usar
- Mensajes de confirmación y error claros

## Productos incluidos

El catálogo incluye más de 60 productos organizados en categorías:

- **Labiales**: Lip liner, Mousse matte, Lip oil, Lip gloss, Lipstick, Tinta, etc.
- **Rostro**: BB cream, Primer, Maquillaje compacto, Concealer, Paletas, etc.
- **Ojos**: Eyeliner, Rimel, Mascara de pestañas, etc.
- **Cejas**: Gel fijador, Lápiz de ceja, Brocha para ceja, etc.
- **Rubor**: Rubor líquido, Rubor en polvo, Rubor en barra, etc.
- **Accesorios**: Esponjas, Borlas, Brochas, Sacapuntas, Fijador, etc.
- **Premium**: Productos de marcas como Kiko Milano, Elf, Beauty Creations, Moira, etc.

## Personalización

### Cambiar colores
Edita las variables CSS en `assets/css/style.css`:
\`\`\`css
:root {
    --primary: #e91e63;      /* Rosa principal */
    --primary-dark: #c2185b; /* Rosa oscuro */
    --secondary: #9c27b0;    /* Morado */
    --accent: #ff4081;       /* Rosa acento */
}
\`\`\`

### Agregar más productos
1. Inicia sesión como administrador
2. Ve al panel de administración
3. Usa el formulario para agregar productos con todos los detalles
4. Sube una imagen del producto

### Modificar categorías
Edita las categorías en:
- `index.php` (filtros)
- `database/schema.sql` (si quieres agregar más categorías predefinidas)

## Solución de problemas

### Error de conexión a la base de datos
- Verifica que MySQL esté corriendo en XAMPP
- Revisa las credenciales en `config/database.php`
- Asegúrate de que la base de datos `winbeaut_db` exista

### Las imágenes no se muestran
- Verifica que la carpeta `uploads/productos/` exista
- Verifica los permisos de escritura de la carpeta
- Asegúrate de que las imágenes estén en la carpeta correcta

### No puedo agregar productos como admin
- Verifica que hayas iniciado sesión con admin@winbeaut.com
- Verifica que la carpeta uploads tenga permisos de escritura
- Revisa la consola del navegador para errores JavaScript

### Error 404
- Verifica que Apache esté corriendo
- Asegúrate de acceder a `http://localhost/winbeaut/` (con /winbeaut/)
- Verifica que los archivos estén en la carpeta correcta de htdocs

## Tecnologías utilizadas

- **Backend**: PHP 7.4+
- **Base de datos**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Servidor**: Apache (XAMPP)
- **Seguridad**: Password hashing con bcrypt, sesiones PHP, validación de datos

## Contacto y Soporte

Para más información sobre Winbeaut:
- **Instagram**: @Winbeaut
- **Teléfono**: 753 163 23 00
- **Teléfono**: 753 104 20 80

## Licencia

Este proyecto es propiedad de Winbeaut. Todos los derechos reservados.

---

**Desarrollado con ❤️ para Winbeaut**
