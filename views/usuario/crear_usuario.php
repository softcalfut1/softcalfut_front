<?php
require_once '../../controller/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los valores del formulario
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellido = $_POST['apellido'];
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $num_contacto = isset($_POST['num_contacto']) ? $_POST['num_contacto'] : null;
    $nom_user = isset($_POST['nom_user']) ? $_POST['nom_user'] : null;
    $pass = isset($_POST['pass']) ? password_hash($_POST['pass'], PASSWORD_BCRYPT) : null;  // Encriptar la contraseña
    $id_rol = isset($_POST['id_rol']) ? $_POST['id_rol'] : null;
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : null;

    // Crear un array dinámico para los datos a insertar
    $datos = [
        'documento' => $documento,  // Documento obligatorio
        'nombres' => $nombres,      // Nombres obligatorios
        'apellido' => $apellido,    // Apellido obligatorio
    ];

    // Incluir solo los campos que no sean vacíos o nulos
    if (!empty($email)) {
        $datos['email'] = $email;
    }
    if (!empty($num_contacto)) {
        $datos['num_contacto'] = $num_contacto;
    }
    if (!empty($nom_user)) {
        $datos['nom_user'] = $nom_user;
    }
    if (!empty($pass)) {
        $datos['pass'] = $pass;
    }
    if (!empty($id_rol)) {
        $datos['id_rol'] = $id_rol;
    }
    if (!empty($fecha_nacimiento)) {
        $datos['fecha_nacimiento'] = $fecha_nacimiento;
    }
    
    // Asignar el estado por defecto como 1
    $datos['estado'] = 1;

    // Crear una instancia de la clase Database
    $db = new Database();

    // Insertar los datos en la base de datos
    $db->insertar('usuario', $datos);
    
    // Redirigir a la lista de usuarios después de la inserción
    header('Location: listar_usuarios.php');
    exit(); // Para asegurarnos de que no se ejecute código después de la redirección
}
?>
