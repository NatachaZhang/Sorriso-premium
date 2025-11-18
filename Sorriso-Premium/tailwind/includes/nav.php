  <nav class="fixed top-0 inset-x-0 z-50 bg-blue-900 text-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="index.php" class="flex items-center gap-2">
        <img src="imgs/logo_clinica.png" alt="Logótipo Sorriso Premium +" class="h-20 md:h-24 w-auto" />
      </a>
      <button id="menu-toggle"
              class="md:hidden inline-flex items-center justify-center rounded-md border border-white/30 p-2 hover:bg-white/10">
        <span class="sr-only">Abrir menu</span>
        <i class="fas fa-bars"></i>
      </button>
      <div id="menu" class="hidden md:flex md:items-center md:gap-6 text-sm font-medium">
        <a href="index.php" class="pb-1 hover:text-sky-200">Home</a>
        <a href="dentistas.php" class="pb-1 hover:text-sky-200">Corpo Clínico</a>
        <a href="contactos.php" class="pb-1 hover:text-sky-200">Sobre Nós</a>
        <a href="tratamentos.php" class="pb-1 hover:text-sky-200">Tratamentos</a>
        <a href="marcacoes.php" class="inline-flex items-center rounded-full bg-sky-400 text-slate-900 px-4 py-1.5 hover:bg-sky-300">Marcação</a>
      </div>
    </div>
    <div id="mobile-menu"
         class="hidden md:hidden border-t border-blue-800 bg-blue-900/95 text-sm">
      <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-2">
        <a href="index.php" class="py-1 text-white hover:text-sky-200">Home</a>
        <a href="dentistas.php" class="py-1 text-white hover:text-sky-200">Corpo Clínico</a>
        <a href="contactos.php" class="py-1 text-white hover:text-sky-200">Sobre Nós</a>
        <a href="tratamentos.php" class="py-1 text-white hover:text-sky-200">Tratamentos</a>
        <a href="marcacoes.php" class="mt-2 inline-flex w-max rounded-full bg-sky-400 px-4 py-1.5 text-slate-900 hover:bg-sky-300">Marcação</a>
      </div>
    </div>
  </nav>