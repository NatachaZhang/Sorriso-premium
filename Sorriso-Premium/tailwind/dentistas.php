<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Corpo Clínico - Sorriso Premium +</title>
  <link rel="shortcut icon" href="imgs/logo_clinica.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="font-sans antialiased bg-slate-50 pt-[104px]">

  <?php require('includes/nav.php') ?>

  <section class="bg-blue-900 text-white py-12 md:py-16">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-8 items-center">
      <div>
        <h1 class="text-2xl md:text-4xl font-bold mb-3">Corpo Clínico</h1>
        <p class="text-sm md:text-base text-sky-100 mb-3">
          Uma equipa multidisciplinar de médicos dentistas e higienistas, com formações em diferentes áreas da medicina dentária.
        </p>
        <p class="text-sm md:text-base text-sky-100 mb-5">
          Escolha a especialidade que procura e conheça os profissionais que vão cuidar do seu sorriso.
        </p>
        <a href="marcacoes.php"
           class="inline-flex items-center rounded-full bg-sky-400 text-slate-900 px-6 py-2 text-sm font-semibold hover:bg-sky-300">
          Marcar consulta
        </a>
      </div>
      <div class="flex justify-center md:justify-end">
        <i class="fas fa-users text-6xl md:text-8xl text-sky-200/80"></i>
      </div>
    </div>
  </section>

  <main class="py-10">
    <div class="max-w-6xl mx-auto px-4">
      <div class="text-center mb-6">
        <span class="uppercase tracking-[0.2em] text-xs text-slate-500 font-semibold">Especialidades</span>
        <h2 class="text-2xl font-bold mt-2 mb-2">Encontre o especialista certo</h2>
        <div class="w-16 h-1 bg-sky-500 mx-auto rounded-full mb-4"></div>
        <div class="flex flex-wrap justify-center gap-2 text-xs md:text-sm">
          <button class="filter-btn px-3 py-1.5 rounded-full border border-sky-500 text-sky-600 bg-sky-50"
                  data-filter="todas">
            Todas
          </button>
          <button class="filter-btn px-3 py-1.5 rounded-full border border-slate-300 hover:bg-slate-100"
                  data-filter="Ortodontia">
            Ortodontia
          </button>
          <button class="filter-btn px-3 py-1.5 rounded-full border border-slate-300 hover:bg-slate-100"
                  data-filter="Odontopediatria">
            Odontopediatria
          </button>
          <button class="filter-btn px-3 py-1.5 rounded-full border border-slate-300 hover:bg-slate-100"
                  data-filter="Implantes">
            Implantes
          </button>
          <button class="filter-btn px-3 py-1.5 rounded-full border border-slate-300 hover:bg-slate-100"
                  data-filter="Estética Dental">
            Estética Dental
          </button>
          <button class="filter-btn px-3 py-1.5 rounded-full border border-slate-300 hover:bg-slate-100"
                  data-filter="Periodontia">
            Periodontia
          </button>
          <button class="filter-btn px-3 py-1.5 rounded-full border border-slate-300 hover:bg-slate-100"
                  data-filter="Endodontia">
            Endodontia
          </button>
          <button class="filter-btn px-3 py-1.5 rounded-full border border-slate-300 hover:bg-slate-100"
                  data-filter="Cirurgia Oral">
            Cirurgia Oral
          </button>
        </div>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="lista-medicos">
        <article class="doctor-wrapper" data-especialidade="Ortodontia">
          <div class="bg-white rounded-2xl shadow-md p-5 text-center">
            <img src="imgs/afonso.jpeg" alt=""
                 class="mx-auto mb-3 h-24 w-24 rounded-full object-cover border-2 border-sky-500" />
            <span class="inline-block mb-2 rounded-full bg-sky-50 px-3 py-0.5 text-[11px] font-semibold text-sky-700">
              Ortodontia
            </span>
            <h3 class="text-sm font-semibold">Dr. Afonso Nunes</h3>
            <p class="mt-1 text-xs text-slate-500">
              Especialista em ortodontia para adolescentes e adultos.
            </p> 
            <a href="marcacoes.php" class="mt-3 inline-flex items-center rounded-full border border-sky-500 px-3 py-1 text-xs text-sky-600 hover:bg-sky-50">
              Marcar consulta
            </a>
          </div>
        </article>

        <article class="doctor-wrapper" data-especialidade="Ortodontia">
          <div class="bg-white rounded-2xl shadow-md p-5 text-center">
            <img src="imgs/diana.jpeg" alt=""
                 class="mx-auto mb-3 h-24 w-24 rounded-full object-cover border-2 border-sky-500" />
            <span class="inline-block mb-2 rounded-full bg-sky-50 px-3 py-0.5 text-[11px] font-semibold text-sky-700">
              Ortodontia
            </span>
            <h3 class="text-sm font-semibold">Dra. Diana Figueiredo</h3>
            <p class="mt-1 text-xs text-slate-500">
              Foco em ortodontia estética e alinhadores invisíveis.
            </p>
            <a href="marcacoes.php" class="mt-3 inline-flex items-center rounded-full border border-sky-500 px-3 py-1 text-xs text-sky-600 hover:bg-sky-50">
              Marcar consulta
            </a>
          </div>
        </article>

        <article class="doctor-wrapper" data-especialidade="Odontopediatria">
          <div class="bg-white rounded-2xl shadow-md p-5 text-center">
            <img src="" alt=""
                 class="mx-auto mb-3 h-24 w-24 rounded-full object-cover border-2 border-emerald-500" />
            <span class="inline-block mb-2 rounded-full bg-emerald-50 px-3 py-0.5 text-[11px] font-semibold text-emerald-700">
              Odontopediatria
            </span>
            <h3 class="text-sm font-semibold">?</h3>
            <p class="mt-1 text-xs text-slate-500">
              Especialista em odontopediatria e acompanhamento de crianças ansiosas.
            </p>
            <a href="marcacoes.php" class="mt-3 inline-flex items-center rounded-full border border-sky-500 px-3 py-1 text-xs text-sky-600 hover:bg-sky-50">
              Marcar consulta
            </a>
          </div>
        </article>

        <article class="doctor-wrapper" data-especialidade="Odontopediatria">
          <div class="bg-white rounded-2xl shadow-md p-5 text-center">
            <img src="imgs/rita.jpeg" alt=""
                 class="mx-auto mb-3 h-24 w-24 rounded-full object-cover border-2 border-emerald-500" />
            <span class="inline-block mb-2 rounded-full bg-emerald-50 px-3 py-0.5 text-[11px] font-semibold text-emerald-700">
              Odontopediatria
            </span>
            <h3 class="text-sm font-semibold">Dra. Rita Vinagreiro</h3>
            <p class="mt-1 text-xs text-slate-500">
              Cuidados dentários preventivos para bebés e crianças.
            </p>
            <a href="marcacoes.php" class="mt-3 inline-flex items-center rounded-full border border-sky-500 px-3 py-1 text-xs text-sky-600 hover:bg-sky-50">
              Marcar consulta
            </a>
          </div>
        </article>

        <article class="doctor-wrapper" data-especialidade="Implantes">
          <div class="bg-white rounded-2xl shadow-md p-5 text-center">
            <img src="" alt=""
                 class="mx-auto mb-3 h-24 w-24 rounded-full object-cover border-2 border-amber-500" />
            <span class="inline-block mb-2 rounded-full bg-amber-50 px-3 py-0.5 text-[11px] font-semibold text-amber-700">
              Implantes
            </span>
            <h3 class="text-sm font-semibold">?</h3>
            <p class="mt-1 text-xs text-slate-500">
              Focado em reabilitação oral com implantes e próteses.
            </p>
            <a href="marcacoes.php" class="mt-3 inline-flex items-center rounded-full border border-sky-500 px-3 py-1 text-xs text-sky-600 hover:bg-sky-50">
              Marcar consulta
            </a>
          </div>
        </article>

        <article class="doctor-wrapper" data-especialidade="Estética Dental">
          <div class="bg-white rounded-2xl shadow-md p-5 text-center">
            <img src="imgs/iara.jpeg" alt=""
                 class="mx-auto mb-3 h-24 w-24 rounded-full object-cover border-2 border-purple-500" />
            <span class="inline-block mb-2 rounded-full bg-purple-50 px-3 py-0.5 text-[11px] font-semibold text-purple-700">
              Estética Dental
            </span>
            <h3 class="text-sm font-semibold">Dra. Iara Gomes</h3>
            <p class="mt-1 text-xs text-slate-500">
              Especialista em facetas e harmonização do sorriso.
            </p>
            <a href="marcacoes.php" class="mt-3 inline-flex items-center rounded-full border border-sky-500 px-3 py-1 text-xs text-sky-600 hover:bg-sky-50">
              Marcar consulta
            </a>
          </div>
        </article>

        <article class="doctor-wrapper" data-especialidade="Periodontia">
          <div class="bg-white rounded-2xl shadow-md p-5 text-center">
            <img src="imgs/ana.jpeg" alt=""
                 class="mx-auto mb-3 h-24 w-24 rounded-full object-cover border-2 border-rose-500" />
            <span class="inline-block mb-2 rounded-full bg-rose-50 px-3 py-0.5 text-[11px] font-semibold text-rose-700">
              Periodontia
            </span>
            <h3 class="text-sm font-semibold">Dra. Ana Silva</h3>
            <p class="mt-1 text-xs text-slate-500">
              Tratamento e manutenção da saúde das gengivas.
            </p>
            <a href="marcacoes.php" class="mt-3 inline-flex items-center rounded-full border border-sky-500 px-3 py-1 text-xs text-sky-600 hover:bg-sky-50">
              Marcar consulta
            </a>
          </div>
        </article>

        <article class="doctor-wrapper" data-especialidade="Endodontia">
          <div class="bg-white rounded-2xl shadow-md p-5 text-center">
            <img src="" alt=""
                 class="mx-auto mb-3 h-24 w-24 rounded-full object-cover border-2 border-indigo-500" />
            <span class="inline-block mb-2 rounded-full bg-indigo-50 px-3 py-0.5 text-[11px] font-semibold text-indigo-700">
              Endodontia
            </span>
            <h3 class="text-sm font-semibold">?</h3>
            <p class="mt-1 text-xs text-slate-500">
              Especialista em tratamentos de canal e dor aguda.
            </p>
            <a href="marcacoes.php" class="mt-3 inline-flex items-center rounded-full border border-sky-500 px-3 py-1 text-xs text-sky-600 hover:bg-sky-50">
              Marcar consulta
            </a>
          </div>
        </article>

        <article class="doctor-wrapper" data-especialidade="Cirurgia Oral">
          <div class="bg-white rounded-2xl shadow-md p-5 text-center">
            <img src="" alt=""
                 class="mx-auto mb-3 h-24 w-24 rounded-full object-cover border-2 border-slate-500" />
            <span class="inline-block mb-2 rounded-full bg-slate-50 px-3 py-0.5 text-[11px] font-semibold text-slate-700">
              Cirurgia Oral
            </span>
            <h3 class="text-sm font-semibold">?</h3>
            <p class="mt-1 text-xs text-slate-500">
              Cirurgias orais, extrações de sisos e pequenas cirurgias.
            </p>
            <a href="marcacoes.php" class="mt-3 inline-flex items-center rounded-full border border-sky-500 px-3 py-1 text-xs text-sky-600 hover:bg-sky-50">
              Marcar consulta
            </a>
          </div>
        </article>
      </div>
    </div>
  </main>

  <?php require('includes/footer.php') ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('ano-footer').textContent = new Date().getFullYear();

      const btn = document.getElementById('menu-toggle');
      const mobile = document.getElementById('mobile-menu');
      btn?.addEventListener('click', () => mobile.classList.toggle('hidden'));
    });
  </script>

</body>
</html>
