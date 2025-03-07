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
    document.getElementById('hora_salida').value = formatearHora(fechaActual);
    document.getElementById('fecha_salida').value = formatearFecha(fechaActual);
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
                // Dividir el texto escaneado por la primera coma
                const [idUnidad, ...resto] = decodedText.split(',');
            
                // Mostrar solo la parte después de la primera coma en el input
                const textoMostrar = resto.join(',').trim(); // "PLaca: LFK445, Unidad:Unidad 4"
                document.getElementById('unidad_id').value = textoMostrar;
            
                // Guardar el ID en un campo oculto para usarlo en la inserción
                document.getElementById('unidad_id_hidden').value = idUnidad;
            
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


