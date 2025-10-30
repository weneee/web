function mostrarFormulario() {
  document.getElementById("productoForm").style.display = "flex"
  document.getElementById("formTitle").textContent = "Agregar Producto"
  document.getElementById("formProducto").reset()
  document.getElementById("producto_id").value = ""
}

function cerrarFormulario() {
  document.getElementById("productoForm").style.display = "none"
}

async function editarProducto(id) {
  try {
    const response = await fetch(`../api/productos.php?action=get&id=${id}`)
    const data = await response.json()

    if (data.success) {
      const producto = data.producto
      document.getElementById("producto_id").value = producto.id
      document.getElementById("nombre").value = producto.nombre
      document.getElementById("descripcion").value = producto.descripcion
      document.getElementById("precio").value = producto.precio
      document.getElementById("stock").value = producto.stock
      document.getElementById("categoria").value = producto.categoria

      document.getElementById("formTitle").textContent = "Editar Producto"
      document.getElementById("productoForm").style.display = "flex"
    }
  } catch (error) {
    console.error("Error:", error)
  }
}

async function eliminarProducto(id) {
  if (!confirm("¿Estás seguro de que deseas eliminar este producto?")) {
    return
  }

  const formData = new FormData()
  formData.append("action", "delete")
  formData.append("id", id)

  try {
    const response = await fetch("../api/productos.php", {
      method: "POST",
      body: formData,
    })

    const data = await response.json()

    if (data.success) {
      alert(data.message)
      location.reload()
    } else {
      alert(data.message)
    }
  } catch (error) {
    console.error("Error:", error)
  }
}

document.getElementById("formProducto").addEventListener("submit", async (e) => {
  e.preventDefault()

  const formData = new FormData(e.target)
  const productoId = document.getElementById("producto_id").value

  if (productoId) {
    formData.append("action", "update")
  } else {
    formData.append("action", "create")
  }

  try {
    const response = await fetch("../api/productos.php", {
      method: "POST",
      body: formData,
    })

    const data = await response.json()
    const messageDiv = document.getElementById("formMessage")

    if (data.success) {
      messageDiv.className = "message success"
      messageDiv.textContent = data.message

      setTimeout(() => {
        location.reload()
      }, 1500)
    } else {
      messageDiv.className = "message error"
      messageDiv.textContent = data.message
    }
  } catch (error) {
    console.error("Error:", error)
  }
})

async function logout() {
  if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
    const formData = new FormData()
    formData.append("action", "logout")

    try {
      const response = await fetch("../api/auth.php", {
        method: "POST",
        body: formData,
      })

      const data = await response.json()

      if (data.success) {
        window.location.href = "../index.php"
      }
    } catch (error) {
      console.error("Error:", error)
    }
  }
}
