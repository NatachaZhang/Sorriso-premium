<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<?php
require_once __DIR__ . '/includes/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre Nós & Contactos - Sorriso Premium +</title>
  <link rel="shortcut icon" href="imgs/logo_clinica.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="font-sans antialiased bg-slate-50 pt-[104px]">

  <?php require('includes/nav.php') ?>

  <section class="bg-blue-900 text-white py-16 md:py-20">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-8 items-center">
      <div>
        <h1 class="text-2xl md:text-4xl font-bold mb-3">Sobre a Sorriso Premium +</h1>
        <p class="text-sm md:text-base text-sky-100 mb-3">
          A Sorriso Premium + é uma clínica dentária focada na prevenção, diagnóstico e tratamento, com serviços para toda a família.
        </p>
        <p class="text-sm md:text-base text-sky-100 mb-4">
          Acreditamos que um sorriso saudável começa cedo, por isso damos especial atenção à odontopediatria e ao acompanhamento regular.
        </p>
        <div class="flex flex-wrap gap-2">
          <span class="inline-flex items-center gap-2 rounded-full bg-indigo-100 text-slate-900 px-3 py-1 text-xs">
            <i class="fas fa-check-circle text-indigo-600"></i> Mais de 10 anos de experiência
          </span>
          <span class="inline-flex items-center gap-2 rounded-full bg-indigo-100 text-slate-900 px-3 py-1 text-xs">
            <i class="fas fa-tooth text-indigo-600"></i> Todas as especialidades dentárias
          </span>
        </div>
      </div>
      <div class="flex justify-center md:justify-end">
        <i class="fas fa-clinic-medical text-6xl md:text-8xl text-sky-200/80"></i>
      </div>
    </div>
  </section>

  <main class="py-10">
    <div class="max-w-6xl mx-auto px-4 space-y-12">

      <section class="bg-white shadow-md rounded-2xl p-6 md:p-8 border border-slate-100">
        <h2 class="text-xl md:text-2xl font-bold mb-3 text-slate-900">
          Missão, Visão e Valores
        </h2>
        <div class="w-20 h-1 bg-sky-500 rounded-full mb-6"></div>

        <div class="grid md:grid-cols-3 gap-6 text-sm text-slate-700">
          <!-- Missão -->
          <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2">
              <div class="w-9 h-9 rounded-full bg-sky-100 flex items-center justify-center">
                <i class="fas fa-bullseye text-sky-500"></i>
              </div>
              <h3 class="font-semibold text-base">Missão</h3>
            </div>
            <p>
              Cuidar cada vez melhor da saúde oral dos nossos pacientes, através de tratamentos de qualidade,
              acompanhamento próximo e uma equipa focada no bem-estar e conforto em cada consulta.
            </p>
          </div>

          <!-- Visão -->
          <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2">
              <div class="w-9 h-9 rounded-full bg-sky-100 flex items-center justify-center">
                <i class="fas fa-eye text-sky-500"></i>
              </div>
              <h3 class="font-semibold text-base">Visão</h3>
            </div>
            <p>
              Ser a melhor cadeia de clínicas dentárias em Portugal, reconhecida pela excelência clínica,
              inovação e experiência diferenciada dos nossos utentes.
            </p>
          </div>

          <!-- Valores -->
          <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2">
              <div class="w-9 h-9 rounded-full bg-sky-100 flex items-center justify-center">
                <i class="fas fa-heart text-sky-500"></i>
              </div>
              <h3 class="font-semibold text-base">Valores</h3>
            </div>
            <ul>
              <li>Qualidade - Rigor clínico, segurança e resultados duradouros.</li>
              <li>Rigor - Cumprimento de normas, protocolos e boas práticas.</li>
              <li>Humanismo - Respeito, empatia e cuidado personalizado.</li>
              <li>Sustentabilidade - Responsabilidade social e ambiental.</li>
            </ul>
          </div>
        </div>
      </section>

      <section class="grid lg:grid-cols-2 gap-8 items-start">
        <section>
          <h2 class="text-lg md:text-xl font-semibold mb-3">Contactos & Localização</h2>
          <div class="w-16 h-1 bg-sky-500 rounded-full mb-4"></div>

          <ul class="space-y-3 text-sm text-slate-700">
            <li class="flex items-start gap-3">
              <i class="fas fa-location-dot mt-1 text-sky-500"></i>
              <div>
                Rua do Sorriso, 12, 1º Esq.<br />
                4000-000 Porto
              </div>
            </li>
            <li class="flex items-center gap-3">
              <i class="fas fa-phone text-sky-500"></i>
              <span>Tel: +351 498 855 647</span>
            </li>
            <li class="flex items-center gap-3">
              <i class="fas fa-envelope text-sky-500"></i>
              <a href="mailto:info@sorrisopremium.pt" class="text-sky-600 hover:underline">
                info@sorrisopremium.pt
              </a>
            </li>
          </ul>

          <h3 class="text-base font-semibold mt-6 mb-2">Horário de Funcionamento</h3>
          <ul class="text-sm text-slate-700 space-y-1">
            <li><strong>Segunda a Sexta:</strong> 09h00 - 19h00</li>
            <li><strong>Sábado:</strong> 09h00 - 13h00</li>
            <li><strong>Domingo e Feriados:</strong> Encerrado</li>
          </ul>
        </section>

        <!-- Mapa + escolha de clínicas -->
        <section class="bg-white shadow-sm rounded-xl p-5 border border-slate-100">
          <h2 class="text-lg md:text-xl font-semibold mb-3">Encontre a clínica mais perto de si</h2>
          <div class="w-16 h-1 bg-sky-500 rounded-full mb-4"></div>

          <div class="mb-4">
            <label for="clinic-select" class="block text-sm font-medium text-slate-700 mb-1">
              Selecionar clínica
            </label>
            <select
              id="clinic-select"
              class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500"
            >
              <option
                value="porto"
                data-map="https://www.google.com/maps?q=Rua+do+Sorriso+12+Porto&output=embed"
              >
                Porto - Sorriso Premium +
              </option>
              <option
                value="lisboa"
                data-map="https://www.google.com/maps?q=Rua+do+Sorriso+34+Lisboa&output=embed"
              >
                Lisboa - Sorriso Premium +
              </option>
              <option
                value="coimbra"
                data-map="https://www.google.com/maps?q=Rua+do+Sorriso+45+Coimbra&output=embed"
              >
                Coimbra - Sorriso Premium +
              </option>
            </select>
          </div>

          <div class="aspect-[4/3] w-full overflow-hidden rounded-lg border border-slate-200">
            <iframe
              id="map-frame"
              src=""
              style="border:0; width:100%; height:100%;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </section>
      </section>
    </div>
  </main>

  <?php require('includes/footer.php') ?>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // ano footer
      const anoFooter = document.getElementById('ano-footer');
      if (anoFooter) {
        anoFooter.textContent = new Date().getFullYear();
      }

      // menu mobile
      const btn = document.getElementById('menu-toggle');
      const mobile = document.getElementById('mobile-menu');
      btn?.addEventListener('click', () => mobile.classList.toggle('hidden'));

      // mapa das clínicas
      const select = document.getElementById('clinic-select');
      const mapFrame = document.getElementById('map-frame');

      if (select && mapFrame) {
        const updateMap = () => {
          const option = select.selectedOptions[0];
          const url = option.dataset.map;
          if (url) {
            mapFrame.src = url;
          }
        };

        select.addEventListener('change', updateMap);
        // definir mapa inicial
        updateMap();
      }
    });
  </script>
</body>
</html>