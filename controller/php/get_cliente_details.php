<?php
include 'funciones.php'; // Incluir las funciones necesarias

// Verificar que se haya recibido un ID
if (isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    // Leer el archivo de Clientes
    $cliente = readClientes('../bd/clientes.csv'); // Asegúrate de que esta función esté definida

    // Buscar la Cliente por su ID
    foreach ($cliente as $cliente) {
        if ($cliente[0] === $clienteId) {
            // Preparar los datos de la Cliente en formato JSON
            $clienteDetails = [
                'title' => $cliente[2],        // Título de la Cliente
                'description' => $cliente[3]   // Descripción de la Cliente
            ];

            // Devolver los detalles en formato JSON
            header('Content-Type: application/json');
            echo json_encode($clienteDetails);
            exit; // Terminar la ejecución del script
        }
    }

    // Si no se encontró la Cliente, devolver un JSON vacío
    header('Content-Type: application/json');
    echo json_encode(null);
} else {
    // Si no se recibió un ID, devolver un error
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'No se ha proporcionado un ID de Cliente.']);
}
?>
