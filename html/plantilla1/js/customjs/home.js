// URL del backend para obtener los datos
const apiUrl = "http://localhost/proyectotienda/php/api/dashboard.php";

// Función para cargar los datos y rellenar los cuadros
async function loadDashboardData() {
    try {
        const response = await fetch(apiUrl);
        if (!response.ok) throw new Error("Error al obtener los datos del dashboard");

        const data = await response.json();

        // Actualizar los cuadros con los datos obtenidos
        document.getElementById("usuarios-count").innerText = data.usuarios;
        document.getElementById("categorias-count").innerText = data.categorias;
        document.getElementById("productos-count").innerText = data.productos;
        document.getElementById("ventas-count").innerText = data.ventas;
    } catch (error) {
        console.error("Error al cargar los datos del dashboard:", error);
    }
}

// Llamar a la función cuando la página se cargue
document.addEventListener("DOMContentLoaded", loadDashboardData);