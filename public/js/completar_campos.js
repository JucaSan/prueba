// Función para formatear la hora como HH:MM
function formatearHora(fecha) {
    const horas = String(fecha.getHours()).padStart(2, '0');
    const minutos = String(fecha.getMinutes()).padStart(2, '0');
    return `${horas}:${minutos}`;
}

// Función para formatear la fecha como YYYY-MM-DD
function formatearFecha(fecha) {
    return fecha.toISOString().split('T')[0];
}

// Función para actualizar la hora y fecha en los campos del formulario
function actualizarFechaYHora() {
    const fechaActual = new Date();
    document.getElementById('hora_entrada').value = formatearHora(fechaActual);
    document.getElementById('fecha_entrada').value = formatearFecha(fechaActual);
}
// Función para verificar si los campos requeridos están llenos
function verificarCampos() {
    const conductor = document.getElementById('conductor').value.trim();
    const guardia = document.getElementById('guardia_turno').value.trim();
    const auto = document.getElementById('auto').value.trim();


    // Si todos los campos están llenos, actualizar fecha y hora
    if (conductor && guardia && auto) {
        actualizarFechaYHora();
    }
}
// Asignar eventos a los campos para verificar cuando cambien
document.getElementById('conductor').addEventListener('input', verificarCampos);
document.getElementById('guardia_turno').addEventListener('input', verificarCampos);
document.getElementById('auto').addEventListener('input', verificarCampos);
