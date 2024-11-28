<?php
require_once 'Database.php';

// Crear una instancia de la clase Database
$db = new Database();

// Leer los usuarios
$usuarios = $db->leer('usuario');

?>
<!-- listar_usuarios.html -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-10">
        <h2 class="text-2xl font-semibold mb-6 text-center">Usuarios Registrados</h2>

        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-blue-600 text-white">Documento</th>
                    <th class="px-4 py-2 bg-blue-600 text-white">Nombre</th>
                    <th class="px-4 py-2 bg-blue-600 text-white">Email</th>
                    <th class="px-4 py-2 bg-blue-600 text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Suponiendo que $usuarios es un array de los usuarios
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td class='border px-4 py-2'>" . $usuario['documento'] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $usuario['nombres'] . " " . $usuario['apellido'] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $usuario['email'] . "</td>";
                    echo "<td class='border px-4 py-2'>
                            <a href='actualizar_usuario_form.php?documento={$usuario['documento']}' class='text-blue-600 hover:text-blue-800'>Editar</a> |
                            <a href='eliminar_usuario.php?documento={$usuario['documento']}' class='text-red-600 hover:text-red-800'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
