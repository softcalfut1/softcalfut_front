<?php
session_start();

require_once '../../controller/Database.php';

// Verificamos si los datos fueron enviados por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $documento = $_POST['documento'];
    $pass = $_POST['pass'];

    // Instanciamos la clase de la base de datos
    $db = new Database();

    // Validamos el usuario
    $usuario = $db->validarUsuario($documento, $pass);
    if ($usuario) {
        // Usuario encontrado, creamos las variables de sesión
        $_SESSION['nombre'] = $usuario['nombres'] . ' ' . $usuario['apellido'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['documento'] = $usuario['documento'];
        $_SESSION['rol'] = $usuario['rol_nombre'];
        $_SESSION['rol_descripcion'] = $usuario['rol_descripcion'];

        // Obtenemos los permisos del usuario a través de su rol
        $permisos = $db->obtenerPermisos($usuario['id_rol']);
        $_SESSION['permisos'] = $permisos;

        // Redirigimos al usuario a la página de inicio
        $_SESSION['success'] = "Bienvenido " . $_SESSION['nombre'];
        echo $_SESSION['success'];
        header('Location: ../../index.php');
        exit();
    } else {
        // Si no se encuentra al usuario o la contraseña es incorrecta
        $_SESSION['error'] = "Documento o contraseña incorrectos.";
        echo $_SESSION['error'];
        header('Location: login.php');
        exit();
    }
} else {
    // Si no se ha enviado el formulario
    header('Location: login.php');
    exit();
}
?>
