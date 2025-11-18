<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre Nós & Contactos - Sorriso Premium +</title>
  <link rel="shortcut icon" href="imgs/logo_clinica.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="font-sans antialiased bg-slate-50 pt-[104px]">


  <?php require('includes/nav.php') ?>

  
  <section class="bg-blue-900 text-white py-12 md:py-16">
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
    <div class="max-w-6xl mx-auto px-4 grid lg:grid-cols-2 gap-8 items-start">
      <section>
        <h2 class="text-lg md:text-xl font-semibold mb-3">Contactos & Localização</h2>
        <div class="w-16 h-1 bg-sky-500 rounded-full mb-4"></div>

        <ul class="space-y-3 text-sm text-slate-700">
          <li class="flex items-start gap-3">
            <i class="fas fa-location-dot mt-1 text-sky-500"></i>
            <div>
              Rua do Sorriso, 123, 1º Esq.<br />
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
