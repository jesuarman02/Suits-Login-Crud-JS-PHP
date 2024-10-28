const cerrar_sesion = () => {
    Swal.fire({ 
        icon: "success", 
        title: 'Sesión cerrada con éxito', 
        timer: 1000, 
        showConfirmButton: false 
    }).then(() => {
        window.location.href = "app/controller/cerrar_sesion.php"; 
    });
}

document.getElementById('btn-cerrar').addEventListener('click', () => {
    cerrar_sesion();
});
