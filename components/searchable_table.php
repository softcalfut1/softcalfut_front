<?php
// Establecer las etiquetas a buscar desde parámetros
$searchTargets = isset($searchTargets) ? $searchTargets : 'tbody tr';
$searchClass = isset($searchClass) ? $searchClass : 'input[type="text"]';
?>

<div class="relative w-full">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
    </div>
    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2" placeholder="Buscar" required>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('<?= $searchClass ?>');
        const searchTargets = document.querySelectorAll('<?= $searchTargets ?>');

        // Solo agregar el evento si hay elementos a buscar
        if (searchTargets.length > 0) {
            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.toLowerCase();
                searchTargets.forEach(target => {
                    const targetData = target.innerText.toLowerCase();
                    target.style.display = targetData.includes(searchTerm) ? '' : 'none';
                });
            });
        }
    });
</script>

