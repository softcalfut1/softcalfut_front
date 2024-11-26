<nav class="bg-[#00ADB5] p-4 mb-2 rounded-lg">
    <div class="flex items-center justify-between">
        <div class="md:hidden">
            <button id="menu-toggle" aria-expanded="false" class="text-[#222831] focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <ul id="nav-menu" class="hidden md:flex justify-center space-x-8 text-[#222831]">
            <?php foreach ($menuItems as $item): ?>
                <li><a href="<?php echo $item['url']; ?>" class="hover:text-[#00FFF5] transition duration-200"><?php echo $item['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>

        <span class="title text-2xl text-[#222831] text-lg truncate font-bold w-1/2 max-w-[283px] mx-auto">Sistema de Pedidos</span>

        <ul id="nav-menu-small" class="nav-menu-small bg-[#00ADB5] hidden mt-4">
            <?php foreach ($menuItems as $item): ?>
                <li><a href="<?php echo $item['url']; ?>" class="block py-2 px-4 text-[#222831] hover:text-[#00FFF5] transition duration-200"><?php echo $item['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>

<script>
    // Script para manejar el menú hamburguesa
    const menuToggle = document.getElementById('menu-toggle');
    const navMenuSmall = document.getElementById('nav-menu-small');

    menuToggle.addEventListener('click', () => {
        const isHidden = navMenuSmall.classList.toggle('hidden');
        menuToggle.setAttribute('aria-expanded', !isHidden);
    });
</script>
