const cerrar_sesion = () => {
    Swal.fire({ 
        icon: "success", 
        title: 'Sesión cerrada con éxito', 
        timer: 1000, 
        showConfirmButton: false 
    }).then(() => {
        window.location.href = "cerrar_sesion"; 
    });
}

document.getElementById('btn-cerrar').addEventListener('click', () => {
    cerrar_sesion();
});
