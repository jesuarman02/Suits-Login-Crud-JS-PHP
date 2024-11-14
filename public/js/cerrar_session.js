const cerrar_sesion = () => {
    fetch('./app/controller/cerrar_sesion.php')
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        if(respuesta[0] == 1){
            Swal.fire({ 
                icon: "success", 
                title: respuesta[1], 
                timer: 1000, 
                showConfirmButton: false 
            }).then(() => {
                window.location = "login"; 
            });
        }else{
            Swal.fire({ 
                icon: "error", 
                title: 'Error al cerrar sesion!', 
            });
        }
    });
}

document.getElementById('btn-cerrar').addEventListener('click', () => {
    cerrar_sesion();
});
