const cerrar_sesion = () => {
    fetch("app/controller/cerrar_sesion.php")
    .then(respuesta => respuesta.json())
    .then(async (respuesta) => {
        if (respuesta.success) {
            await Swal.fire({ icon: "success", title: 'Sesión Finalizada' });
            window.location.href = "http://localhost/suits/unidad2/proyecto/login.php"; // Ruta absoluta
        } else {
            await Swal.fire({ icon: "error", title: 'Error al cerrar sesión' });
        }
    })
    .catch((error) => {
        console.error("Error al cerrar sesión:", error);
        Swal.fire({ icon: "error", title: 'Error en la conexión al cerrar sesión' });
    });
}

document.getElementById('btn-cerrar').addEventListener('click', () => {
    cerrar_sesion();
});
