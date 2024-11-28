<?php
require_once 'Database.php';

// Verificar si se ha pasado el 'documento' en la URL para cargar los datos del usuario
if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];

    // Crear una instancia de la clase Database
    $db = new Database();

    // Leer los datos del usuario con el 'documento'
    $usuario = $db->leer('usuario', "WHERE documento = '$documento'");

    // Si se encuentra el usuario, asignar los valores
    if ($usuario) {
        $usuario = $usuario[0];  // Obtener el primer (y único) resultado, ya que el documento es único
    } else {
        // Si no se encuentra el usuario, redirigir al listado de usuarios o mostrar un mensaje de error
        echo "<script>alert('Usuario no encontrado');</script>";
        //header('Location: listar_usuarios.php');
        exit;
    }
}

// Si se ha enviado el formulario con el método POST, se actualizan los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $documento = $_GET['documento'];  // Obtener el documento desde la URL
    
    // Inicializar un array vacío para almacenar los datos a actualizar
    $datos = [];

    // Recoger los datos del formulario, solo si han sido enviados y no están vacíos
    if (!empty($_POST['nombres'])) {
        $datos['nombres'] = $_POST['nombres'];
    }
    if (!empty($_POST['apellido'])) {
        $datos['apellido'] = $_POST['apellido'];
    }
    if (!empty($_POST['email'])) {
        $datos['email'] = $_POST['email'];
    }
    if (!empty($_POST['num_contacto'])) {
        $datos['num_contacto'] = $_POST['num_contacto'];
    }
    if (!empty($_POST['nom_user'])) {
        $datos['nom_user'] = $_POST['nom_user'];
    }
    if (!empty($_POST['id_rol'])) {
        $datos['id_rol'] = $_POST['id_rol'];
    }
    if (!empty($_POST['fecha_nacimiento'])) {
        $datos['fecha_nacimiento'] = $_POST['fecha_nacimiento'];
    }

    // Si la contraseña se ha cambiado, actualizarla
    if (!empty($_POST['pass'])) {
        $datos['pass'] = password_hash($_POST['pass'], PASSWORD_BCRYPT);  // Encriptar la contraseña
    }

    // Verificar si hay datos para actualizar
    if (count($datos) > 0) {
        // Crear una instancia de la clase Database
        $db = new Database();

        // Actualizar el usuario en la base de datos
        $db->actualizar('usuario', $datos, "documento = '$documento'");

        // Redirigir a la lista de usuarios o a una página de éxito
        echo "<script>alert('Usuario actualizado correctamente');</script>";
        header('Location: listar_usuarios.php');
        exit;
    } else {
        // Si no se envían datos para actualizar, redirigir o mostrar un mensaje
        echo "<script>alert('No se han realizado cambios');</script>";
        header('Location: listar_usuarios.php');
        exit;
    }
}
?>
