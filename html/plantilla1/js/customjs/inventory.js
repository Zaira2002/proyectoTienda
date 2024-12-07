const apiUrl = "http://localhost/proyectotienda/php/api/producto.php"; // Cambia la URL si es necesario

// Referencia al cuerpo de la tabla
const productosTableBody = document.querySelector("#bodyTable tbody");

// Función para cargar los productos
async function loadProductos() {
    try {
        const response = await fetch(apiUrl);
        if (!response.ok) throw new Error("Error al obtener los datos");

        const productos = await response.json();

        // Limpiar la tabla antes de rellenarla
        productosTableBody.innerHTML = "";

        // Iterar sobre los productos y agregarlos a la tabla
        productos.forEach((producto) => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td  class="mdl-data-table__cell--non-numeric">${producto.nombre}</td>
                <td>${producto.id}</td>
                <td>${producto.descripcion}</td>
                <td>${producto.tipoNombre}</td> 
                <td>${producto.cantidad}</td>
                <td>${producto.precioUnitario}</td>
                 <td>
                    <button class="actualizar-btn" data-id="${producto.id}" style="background-color: #4CAF50; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                        Actualizar
                    </button>
                    <button class="eliminar-btn" data-id="${producto.id}" style="background-color: #f44336; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                        Eliminar
                    </button>
                </td>
                `;
                
                // <td><button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"><i class="zmdi zmdi-more"></i></button></td>
            productosTableBody.appendChild(row);
        });


        // Agregar eventos a los botones después de renderizar las filas
        document.querySelectorAll(".actualizar-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
                const id = btn.getAttribute("data-id");
                actualizarProducto(id); // Llamar a la función de actualización
            });
        });

        document.querySelectorAll(".eliminar-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
                const id = btn.getAttribute("data-id");
                eliminarProducto(id); // Llamar a la función de eliminación
            });
        });
    } catch (error) {
        console.error("Error al cargar los productos:", error);
    }
}

// Función para manejar la actualización (puedes personalizarla más adelante)
function actualizarProducto(id) {
    alert(`Actualizar producto con ID: ${id}`);
    // Aquí puedes mostrar un formulario con los datos para editar
}

// Función para manejar la eliminación
async function eliminarProducto(id) {
    if (confirm("¿Estás seguro de eliminar este producto?")) {
        try {
            const response = await fetch(`${apiUrl}?id=${id}`, { method: "DELETE" });
            if (response.ok) {
                alert("Producto eliminado correctamente");
                loadProductos(); // Recargar los productos después de eliminar
            } else {
                alert("Error al eliminar el producto");
            }
        } catch (error) {
            console.error("Error al eliminar el producto:", error);
        }
    }
}
// Llamar a la función para cargar los productos al cargar la página
loadProductos();