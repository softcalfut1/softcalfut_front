<?php
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
    ['name' => 'Mi Club', 'url' => 'mi-club.php', 'faIcon' => 'fa-user', 'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2 2 5-5 5 5 5-5 2 2-7 7-2-2-3 3-3-3-2 2-7-7z"/></svg>']
];

// Título de la página
$titleHead = "Mi Club";

// Incluir el encabezado
include('../components/head.php');
require_once '../controller/Database.php';  
$db = new Database();
$db->verificarConexion();
?>

<body class="bg-[#393E46] p-8 flex flex-col min-h-screen">
    <div class="flex-1">
        <?php include '../components/nav.php'; ?> 
        <div class="flex justify-center">
            <div class="w-full px-4 lg:px-12">
                <div class="flex justify-center">
                    <div class="w-full max-w-[600px]">

                        <?php 
                            $title = "Bienvenido a LFC"; 
                            include '../components/header.php'; 
                        ?>

                        <!-- Formulario de inicio de sesión -->
                        <form id="loginForm" class="space-y-6" action="../controller/php/login.php" method="POST" novalidate>
                            <!-- Campo de correo -->
                            <div>
                                <label for="username" class="text-white block mb-2">Usuario</label>
                                <input type="text" id="username" name="username" class="w-full px-4 py-2 rounded-md text-gray-800" placeholder="Introduce tu correo electrónico" required>
                            </div>

                            <!-- Campo de contraseña -->
                            <div class="relative">
                                <label for="password" class="text-white block mb-2">Contraseña</label>
                                <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-md text-gray-800" placeholder="Introduce tu contraseña" required minlength="8">
                                <!-- Botón para ver/ocultar contraseña -->
                                <button type="button" id="togglePassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2 2 5-5 5 5 5-5 2 2-7 7-2-2-3 3-3-3-2 2-7-7z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Botón de inicio de sesión -->
                            <div>
                                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Iniciar sesión
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php include '../components/footer.php'; ?> 
</html>
