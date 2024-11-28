<?php
// Iniciar la sesión (si es necesario) o cargar cualquier archivo que sea necesario
session_start();

// Incluir la clase de la base de datos
require_once 'Database.php'; // Ajusta esta ruta según corresponda

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
            $pass = $usuario['pass'];
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
        echo "<script>alert 'Éxito'</script>";
        // Redirigir o mostrar un mensaje de éxito
        echo "<script>swal('Éxito', 'Usuario actualizado correctamente', 'success');</script>";
    }
} else {
    // Si no hay 'documento' en la URL, redirigir o mostrar un mensaje de error
    echo "No se especificó el documento del usuario.";
    
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Librería para alertas -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-6">
        <?php if (isset($usuario)): ?>
            <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Actualizar Usuario</h2>
                <form action="actualizar_usuario.php?documento=<?php echo $usuario[0]['documento']; ?>" method="POST">
                    <!-- Documento -->
                    <div class="mb-4">
                        <label for="documento" class="block text-sm font-medium text-gray-700">Documento</label>
                        <input type="text" id="documento" name="documento" value="<?php echo $usuario[0]['documento']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" readonly />
                    </div>

                    <!-- Nombres -->
                    <div class="mb-4">
                        <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres</label>
                        <input type="text" id="nombres" name="nombres" value="<?php echo $usuario[0]['nombres']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required />
                    </div>

                    <!-- Apellido -->
                    <div class="mb-4">
                        <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" id="apellido" name="apellido" value="<?php echo $usuario[0]['apellido']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $usuario[0]['email']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required />
                    </div>

                    <!-- Número de Contacto -->
                    <div class="mb-4">
                        <label for="num_contacto" class="block text-sm font-medium text-gray-700">Número de Contacto</label>
                        <input type="text" id="num_contacto" name="num_contacto" value="<?php echo $usuario[0]['num_contacto']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required />
                    </div>

                    <!-- Nombre de Usuario -->
                    <div class="mb-4">
                        <label for="nom_user" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                        <input type="text" id="nom_user" name="nom_user" value="<?php echo $usuario[0]['nom_user']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required />
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-4">
                        <label for="pass" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" id="pass" name="pass" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                        <small class="text-gray-500">Deja en blanco si no deseas cambiar la contraseña</small>
                    </div>

                    <!-- Rol -->
                    <div class="mb-4">
                        <label for="id_rol" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select id="id_rol" name="id_rol" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="1" <?php echo ($usuario[0]['id_rol'] == 1) ? 'selected' : ''; ?>>Administrador</option>
                            <option value="2" <?php echo ($usuario[0]['id_rol'] == 2) ? 'selected' : ''; ?>>Usuario</option>
                            <!-- Puedes agregar más roles aquí -->
                        </select>
                    </div>

                    <!-- Fecha de Nacimiento -->
                    <div class="mb-4">
                        <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $usuario[0]['fecha_nacimiento']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required />
                    </div>

                    <!-- Botón para Actualizar -->
                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none">Actualizar Usuario</button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <p class="text-red-500">Usuario no encontrado.</p>
        <?php endif; ?>
    </div>

</body>
</html>
