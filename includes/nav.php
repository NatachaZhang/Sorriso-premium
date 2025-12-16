<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$page = basename($_SERVER['PHP_SELF']);
?>
<nav class="fixed top-0 inset-x-0 z-50">

  <div class="bg-slate-50 border-b border-slate-200">
    <div class="max-w-6xl mx-auto px-4 py-2 flex flex-wrap items-center justify-end gap-6 text-sm">

      <div class="flex items-center gap-3 text-slate-700">
        <a href="https://www.instagram.com" target="_blank" class="hover:text-sky-600"><i class="fab fa-instagram text-lg"></i></a>
        <a href="https://www.facebook.com" target="_blank" class="hover:text-sky-600"><i class="fab fa-facebook text-lg"></i></a>
        <a href="https://twitter.com" target="_blank" class="hover:text-sky-600"><i class="fab fa-twitter text-lg"></i></a>
        <a href="https://www.youtube.com" target="_blank" class="hover:text-sky-600"><i class="fab fa-youtube text-lg"></i></a>
        <a href="https://www.linkedin.com" target="_blank" class="hover:text-sky-600"><i class="fab fa-linkedin text-lg"></i></a>
      </div>

      <div class="text-right text-slate-800">
        <div class="font-semibold">Tel: +351 498 855 647</div>
        <div class="text-xs text-slate-500">(Chamada para rede fixa nacional)</div>
      </div>

      <div>
        <?php if (!empty($_SESSION['user'])): ?>
          <div class="flex items-center gap-3">
            <span class="text-slate-800 text-xs md:text-sm font-semibold">
              Olá, <?php echo htmlspecialchars($_SESSION['user']['nome'], ENT_QUOTES, 'UTF-8'); ?>
            </span>
            <a href="area_utente.php" class="text-xs md:text-sm font-semibold text-sky-700 hover:underline">
              Minha Área
            </a>
            <a href="auth/logout.php"
               class="inline-flex items-center rounded-full bg-slate-900 text-white px-4 py-1 text-xs md:text-sm hover:bg-slate-800">
              Sair
            </a>
          </div>
        <?php else: ?>
          <a href="login.php"
             class="inline-flex items-center rounded-full bg-slate-900 text-white px-4 py-1 text-xs md:text-sm hover:bg-slate-800">
            Login / Sign in
          </a>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <div class="bg-blue-900 text-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">

      <a href="index.php" class="flex items-center gap-2">
        <img src="imgs/logo_clinica.png" alt="Logótipo Sorriso Premium +" class="h-20 md:h-24 w-auto" />
      </a>

      <button id="menu-toggle"
              class="md:hidden inline-flex items-center justify-center rounded-md border border-white/30 p-2 text-white hover:bg-white/10">
        <span class="sr-only">Abrir menu</span>
        <i class="fas fa-bars"></i>
      </button>

      <div id="menu" class="hidden md:flex md:items-center md:gap-6 text-sm font-medium">
        <a href="index.php"
          class="pb-1 <?= $page=='index.php' ? 'border-b-2 border-sky-300 text-sky-300' : 'hover:text-sky-200' ?>">
          Home
        </a>

        <a href="dentistas.php"
          class="pb-1 <?= $page=='dentistas.php' ? 'border-b-2 border-sky-300 text-sky-300' : 'hover:text-sky-200' ?>">
          Corpo Clínico
        </a>

        <a href="contactos.php"
          class="pb-1 <?= $page=='contactos.php' ? 'border-b-2 border-sky-300 text-sky-300' : 'hover:text-sky-200' ?>">
          Sobre Nós
        </a>

        <a href="tratamentos.php"
          class="pb-1 <?= $page=='tratamentos.php' ? 'border-b-2 border-sky-300 text-sky-300' : 'hover:text-sky-200' ?>">
          Tratamentos
        </a>

        <a href="marcacoes.php"
          class="inline-flex items-center rounded-full px-4 py-1.5
                  <?= $page=='marcacoes.php' ? 'bg-sky-300 text-slate-900' : 'bg-sky-400 text-slate-900 hover:bg-sky-300' ?>">
          Marcação
        </a>
      </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden border-t border-blue-800 bg-blue-900/95 text-sm">
      <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-2">

        <a href="index.php" class="py-1 <?= $page=='index.php' ? 'text-sky-300' : 'text-white hover:text-sky-200' ?>">Home</a>
        <a href="dentistas.php" class="py-1 <?= $page=='dentistas.php' ? 'text-sky-300' : 'text-white hover:text-sky-200' ?>">Corpo Clínico</a>
        <a href="contactos.php" class="py-1 <?= $page=='contactos.php' ? 'text-sky-300' : 'text-white hover:text-sky-200' ?>">Sobre Nós</a>
        <a href="tratamentos.php" class="py-1 <?= $page=='tratamentos.php' ? 'text-sky-300' : 'text-white hover:text-sky-200' ?>">Tratamentos</a>

        <a href="marcacoes.php"
           class="mt-2 inline-flex w-max rounded-full px-4 py-1.5
                  <?= $page=='marcacoes.php' ? 'bg-sky-300 text-slate-900' : 'bg-sky-400 text-slate-900 hover:bg-sky-300' ?>">
          Marcação
        </a>



      </div>
    </div>

  </div>
</nav>