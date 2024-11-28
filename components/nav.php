<nav class="bg-[#00ADB5] p-1 mb-2 rounded-lg shadow-lg text-[#222831]">
    <div class="flex items-center justify-center"> 
        <div class="md:hidden">
            <button id="menu-toggle" aria-expanded="false" class="text-[#222831] focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Menú de escritorio -->
        <ul id="nav-menu" class="hidden md:flex justify-center space-x-8 text-[#222831]">
            <?php foreach ($menuItems as $item): ?>
                <li class="relative group">
                    <a href="<?php echo $item['url']; ?>" class="flex items-center my-2 px-4 transition-all duration-300 transform hover:scale-110 hover:bg-green-500 hover:text-white">
                        <!-- Decidir si usar FA o SVG -->
                        <?php if (isset($item['faIcon'])): ?>
                            <i class="fa <?php echo $item['faIcon']; ?> mr-2"></i> <!-- Icono Font Awesome -->
                        <?php elseif (isset($item['svgIcon'])): ?>
                            <?php echo $item['svgIcon']; ?> <!-- Icono SVG -->
                        <?php endif; ?>
                        <?php echo $item['name']; ?>
                    </a>

                    <!-- Submenú desplegable -->
                    <?php if (isset($item['subMenu'])): ?>
                        <ul class="absolute left-0 hidden space-y-2 bg-white text-[#222831] shadow-lg group-hover:block">
                            <?php foreach ($item['subMenu'] as $subItem): ?>
                                <li>
                                    <a href="<?php echo $subItem['url']; ?>" class="flex items-center block px-4 py-2 text-sm hover:bg-[#00ADB5] hover:text-white transition duration-200">
                                        <!-- Submenú con íconos -->
                                        <?php if (isset($subItem['faIcon'])): ?>
                                            <i class="fa <?php echo $subItem['faIcon']; ?> mr-2"></i> <!-- Font Awesome -->
                                        <?php elseif (isset($subItem['svgIcon'])): ?>
                                            <?php echo $subItem['svgIcon']; ?> <!-- SVG -->
                                        <?php endif; ?>
                                        <?php echo $subItem['name']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
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

    // Mostrar el submenú en la versión de escritorio cuando el mouse pasa sobre el li
    const menuItems = document.querySelectorAll('#nav-menu .group');

    menuItems.forEach(item => {
        const subMenu = item.querySelector('ul');
        if (subMenu) {
            item.addEventListener('mouseenter', () => {
                subMenu.classList.remove('hidden'); // Mostrar el submenú
            });

            item.addEventListener('mouseleave', () => {
                subMenu.classList.add('hidden'); // Ocultar el submenú cuando el mouse sale del área
            });
        }
    });

    // Para mantener el submenú visible al hacer clic en un ítem de submenú
    const subMenus = document.querySelectorAll('#nav-menu .group > ul');

    subMenus.forEach(subMenu => {
        subMenu.addEventListener('click', (e) => {
            e.stopPropagation(); // Evitar que el clic se propague y cierre el submenú
        });
    });

    // Cerrar submenú al hacer clic fuera del menú (cuando estamos en el menú móvil)
    document.addEventListener('click', (e) => {
        const navMenu = document.getElementById('nav-menu');
        const navMenuSmall = document.getElementById('nav-menu-small');
        if (!navMenu.contains(e.target) && !navMenuSmall.contains(e.target)) {
            // Si se hace clic fuera del menú, ocultamos el menú pequeño
            navMenuSmall.classList.add('hidden');
        }
    });
</script>

