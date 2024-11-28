<?php
// Formulario.php

class Formulario {
    public static function generarFormulario($action, $data, $formId, $isEditMode) {
        $html = '<form id="' . htmlspecialchars($formId) . '" action="' . htmlspecialchars($action) . '" method="POST" class="bg-[#393E46] pb-6 pr-6 pl-6 rounded shadow">';

        foreach ($data as $input) {
            $html .= '<div class="mb-4">';
            if (isset($input['label'])) {
                $html .= '<label for="' . htmlspecialchars($input['name']) . '" class="block font-bold truncate text-[#00ADB5]">' . htmlspecialchars($input['label']) . ':</label>';
            }

            if ($input['type'] === 'select') {
                $html .= '<select id="' . htmlspecialchars($input['name']) . '" name="' . htmlspecialchars($input['name']) . '" class="border p-2 w-full"';
                if (isset($input['required']) && $input['required']) {
                    $html .= ' required';
                }
                $html .= '>';
                
                foreach ($input['options'] as $option) {
                    $selected = (isset($input['value']) && $option['value'] === $input['value']) ? 'selected' : '';
                    $html .= '<option value="' . htmlspecialchars($option['value']) . '" ' . $selected . '>' . htmlspecialchars($option['text']) . '</option>';
                }

                $html .= '</select>';
            } else {
                $html .= '<input type="' . htmlspecialchars($input['type']) . '" id="' . htmlspecialchars($input['name']) . '" name="' . htmlspecialchars($input['name']) . '" class="border p-2 w-full" value="' . htmlspecialchars($input['value'] ?? '') . '"';
                
                if (isset($input['required']) && $input['required']) {
                    $html .= ' required';
                }
                $html .= ' />';
            }
            $html .= '</div>';
        }
        $html .= '<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-[#00ADB5] hover:text-[#222831]">' . ($isEditMode ? 'Actualizar' : 'Crear') . '</button>';
        $html .= '</form>';

        return $html;
    }
}
?>
