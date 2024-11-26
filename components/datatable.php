
<div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
    <div class="flex items-center justify-between p-4">

        <?php
            include 'components/searchable_table.php';
        ?>
        <a class="bg-blue-500 text-white rounded-full m-1 flex items-center justify-center h-8 w-8" title="Añadir" href="<?php echo escapeHtml($destino[1]); ?>.php">
            <svg class="h-6 w-6 text-white" fill="white" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>

    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 mx-auto justify-center text-center">
                <tr>
                    <?php foreach ($headers as $header): ?>
                        <th class="px-4 py-3"><?php echo escapeHtml($header); ?></th>
                    <?php endforeach; ?>
                    <th class="px-4 py-3"><span class="sr-only">Acciones</span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr class="border-b dark:border-gray-700">
                        <?php foreach ($cliente as $data): ?>
                            <td class="px-4 py-3 border"><?php echo escapeHtml($data); ?></td>
                        <?php endforeach; ?>
                        <td class="px-4 py-3 border flex items-center justify-end gap-3">
                            <a href="<?php echo escapeHtml($destino[0]); ?>.php?id=<?php echo escapeHtml($cliente[0]); ?>" class="text-yellow-500 hover:text-yellow-600 flex items-center" title="Editar">
                                <svg class="h-6 w-6 inline-block" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="yellow" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                </svg>
                            </a>
                            <a href="#" title="Eliminar" class="abrirModal text-red-500 hover:underline ml-2 flex items-center" data-id="<?php echo escapeHtml($cliente[0]); ?>">
                                <svg class="h-6 w-6 text-red-500" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    <line x1="10" y1="11" x2="10" y2="17" stroke="#d95561" stroke-width="2" />
                                    <line x1="14" y1="11" x2="14" y2="17" stroke="#d95561" stroke-width="2" />
                                    <polyline points="3 6 5 6 21 6" />
                                </svg>
                            </a>
                        </td>


                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>