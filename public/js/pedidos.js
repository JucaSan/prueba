let pedidos = []; // Array para almacenar los pedidos

// Función para abrir el modal
function abrirModal() {
    document.querySelector('.modal').style.display = 'block';
}

// Función para cerrar el modal
function cerrarModal() {
    document.querySelector('.modal').style.display = 'none';
}

// Función para agregar un pedido a la lista
function agregarPedido() {
    const nuevoPedido = document.getElementById('nuevo_pedido').value.trim();

    // Validar que solo se ingresen números
    if (!/^\d+$/.test(nuevoPedido)) {
        alert("Solo se permiten números.");
        return;
    }

    // Evitar duplicados
    if (pedidos.includes(nuevoPedido)) {
        alert("Este número de pedido ya fue agregado.");
        return;
    }

    // Agregar el pedido a la lista
    pedidos.push(nuevoPedido);
    actualizarListaPedidos();
    document.getElementById('nuevo_pedido').value = ""; // Limpiar el input
}

// Función para actualizar la lista de pedidos en el modal
function actualizarListaPedidos() {
    const lista = document.querySelector('.modal__list');
    lista.innerHTML = ""; // Limpiar la lista

    pedidos.forEach((pedido, index) => {
        const li = document.createElement('li');
        li.className = "modal__list-item";
        li.innerHTML = `
            <span class="modal__list-text">${pedido}</span>
            <button onclick="eliminarPedido(${index})" class="modal__button modal__button--delete">Eliminar</button>
        `;
        lista.appendChild(li);
    });
}

// Función para eliminar un pedido de la lista
function eliminarPedido(index) {
    pedidos.splice(index, 1); // Eliminar el pedido del array
    actualizarListaPedidos(); // Actualizar la lista
}

// Función para finalizar y actualizar el input principal
function finalizar() {
    const inputPedido = document.getElementById('numero_pedido');
    inputPedido.value = pedidos.join(", "); // Unir los pedidos con comas
    cerrarModal();
}

// Asignar el evento de click al input de número de pedido
document.getElementById('numero_pedido').addEventListener('click', abrirModal);
