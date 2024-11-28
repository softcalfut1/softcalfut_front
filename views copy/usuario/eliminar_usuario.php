<?php
require_once 'Database.php';

// Verificar si se pasa el 'documento' por URL para eliminar el usuario
if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];

    // Crear una instancia de la clase Database
    $db = new Database();

    // Eliminar el usuario
    $db->eliminar('usuario', "documento = '$documento'");

    // Redirigir al listado de usuarios o a una página de éxito
    header('Location: listar_usuarios.php');
    exit;
} else {
    // Si no se pasa el 'documento', redirigir al listado de usuarios
    header('Location: listar_usuarios.php');
    exit;
}
?>
