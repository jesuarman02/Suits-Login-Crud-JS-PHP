<?php
session_start();
require_once '../config/conexion.php';
require_once("../config/dependencias.php");

class Usuario extends Conexion
{
    public function obtener_datos()
    {
        if (isset($_SESSION['usuario'])) {
            $usuario_id = $_SESSION['usuario']['id'];

            try {
                $consulta = $this->obtener_conexion()->prepare("SELECT nombre, apellido, email FROM t_usuarios WHERE id = :id");
                $consulta->bindParam(':id', $usuario_id);
                $consulta->execute();
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);

                if ($datos) {
                    header('Content-Type: application/json');
                    echo json_encode($datos);
                } else {
                    echo json_encode([0, "Error al obtener datos del usuario"]);
                }
            } catch (PDOException $e) {
                echo json_encode([0, "Error en la base de datos: " . $e->getMessage()]);
            }
        } else {
            echo json_encode([0, "Usuario no ha iniciado sesión"]);
        }
        exit;
    }

    public function login_datos()
    {
        if ($_POST) {
            if (!empty($_POST['email']) && !empty($_POST['pass'])) {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $passw = $_POST['pass'];

                $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_usuarios WHERE email = :email");
                $consulta->bindParam(':email', $email);
                $consulta->execute();
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);

                if (!$datos) {
                    echo json_encode([0, "No existe un usuario con ese correo"]);
                    exit;
                }
                if ($datos && password_verify($passw, $datos['pass'])) {
                    $_SESSION['usuario'] = $datos;
                    echo json_encode([1, "Datos de acceso correctos"]);
                } else {
                    echo json_encode([0, "Error en credenciales de acceso"]);
                }
            } else {
                echo json_encode([0, "Tienes que completar los datos"]);
            }
            exit;
        }
    }

    public function registro_datos()
    {
        $expresion = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if ($_POST) {
            if (!empty($_POST['nombre']) && !empty($_POST['apellido']) &&
                !empty($_POST['email']) && !empty($_POST['pass'])) {

                if (!preg_match($expresion, $_POST['email'])) {
                    echo json_encode([0, "No cumples con las especificaciones de un correo"]);
                } else {
                    $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_usuarios WHERE email = :email");
                    $consulta->bindParam(':email', $_POST['email']);
                    $consulta->execute();

                    if ($consulta->rowCount() > 0) {
                        echo json_encode([0, "El correo ya está en uso"]);
                    } else {
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
                        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

                        $consulta = $this->obtener_conexion()->prepare("INSERT INTO t_usuarios (nombre, apellido, email, pass) VALUES (:nombre, :apellido, :email, :pass)");
                        $consulta->bindParam(':nombre', $nombre);
                        $consulta->bindParam(':apellido', $apellido);
                        $consulta->bindParam(':email', $email);
                        $consulta->bindParam(':pass', $pass);

                        if ($consulta->execute()) {
                            echo json_encode([1, "Usuario registrado correctamente"]);
                        } else {
                            echo json_encode([0, "Error al registrar usuario"]);
                        }
                    }
                }
            } else {
                echo json_encode([0, "Todos los campos son obligatorios"]);
            }
            exit;
        }
    }

    public function editar_datos()
    {
        if ($_POST) {
            if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email'])) {
                $nombre = trim($_POST['nombre']);
                $apellido = trim($_POST['apellido']);
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                $usuario_id = $_SESSION['usuario']['id'];

                if (!preg_match("/^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/", $nombre) || 
                    !preg_match("/^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/", $apellido)) {
                    echo json_encode([0, "Nombre y apellido solo deben contener letras"]);
                    return;
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo json_encode([0, "Formato de email inválido"]);
                    return;
                }

                $verificar_email = $this->obtener_conexion()->prepare(
                    "SELECT id FROM t_usuarios WHERE email = ? AND id != ?"
                );
                $verificar_email->execute([$email, $usuario_id]);
                if ($verificar_email->rowCount() > 0) {
                    echo json_encode([0, "El email ya está en uso por otro usuario"]);
                    return;
                }

                if (!empty($_POST['pass'])) {
                    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
                } else {
                    $pass = $_SESSION['usuario']['pass'];
                }

                $consulta = $this->obtener_conexion()->prepare(
                    "UPDATE t_usuarios SET nombre = ?, apellido = ?, email = ?, pass = ? WHERE id = ?"
                );

                if ($consulta->execute([$nombre, $apellido, $email, $pass, $usuario_id])) {
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellido'] = $apellido;
                    $_SESSION['usuario']['email'] = $email;
                    $_SESSION['usuario']['pass'] = $pass;

                    echo json_encode([1, "Usuario actualizado correctamente"]);
                } else {
                    echo json_encode([0, "Error al actualizar usuario"]);
                }
            } else {
                echo json_encode([0, "Los campos nombre, apellido y email son obligatorios"]);
            }
        }
    }
}

$usuario = new Usuario();

if (isset($_POST['metodo'])) {
    switch ($_POST['metodo']) {
        case "obtener_datos":
            $usuario->obtener_datos();
            break;
        case "login_datos":
            $usuario->login_datos();
            break;
        case "registro_datos":
            $usuario->registro_datos();
            break;
        case "editar_datos":
            $usuario->editar_datos();
            break;
        default:
            echo json_encode([0, "Método no válido"]);
    }
} else {
    // Si no se especifica método, asumimos que es una solicitud de datos
    $usuario->obtener_datos();
}