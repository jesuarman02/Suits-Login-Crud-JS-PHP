<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<style>
    /* Estilos del menú de navegación */
    nav {
        background-color: #4c6a92; /* Azul oscuro */
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        color: #f5f5f5;
    }

    /* Contenedor centrado de texto */
    .text-center {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .text-center h3 {
        margin: 0;
        color: #f5f5f5; /* Blanco para texto */
        font-size: 1.8rem;
        font-weight: bold;
    }

    .text-center p {
        margin: 0;
        color: #d1d1d1; /* Gris claro para subtítulo */
        font-size: 1rem;
    }

    /* Estilos de los botones en el contenedor */
    .button-container {
        display: flex;
        gap: 0.7rem;
    }

    .button-container button {
        padding: 0.5rem 1.2rem;
        background-color: #709bb0; /* Azul medio */
        color: #f5f5f5;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .button-container button:hover {
        background-color: #91b3c7; /* Azul más claro al pasar el mouse */
        transform: scale(1.05);
    }
    /* Estilos para el modal */
.modal-content {
    background-color: #2f4f6f; /* Fondo azul oscuro */
    color: #f5f5f5; /* Texto blanco */
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.modal-header {
    border-bottom: 1px solid #91b3c7; /* Línea de división clara */
}

.modal-header .modal-title {
    font-size: 1.5rem;
    color: #d1d1d1;
}

.modal-body {
    background-color: #3a5a7a; /* Azul intermedio para cuerpo */
    padding: 1rem;
    border-radius: 8px;
}

.modal-body .form-label {
    color: #b3c9d6; /* Color claro para etiquetas */
    font-weight: bold;
}

.modal-body .form-control {
    background-color: #f5f5f5;
    color: #333;
    border: 1px solid #709bb0; /* Borde azul */
    border-radius: 5px;
}

.modal-footer {
    border-top: 1px solid #91b3c7; /* Línea de división clara */
    background-color: #2f4f6f; /* Fondo de pie de modal */
}

.modal-footer .btn-secondary {
    background-color: #709bb0; /* Azul medio */
    color: #f5f5f5;
    border: none;
    transition: background-color 0.3s ease;
}

.modal-footer .btn-secondary:hover {
    background-color: #91b3c7; /* Azul más claro */
}

.modal-footer .btn-success {
    background-color: #3cba92; /* Verde suave */
    color: #fff;
    border: none;
    transition: background-color 0.3s ease;
}

.modal-footer .btn-success:hover {
    background-color: #34a882; /* Verde más oscuro */
}

</style>


<nav>
    <button class="btn btn-info me-2" id="btn-inicio" onclick="window.location.href='inicio'">
        Inicio
    </button>
    <div class="text-center">
        <h3 class="m-0">Bienvenido</h3>
    </div>
    <div>
        <?php if (isset($_SESSION['usuario'])): ?>
            <p><?= $_SESSION['usuario']['nombre'] ?></p>
        <?php endif; ?>
    </div>
    <?php if (!isset($_SESSION['usuario'])): ?>
        <button class="btn btn-info me-2" id="btn-login" onclick="window.location.href='login'">
            Login
        </button>
    <?php endif; ?>
    <div class="button-container">
        
        <?php if (isset($_SESSION['usuario'])): ?>
            <button class="btn btn-info me-2" id="btn-inventario" onclick="window.location.href='inventario'">
                Inventario
            </button>
            <button class="btn btn-secondary me-2" id="btn-edita " data-bs-toggle="modal" data-bs-target="#editarUsuarioModal">
                Editar Sesión
            </button>
            <button class="btn btn-danger" id="btn-cerrar">
                Cerrar sesión
            </button>
        <?php endif; ?>
    </div>
</nav>
<br><br>

<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editNombre" placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <label for="editApellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="editApellido" placeholder="Apellido">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="editPassword" placeholder="Contraseña Actual" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="guardarCambios">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>