<?php
// Iniciar la sesión (si es necesario) o cargar cualquier archivo que sea necesario
session_start();

// Incluir la clase de la base de datos
require_once 'Database.php'; // Ajusta esta ruta según corresponda

// Incluir el formulario
include '../../components/formulario.php';

// Instanciar la base de datos
$db = new Database();

// Verificar si el parámetro 'documento' está presente en la URL
if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];
    
    // Obtener los datos del usuario desde la base de datos
    $usuario = $db->leer('usuario', "WHERE documento = '$documento'");

    // Si el usuario no existe, redirigir o mostrar un mensaje de error
    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit;
    }
    
    // Si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recoger los datos del formulario
        $nombres = $_POST['nombres'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $num_contacto = $_POST['num_contacto'];
        $nom_user = $_POST['nom_user'];
        $pass = $_POST['pass']; // Si la contraseña está vacía, no se actualiza
        $id_rol = $_POST['id_rol'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];

        // Si la contraseña no está vacía, hashearla (si es necesario)
        if (!empty($pass)) {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
        } else {
            // Si la contraseña está vacía, mantener la actual
            $pass = $usuario[0]['pass'];
        }

        // Datos para actualizar el usuario
        $datos = [
            'nombres' => $nombres,
            'apellido' => $apellido,
            'email' => $email,
            'num_contacto' => $num_contacto,
            'nom_user' => $nom_user,
            'pass' => $pass,
            'id_rol' => $id_rol,
            'fecha_nacimiento' => $fecha_nacimiento
        ];

        // Actualizar el usuario en la base de datos
        $db->actualizar('usuario', $datos, "documento = '$documento'");
        echo "<script>swal('Éxito', 'Usuario actualizado correctamente', 'success');</script>";
    }
} else {
    // Si no hay 'documento' en la URL, redirigir o mostrar un mensaje de error
    echo "No se especificó el documento del usuario.";
    exit;
}

// Datos del formulario para actualizar (con los valores predefinidos)
$data = [
    ['type' => 'hidden', 'name' => 'documento', 'value' => $usuario[0]['documento']],
    ['type' => 'text', 'name' => 'nombres', 'label' => 'Nombres', 'value' => $usuario[0]['nombres'], 'required' => true],
    ['type' => 'text', 'name' => 'apellido', 'label' => 'Apellidos', 'value' => $usuario[0]['apellido'], 'required' => true],
    ['type' => 'email', 'name' => 'email', 'label' => 'Email', 'value' => $usuario[0]['email'], 'required' => false],
    ['type' => 'text', 'name' => 'num_contacto', 'label' => 'Número de Contacto', 'value' => $usuario[0]['num_contacto'], 'required' => false],
    ['type' => 'text', 'name' => 'nom_user', 'label' => 'Nombre de Usuario', 'value' => $usuario[0]['nom_user'], 'required' => true],
    ['type' => 'password', 'name' => 'pass', 'label' => 'Contraseña', 'value' => '', 'required' => false], // Deja en blanco para no sobrescribir la contraseña si no se desea cambiar
    ['type' => 'number', 'name' => 'id_rol', 'label' => 'Rol', 'value' => $usuario[0]['id_rol'], 'required' => true],
    ['type' => 'date', 'name' => 'fecha_nacimiento', 'label' => 'Fecha de Nacimiento', 'value' => $usuario[0]['fecha_nacimiento'], 'required' => true]
];

$titleHead = "Actualizar Usuario";

// Incluir el encabezado
include('../../components/head.php');
?>

<body class="bg-gray-100">

    <div class="flex-1">
        <!-- Menú de navegación -->
        <?php include '../../components/nav.php'; ?>

        <div class="flex">
            <div class="w-full px-4 lg:px-12">
                <div class="flex">
                    <div class="w-full mx-auto max-w-[600px]">
                        <?php
                        $title = "Actualizar Usuario";
                        include '../../components/header.php';
                        ?>
                        <?php
                        $isEditMode = true; 
                        echo Formulario::generarFormulario('actualizar_usuario.php?documento=' . $usuario[0]['documento'], $data, 'formulario-actualizar', $isEditMode);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
