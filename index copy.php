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
    ['name' => 'Mi Club', 'url' => 'views/mi-club.php', 'faIcon' => 'fa-user', 'svgIcon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2 2 5-5 5 5 5-5 2 2-7 7-2-2-3 3-3-3-2 2-7-7z"/></svg>']
];

// Título de la página
$titleHead = "Liga Caldense de Futbol";

// Incluir el encabezado
include('components/head.php');
?>

<body class="bg-[#393E46] p-8 flex flex-col min-h-screen">
    <div class="flex-1">
        <!-- Menú de navegación -->
        <?php include 'components/nav.php'; ?>  

        <div class="flex">
            <div class="w-full px-4 lg:px-12">
                <div class="flex">
                    <div class="w-full mx-auto max-w-[600px]">
                        <!-- Header dinámico -->
                        <?php 
                        $title = "Bienvenido a LFC"; 
                        include 'components/header.php'; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'components/footer.php'; ?> 
</html>
