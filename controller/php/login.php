<?php
session_start();
require_once '../Database.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si los datos 'username' y 'password' han sido enviados
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Recibir los datos del formulario
        $user = $_POST['username'];
        $password = $_POST['password'];

        // Validar si los campos no están vacíos
        if (empty($user) || empty($password)) {
            echo "<script>alert('Por favor, completa todos los campos.');</script>";
            exit;
        }

        // Conectar a la base de datos
        $db = new Database();
        $result = $db->leer('usuario', "WHERE nom_user = '$user'");

        if ($result) {
            // El usuario existe, verificar la contraseña
            $hashed_password = $result[0]['password']; // Suponiendo que el campo se llama 'password'
            if (password_verify($password, $hashed_password)) {
                // Contraseña correcta, iniciar sesión
                $_SESSION['user'] = $result[0];  
                echo "<script>alert('Inicio de sesión exitoso'); window.location.href = '../index.php';</script>";
                exit;
            } else {
                // Contraseña incorrecta
                echo "<script>alert('Contraseña incorrecta');</script>";
            }
        } else {
            // El usuario no existe
            echo "<script>alert('El usuario no está registrado');</script>";
        }
    } else {
        echo "<script>alert('Faltan datos del formulario');</script>";
    }
}
?>
