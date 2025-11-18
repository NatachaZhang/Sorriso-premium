<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sorriso Premium +</title>
  <link rel="shortcut icon" href="imgs/logo_clinica.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="font-sans antialiased bg-slate-50 pt-[144px]">

  <nav class="fixed top-0 inset-x-0 z-50">
    <div class="bg-slate-50 border-b border-slate-200">
      <div class="max-w-6xl mx-auto px-4 py-2 flex flex-wrap items-center justify-end gap-6 text-sm">
        <div class="flex items-center gap-3 text-slate-700">
          <a href="https://www.instagram.com" target="_blank" class="hover:text-sky-600">
            <i class="fab fa-instagram text-lg"></i>
          </a>
          <a href="https://www.facebook.com" target="_blank" class="hover:text-sky-600">
            <i class="fab fa-facebook text-lg"></i>
          </a>
          <a href="https://twitter.com" target="_blank" class="hover:text-sky-600">
            <i class="fab fa-twitter text-lg"></i>
          </a>
          <a href="https://www.youtube.com" target="_blank" class="hover:text-sky-600">
            <i class="fab fa-youtube text-lg"></i>
          </a>
          <a href="https://www.linkedin.com" target="_blank" class="hover:text-sky-600">
            <i class="fab fa-linkedin text-lg"></i>
          </a>
        </div>

        <div class="text-right text-slate-800">
          <div class="font-semibold">Tel: +351 498 855 647</div>
          <div class="text-xs text-slate-500">(Chamada para rede fixa nacional)</div>
        </div>

        <div>
          <a href="log.php"
             class="inline-flex items-center rounded-full bg-slate-900 text-white px-4 py-1 text-xs md:text-sm hover:bg-slate-800">
            Login / Sign in
          </a>
        </div>
      </div>
    </div>


    <div class="bg-blue-900 text-white shadow-lg">
      <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="index.php" class="flex items-center gap-2">
          <img src="imgs/logo_clinica.png" alt="Logótipo Sorriso Premium +"
               class="h-20 md:h-24 w-auto" />
        </a>

        <button id="menu-toggle"
                class="md:hidden inline-flex items-center justify-center rounded-md border border-white/30 p-2 text-white hover:bg-white/10">
          <span class="sr-only">Abrir menu</span>
          <i class="fas fa-bars"></i>
        </button>

        <div id="menu"
             class="hidden md:flex md:items-center md:gap-6 text-sm font-medium">
          <a href="index.php"
             class="pb-1 border-b-2 border-sky-300 text-sky-300">
            Home
          </a>
          <a href="dentistas.php" class="pb-1 hover:text-sky-200">
            Corpo Clínico
          </a>
          <a href="contactos.php" class="pb-1 hover:text-sky-200">
            Sobre Nós
          </a>
          <a href="tratamentos.php" class="pb-1 hover:text-sky-200">
            Tratamentos
          </a>
          <a href="marcacoes.php"
             class="inline-flex items-center rounded-full bg-sky-400 text-slate-900 px-4 py-1.5 hover:bg-sky-300">
            Marcação
          </a>
        </div>
      </div>

      <!-- MENU MOBILE -->
      <div id="mobile-menu"
           class="md:hidden hidden border-t border-blue-800 bg-blue-900/95 text-sm">
        <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-2">
          <a href="index.php"
             class="py-1 text-sky-300">
            Home
          </a>
          <a href="dentistas.php"
             class="py-1 text-white hover:text-sky-200">
            Corpo Clínico
          </a>
          <a href="contactos.php"
             class="py-1 text-white hover:text-sky-200">
            Sobre Nós
          </a>
          <a href="tratamentos.php"
             class="py-1 text-white hover:text-sky-200">
            Tratamentos
          </a>
          <a href="marcacoes.php"
             class="mt-2 inline-flex w-max rounded-full bg-sky-400 px-4 py-1.5 text-slate-900 hover:bg-sky-300">
            Marcação
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="relative flex items-center min-h-[80vh] text-white"
          style="background-image: url('imgs/clinicadentaria.jpg'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative max-w-4xl mx-auto px-4 py-16">
      <p class="text-3xl md:text-5xl font-bold mb-4 leading-tight">
        Cuidamos dos pequenos sorrisos<br />
        para um futuro saudável
      </p>
      <p class="text-base md:text-lg text-sky-100 mb-6">
        Equipa especializada em prevenção e cuidados dentários<br />
        para crianças, jovens e toda a família.
      </p>
      <div class="flex flex-wrap gap-3">
        <a href="marcacoes.php"
           class="inline-flex items-center rounded-full bg-sky-500 px-6 py-3 text-sm md:text-base font-semibold hover:bg-sky-400">
          Marcar consulta
        </a>
        <a href="tratamentos.php"
           class="inline-flex items-center rounded-full border border-slate-100 px-6 py-3 text-sm md:text-base font-semibold hover:bg-white/10">
          Ver tratamentos
        </a>
      </div>
    </div>
  </header>

  <main>
    <section class="py-16 bg-slate-50">
      <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-10">
          <span class="uppercase tracking-[0.2em] text-xs text-slate-500 font-semibold">
            A nossa clínica
          </span>
          <h2 class="text-2xl md:text-3xl font-bold mt-2 mb-3">
            Porque escolher a Sorriso Premium +
          </h2>
          <div class="w-16 h-1 bg-sky-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-white rounded-2xl shadow-sm p-6 flex flex-col">
            <div class="mb-4 text-sky-600 text-3xl">
              <i class="fas fa-user-md"></i>
            </div>
            <h3 class="font-semibold mb-2">Equipa especializada</h3>
            <p class="text-sm text-slate-600">
              Corpo clínico com várias especialidades, preparado para acompanhar cada fase do seu sorriso.
            </p>
          </div>

          <div class="bg-white rounded-2xl shadow-sm p-6 flex flex-col">
            <div class="mb-4 text-sky-600 text-3xl">
              <i class="fas fa-tooth"></i>
            </div>
            <h3 class="font-semibold mb-2">Tecnologia moderna</h3>
            <p class="text-sm text-slate-600">
              Equipamentos de última geração para diagnósticos precisos e tratamentos mais confortáveis.
            </p>
          </div>

          <div class="bg-white rounded-2xl shadow-sm p-6 flex flex-col">
            <div class="mb-4 text-sky-600 text-3xl">
              <i class="fas fa-child"></i>
            </div>
            <h3 class="font-semibold mb-2">Ambiente familiar</h3>
            <p class="text-sm text-slate-600">
              Espaço pensado para crianças e adultos, com um atendimento próximo e acolhedor.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Promoções -->
    <section id="promocoes" class="py-16 bg-gradient-to-r from-slate-900 to-sky-900 text-white">
      <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-10">
          <span class="uppercase tracking-[0.2em] text-xs text-sky-200 font-semibold">
            Promoções de estação
          </span>
          <h2 class="text-2xl md:text-3xl font-bold mt-2 mb-3">
            Sorrisos especiais todo o ano
          </h2>
          <div class="w-16 h-1 bg-white mx-auto rounded-full"></div>
          <p class="mt-3 text-sm md:text-base text-sky-100">
            Aproveite as nossas campanhas sazonais em tratamentos selecionados.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- Verão -->
          <article class="bg-white text-slate-900 rounded-2xl shadow-xl p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-sky-50 text-sky-500 flex items-center justify-center text-lg">
                  <i class="fas fa-sun"></i>
                </div>
                <div>
                  <span class="inline-block rounded-full px-3 py-0.5 text-xs font-semibold bg-amber-100 text-amber-800">
                    Promo Verão
                  </span>
                  <h3 class="font-semibold mt-1 text-sm">Sorriso Brilhante</h3>
                </div>
              </div>
              <p class="text-xs text-slate-500 mb-1">
                <i class="fas fa-calendar mr-1"></i>
                Válida de <strong>01/06</strong> a <strong>31/08</strong>.
              </p>
              <p class="text-sm text-slate-700 mb-2">
                -20% em <strong>clareamento dental</strong> para um sorriso mais branco e luminoso.
              </p>
              <ul class="text-xs text-slate-600 space-y-1 mb-3">
                <li>✓ Inclui avaliação inicial</li>
                <li>✓ Clareamento em consultório</li>
                <li>✓ Kit de manutenção em casa</li>
              </ul>
            </div>
            <div>
              <p class="font-semibold text-sky-600 text-sm mb-2">A partir de 120€</p>
              <a href="marcacoes.php?promo=verao-clareamento"
                 class="block text-center rounded-full bg-sky-500 text-white py-2 text-sm font-medium hover:bg-sky-400">
                Reservar promoção
              </a>
            </div>
          </article>

          <!-- Primavera -->
          <article class="bg-white text-slate-900 rounded-2xl shadow-xl p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center text-lg">
                  <i class="fas fa-leaf"></i>
                </div>
                <div>
                  <span class="inline-block rounded-full px-3 py-0.5 text-xs font-semibold bg-emerald-100 text-emerald-700">
                    Promo Primavera
                  </span>
                  <h3 class="font-semibold mt-1 text-sm">Check-up Familiar</h3>
                </div>
              </div>
              <p class="text-xs text-slate-500 mb-1">
                <i class="fas fa-calendar mr-1"></i>
                Válida de <strong>01/03</strong> a <strong>31/05</strong>.
              </p>
              <p class="text-sm text-slate-700 mb-2">
                Limpeza + check-up com raio-X para 2 membros da família.
              </p>
              <ul class="text-xs text-slate-600 space-y-1 mb-3">
                <li>✓ Consulta de avaliação</li>
                <li>✓ Destartarização</li>
                <li>✓ Plano de tratamento personalizado</li>
              </ul>
            </div>
            <div>
              <p class="font-semibold text-sky-600 text-sm mb-2">Pacote 2 pessoas por 70€</p>
              <a href="marcacoes.php?promo=primavera-checkup"
                 class="block text-center rounded-full bg-sky-500 text-white py-2 text-sm font-medium hover:bg-sky-400">
                Agendar agora
              </a>
            </div>
          </article>

          <!-- Outono -->
          <article class="bg-white text-slate-900 rounded-2xl shadow-xl p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center text-lg">
                  <i class="fas fa-tree"></i>
                </div>
                <div>
                  <span class="inline-block rounded-full px-3 py-0.5 text-xs font-semibold bg-orange-100 text-orange-800">
                    Promo Outono
                  </span>
                  <h3 class="font-semibold mt-1 text-sm">Renova Sorriso</h3>
                </div>
              </div>
              <p class="text-xs text-slate-500 mb-1">
                <i class="fas fa-calendar mr-1"></i>
                Válida de <strong>01/09</strong> a <strong>30/11</strong>.
              </p>
              <p class="text-sm text-slate-700 mb-2">
                Pacote de <strong>estética dental</strong> com desconto em facetas e clareamento.
              </p>
              <ul class="text-xs text-slate-600 space-y-1 mb-3">
                <li>✓ Avaliação estética completa</li>
                <li>✓ Planeamento digital do sorriso</li>
                <li>✓ Desconto em facetas e clareamento</li>
              </ul>
            </div>
            <div>
              <p class="font-semibold text-sky-600 text-sm mb-2">Até -15% em estética</p>
              <a href="marcacoes.php?promo=outono-estetica"
                 class="block text-center rounded-full bg-sky-500 text-white py-2 text-sm font-medium hover:bg-sky-400">
                Aproveitar promoção
              </a>
            </div>
          </article>

          <!-- Inverno -->
          <article class="bg-white text-slate-900 rounded-2xl shadow-xl p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-sky-50 text-sky-500 flex items-center justify-center text-lg">
                  <i class="fas fa-snowflake"></i>
                </div>
                <div>
                  <span class="inline-block rounded-full px-3 py-0.5 text-xs font-semibold bg-sky-100 text-sky-800">
                    Promo Inverno
                  </span>
                  <h3 class="font-semibold mt-1 text-sm">Inverno sem dor</h3>
                </div>
              </div>
              <p class="text-xs text-slate-500 mb-1">
                <i class="fas fa-calendar mr-1"></i>
                Válida de <strong>01/12</strong> a <strong>28/02</strong>.
              </p>
              <p class="text-sm text-slate-700 mb-2">
                Desconto em tratamentos de <strong>endodontia</strong> (tratamento de canal).
              </p>
              <ul class="text-xs text-slate-600 space-y-1 mb-3">
                <li>✓ Consulta de urgência incluída</li>
                <li>✓ Raio-X digital</li>
                <li>✓ Plano de pagamento faseado</li>
              </ul>
            </div>
            <div>
              <p class="font-semibold text-sky-600 text-sm mb-2">10% de desconto</p>
              <a href="marcacoes.php?promo=inverno-endodontia"
                 class="block text-center rounded-full bg-sky-500 text-white py-2 text-sm font-medium hover:bg-sky-400">
                Marcar tratamento
              </a>
            </div>
          </article>
        </div>

        <p class="mt-4 text-center text-xs text-sky-100">
          * Campanhas sujeitas a disponibilidade e vigência. Confirme sempre na marcação.
        </p>
      </div>
    </section>
  </main>

    <?php require('includes/footer.php') ?>

    <script>
    document.getElementById('ano-footer').textContent = new Date().getFullYear();


    const btn = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
    const mobile = document.getElementById('mobile-menu');

    btn?.addEventListener('click', () => {
      mobile.classList.toggle('hidden');
    });
  </script>
  

</body>
</html>
