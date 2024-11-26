<?php

function escapeHtml($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function readClientes($filename) {
    $clientes = [];
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            $clientes[] = $data;
        }
        fclose($handle);
    }
    return $clientes;
}

function writeClientes($filename, $clientes) {
    $file = fopen($filename, 'w'); // Abre el archivo en modo escritura
    if ($file) {
        foreach ($clientes as $cliente) {
            fputcsv($file, $cliente); // Escribe cada Cliente como una línea en el CSV
        }
        fclose($file); // Cierra el archivo
    } else {
        throw new Exception("No se pudo abrir el archivo para escribir."); // Manejo de errores si el archivo no se puede abrir
    }
}

function getCategoryDetails($id, $filename) {
    $clientes = readClientes($filename);
    foreach ($clientes as $cliente) {
        if ($cliente[0] == $id) {
            return [
                'title' => escapeHtml($cliente[1]),
                'description' => escapeHtml($cliente[2])
            ];
        }
    }
    return null; 
}

function generarFormulario($action, $data, $formId, $isEditMode) {
    echo '<form id="' . htmlspecialchars($formId) . '" action="' . htmlspecialchars($action) . '" method="POST" class="bg-[#393E46] pb-6 pr-6 pl-6 rounded shadow">';

    foreach ($data as $input) {
        echo '<div class="mb-4">';

        if (isset($input['label'])) {
            echo '<label for="' . htmlspecialchars($input['name']) . '" class="block font-bold truncate text-[#00ADB5]">' . htmlspecialchars($input['label']) . ':</label>';
        }

        if ($input['type'] === 'select') {
            echo '<select id="' . htmlspecialchars($input['name']) . '" name="' . htmlspecialchars($input['name']) . '" class="border p-2 w-full" required>';
            foreach ($input['options'] as $option) {
                $selected = (isset($input['value']) && $option['value'] === $input['value']) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($option['value']) . '" ' . $selected . '>' . htmlspecialchars($option['text']) . '</option>';
            }
            echo '</select>';
        } else {
            echo '<input type="' . htmlspecialchars($input['type']) . '" id="' . htmlspecialchars($input['name']) . '" name="' . htmlspecialchars($input['name']) . '" class="border p-2 w-full" value="' . htmlspecialchars($input['value'] ?? '') . '" required />';
        }

        echo '</div>';
    }

    echo '<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-[#00ADB5] hover:text-[#222831]">' . ($isEditMode ? 'Actualizar' : 'Crear') . '</button>';

    echo '</form>';
}

?>
