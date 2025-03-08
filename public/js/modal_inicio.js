
    // Función para abrir el modal
    function abrirModal() {
        const modal = document.getElementById('miModal');
        modal.style.display = 'flex'; // Muestra el modal
    }

    // Función para cerrar el modal
    function cerrarModal() {
        const modal = document.getElementById('miModal');
        modal.style.display = 'none'; // Oculta el modal
    }

    // Función para finalizar (puedes agregar lógica adicional aquí)
    function finalizar() {
        alert('Ruta finalizada'); // Ejemplo de acción
        cerrarModal(); // Cierra el modal después de finalizar
    }
