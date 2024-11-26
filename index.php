<?php
include 'php/funciones.php';

$titleHead = "ensayo";

// Menú
$menuItems = [
    ['name' => 'Inicio', 'url' => 'index.php'],
    ['name' => 'Personas', 'url' => 'personas.php'],
    ['name' => 'Ciudades', 'url' => 'ciudades.php'],
    ['name' => 'Paises', 'url' => 'paises.php'],
    ['name' => 'Contacto', 'url' => 'contacto.php']
];

include('components/head.php');
?>
<body class="bg-[#393E46] p-8 flex flex-col min-h-screen">
    <div class="flex-1">
        <?php include 'components/nav.php'; ?>  
        <div class="flex">
            <div class="w-full px-4 lg:px-12">
                <div class="flex">
                    <div class="w-full mx-auto max-w-[600px]">
                        <?php $title = "tirilu header"; include 'components/header.php'; ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script src="app.js"></script>
</body>
</html>