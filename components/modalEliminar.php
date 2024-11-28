<!-- modal.php -->
<div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
        <button id="cerrarModal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="flex items-center">
            <div class="bg-red-100 p-2 rounded-full">
                <svg class="w-8 h-8 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 11-12.728 12.728 9 9 0 0112.728-12.728z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01" />
                </svg>
            </div>
            <h2 class="text-lg font-medium ml-4"><?php echo htmlspecialchars($title); ?></h2>
        </div>

        <p class="text-gray-600 mt-4"><?php echo htmlspecialchars($body); ?></p>

        <div class="flex justify-end mt-6 space-x-3">
            <button id="cerrarModal" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">Cancelar</button>
            <a href="#" id="eliminarConfirmado" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700"><?php echo htmlspecialchars($actionText); ?></a>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.abrirModal').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const pedidoId = this.dataset.id; // Obtiene el ID del Pedido
            const eliminarLink = document.getElementById('eliminarConfirmado');
            // Cambia la URL del enlace para incluir el id del pedido
            eliminarLink.setAttribute('href', `<?php echo $destino; ?>?id=${pedidoId}`);
            document.getElementById('modal').classList.remove('hidden');
        });
    });
</script>
