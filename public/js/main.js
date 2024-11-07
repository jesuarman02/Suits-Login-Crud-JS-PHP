const validar_usuario = (event) => {
  event.preventDefault();

  let email = document.getElementById("email-id").value;
  let pass = document.getElementById("pass-id").value;

  if (email === "" || pass === "") {
    Swal.fire({
      icon: "error",
      title: "Por favor completa todos los campos.",
      timer: 1000,
      showConfirmButton: false,
    });
    return;
  }

  let data = new FormData();
  data.append("email", email);
  data.append("pass", pass);
  data.append("metodo", "login_datos");

  fetch("app/controller/obtener_datos_usuario.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.json())
    .then(async (respuesta) => {
      if (respuesta[0] === 1) {
        await Swal.fire({
          icon: "success",
          title: `${respuesta[1]}`,
          timer: 1000,
          showConfirmButton: false,
        });
        window.location = "inicio";
      } else {
        Swal.fire({
          icon: "error",
          title: `${respuesta[1]}`,
          timer: 1000,
          showConfirmButton: false,
        });
      }
    })
    .catch((error) => {
      Swal.fire({
        icon: "error",
        title: "Error en la conexión.",
        timer: 1000,
        showConfirmButton: false,
      });
    });
};

const registrar_usuario = (event) => {
  event.preventDefault();

  let nombre = document.getElementById("nombre").value.trim();
  let apellido = document.getElementById("apellido").value.trim();
  let email = document.getElementById("email").value.trim();
  let pass = document.getElementById("pass").value;

  // Validaciones
  const soloLetras = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/;
  const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

  if (nombre === "" || apellido === "" || email === "" || pass === "") {
    Swal.fire({
      icon: "error",
      title: "Todos los campos son obligatorios.",
      timer: 1000,
      showConfirmButton: false,
    });
    return;
  }

  if (!soloLetras.test(nombre) || !soloLetras.test(apellido)) {
    Swal.fire({
      icon: "error",
      title: "Nombre y apellido solo deben contener letras",
      timer: 1000,
      showConfirmButton: false,
    });
    return;
  }

  if (!emailRegex.test(email)) {
    Swal.fire({
      icon: "error",
      title: "El formato del email no es válido",
      timer: 1000,
      showConfirmButton: false,
    });
    return;
  }

  let data = new FormData();
  data.append("nombre", nombre);
  data.append("apellido", apellido);
  data.append("email", email);
  data.append("pass", pass);
  data.append("metodo", "registro_datos");

  fetch("app/controller/obtener_datos_usuario.php", {
   method: "POST",
body: data,
  })
    .then((response) => response.json())
    .then(async (respuesta) => {
      if (respuesta[0] === 1) {
        await Swal.fire({
          icon: "success",
          title: `${respuesta[1]}`,
          timer: 1000,
          showConfirmButton: false,
        });
        window.location = "login";
      } else {
        Swal.fire({
          icon: "error",
          title: `${respuesta[1]}`,
          timer: 1000,
          showConfirmButton: false,
        });
      }
    })
    .catch((error) => {
      Swal.fire({
        icon: "error",
        title: "Error en la conexión.",
        timer: 1000,
        showConfirmButton: false,
      });
    });
};

const actualizar_usuario = async (event) => {
  event.preventDefault();

  let nombre = document.getElementById("editNombre").value.trim();
  let apellido = document.getElementById("editApellido").value.trim();
  let email = document.getElementById("editEmail").value.trim();
  let password = document.getElementById("editPassword").value;

  // Validaciones
  const soloLetras = /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/;
  const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

  if (nombre === "" || apellido === "" || email === "") {
    Swal.fire({
      icon: "error",
      title: "Nombre, apellido y email son obligatorios.",
      timer: 1000,
      showConfirmButton: false,
    });
    return;
  }

  if (!soloLetras.test(nombre) || !soloLetras.test(apellido)) {
    Swal.fire({
      icon: "error",
      title: "Nombre y apellido solo deben contener letras",
      timer: 1000,
      showConfirmButton: false,
    });
    return;
  }

  if (!emailRegex.test(email)) {
    Swal.fire({
      icon: "error",
      title: "El formato del email no es válido",
      timer: 1000,
      showConfirmButton: false,
    });
    return;
  }

  let data = new FormData();
  data.append("nombre", nombre);
  data.append("apellido", apellido);
  data.append("email", email);
  data.append("metodo", "editar_datos");

  if (password) {
    data.append("pass", password);
  }

  try {
    const response = await fetch("app/controller/obtener_datos_usuario.php", {
      method: "POST",
      body: data,
    });
    const respuesta = await response.json();

    if (respuesta[0] === 1) {
      await Swal.fire({
        icon: "success",
        title: respuesta[1],
        timer: 1000,
        showConfirmButton: false,
      });

      // Preguntar si desea cerrar sesión
      const shouldLogout = await Swal.fire({
        title: "¿Deseas cerrar sesión?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No",
      });

      if (shouldLogout.isConfirmed) {
        window.location.href = "app/controller/cerrar_sesion.php";
      } else {
        // Cerrar el modal y actualizar la información visible
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("editarUsuarioModal")
        );
        modal.hide();
        // Actualizar el email mostrado en la página
        document.querySelector(".text-center.m-0").textContent = email;
      }
    } else {
      Swal.fire({
        icon: "error",
        title: respuesta[1],
        timer: 1000,
        showConfirmButton: false,
      });
    }
  } catch (error) {
    Swal.fire({
      icon: "error",
      title: "Error en la conexión",
      timer: 1000,
      showConfirmButton: false,
    });
  }
};

window.addEventListener("DOMContentLoaded", () => {
  const btnLogin = document.getElementById("btn-saludar");
  if (btnLogin) {
    btnLogin.addEventListener("click", validar_usuario);
  }

  const btnRegistrar = document.getElementById("btn-registrar");
  if (btnRegistrar) {
    btnRegistrar.addEventListener("click", registrar_usuario);
  }

  const btnactualizar = document.getElementById("guardarCambios");
  if (btnactualizar) {
    btnactualizar.addEventListener("click", actualizar_usuario);
  }

  // Cargar datos del usuario en el modal de edición
  const editarModal = document.getElementById("editarUsuarioModal");
  if (editarModal) {
      editarModal.addEventListener("show.bs.modal", async () => {
          try {
              let data = new FormData();
              data.append("metodo", "obtener_datos"); // Añade el método que quieres llamar

              const response = await fetch("app/controller/obtener_datos_usuario.php", {
                  method: "POST",
                  body: data
              });
              const datos = await response.json();

              if (datos && typeof datos === 'object' && !Array.isArray(datos)) {
                  document.getElementById("editNombre").value = datos.nombre;
                  document.getElementById("editApellido").value = datos.apellido;
                  document.getElementById("editEmail").value = datos.email;
                  document.getElementById("editPassword").value = ""; // La contraseña siempre vacía
              } else {
                  Swal.fire({
                      icon: "error",
                      title: "Error al cargar datos del usuario",
                      text: Array.isArray(datos) ? datos[1] : "Error desconocido",
                      timer: 1500,
                      showConfirmButton: false,
                  });
              }
          } catch (error) {
              console.error("Error:", error);
              Swal.fire({
                  icon: "error",
                  title: "Error al cargar datos del usuario",
                  text: "Error en la conexión",
                  timer: 1500,
                  showConfirmButton: false,
              });
          }
      });
  }
});