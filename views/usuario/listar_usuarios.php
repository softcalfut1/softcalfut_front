<?php
require_once 'Database.php';
//navbar
$menuItems = [
    ['name' => 'Inicio', 'url' => 'index.php', 'faIcon' => 'fa-home', 'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2 2 5-5 5 5 5-5 2 2-7 7-2-2-3 3-3-3-2 2-7-7z"/></svg>'],
    [
        'name' => 'LFC',
        'url' => '#',
        'faIcon' => 'fa-users',
        'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2L9.1 8H4l5.3 3.9-2 6L12 15l4.7 2.9-2-6L20 8h-5.1L12 2z"/></svg>',
        'subMenu' => [
            ['name' => 'Historia', 'url' => 'historia.php', 'faIcon' => 'fa-history', 'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m9-9H3"/></svg>'],
            ['name' => 'Comité Ejecutivo', 'url' => 'comite.php', 'faIcon' => 'fa-users-cog', 'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 3-3 3m0-6l3 3 3-3M3 12h18m-9 0v6m0-12v6m9 6l3-3-3-3m0 6l-3-3"/></svg>'],
            ['name' => 'Misión y Visión', 'url' => 'mision.php', 'faIcon' => 'fa-eye', 'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v20m9-9H3"/></svg>'],
        ]
    ],
    ['name' => 'Torneos', 'url' => '#', 'faIcon' => 'fa-trophy', 'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v20m9-9H3"/></svg>'],
    ['name' => 'Escuela LFC', 'url' => 'escuela.php', 'faIcon' => 'fa-school', 'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2 2 5-5 5 5 5-5 2 2-7 7-2-2-3 3-3-3-2 2-7-7z"/></svg>'],
    ['name' => 'Mi Club', 'url' => 'views/mi-club.php', 'faIcon' => 'fa-user', 'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2 2 5-5 5 5 5-5 2 2-7 7-2-2-3 3-3-3-2 2-7-7z"/></svg>']
];

// Crear una instancia de la clase Database
$db = new Database();

// Leer los usuarios
$usuarios = $db->leer('usuario');
$titleHead = "Actualizar Usuario";

// Incluir el encabezado
include('../../components/head.php');
?>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-10">
        <!-- Menú de navegación -->
        <?php include '../../components/nav.php'; ?>
        
        <!-- Contenedor de las tarjetas de los usuarios -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            // Suponiendo que $usuarios es un array de los usuarios
            foreach ($usuarios as $usuario) {
                echo "<div class='bg-white p-6 rounded-lg shadow-lg'>";
                echo "<div class='text-center mb-4'>";
                echo "<p class='font-semibold text-xl'>{$usuario['nombres']} {$usuario['apellido']}</p>";
                echo "<p class='text-sm text-gray-500'>{$usuario['documento']}</p>";
                echo "<p class='text-sm text-gray-500'>{$usuario['email']}</p>";
                echo "</div>";
                
                echo "<div class='text-center mt-4'>";
                echo "<a href='actualizar_usuario_form.php?documento={$usuario['documento']}' class='inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700'>Editar</a>";
                echo "<a href='eliminar_usuario.php?documento={$usuario['documento']}' class='inline-block bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 ml-4'>Eliminar</a>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

</body>
</html>
