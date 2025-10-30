// Actualizar contador del carrito
function actualizarContadorCarrito() {
  const carrito = JSON.parse(localStorage.getItem("carrito") || "[]")
  const total = carrito.reduce((sum, item) => sum + item.cantidad, 0)
  const contador = document.getElementById("carrito-count")
  if (contador) {
    contador.textContent = total
  }
}

// Función para cerrar sesión
async function logout() {
  if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
    const formData = new FormData()
    formData.append("action", "logout")

    try {
      const response = await fetch("/api/auth.php", {
        method: "POST",
        body: formData,
      })

      const data = await response.json()

      if (data.success) {
        localStorage.removeItem("carrito")
        window.location.href = "/index.php"
      }
    } catch (error) {
      console.error("Error:", error)
    }
  }
}

// Inicializar al cargar la página
document.addEventListener("DOMContentLoaded", () => {
  actualizarContadorCarrito()
})
