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
// Escáner de QR
let html5QrCode;

document.getElementById('btn-scan').addEventListener('click', function() {
    Swal.fire({
        title: 'Escanear QR',
        html: '<div id="qr-reader" style="width: 100%;"></div>',
        showConfirmButton: false,
        allowOutsideClick: false,
        willOpen: () => {
            // Inicializar el escáner dentro del toast
            html5QrCode = new Html5Qrcode("qr-reader");
            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                // Asignar el texto escaneado al campo "unidad"
                document.getElementById('unidad').value = decodedText;

                // Actualizar la fecha y hora en el momento del escaneo
                actualizarFechaYHora();

                // Detener el escáner antes de cerrar el modal
                html5QrCode.stop().then(() => {
                    console.log("Escáner detenido correctamente.");
                    // Cerrar el toast después de escanear
                    Swal.close();
                }).catch((err) => {
                    console.error("Error al detener el escáner:", err);
                    Swal.close();
                });
            };

            const config = { fps: 10, qrbox: { width: 250, height: 250 } };

            // Iniciar el escáner
            html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback)
                .catch((err) => {
                    console.error("Error al iniciar el escáner:", err);
                    Swal.fire('Error', 'No se pudo iniciar el escáner.', 'error');
                });
        },
        willClose: () => {
            // Detener el escáner al cerrar el toast (por si el usuario cierra manualmente)
            if (html5QrCode && html5QrCode.isScanning) {
                html5QrCode.stop()
                    .then(() => {
                        console.log("Escáner detenido correctamente.");
                    })
                    .catch((err) => {
                        console.error("Error al detener el escáner:", err);
                    });
            }
        }
    });
});
