<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tratamentos - Sorriso Premium +</title>
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
        <h1 class="text-2xl md:text-4xl font-bold mb-3">Os nossos tratamentos</h1>
        <p class="text-sm md:text-base text-sky-100 mb-5">
          Da prevenção à reabilitação completa, dispomos de todas as especialidades de medicina dentária num só espaço.
        </p>
        <a href="marcacoes.php"
           class="inline-flex items-center rounded-full bg-sky-400 text-slate-900 px-6 py-2 text-sm font-semibold hover:bg-sky-300">
          Marcar consulta
        </a>
      </div>
      <div class="flex justify-center md:justify-end">
        <i class="fas fa-tooth text-6xl md:text-8xl text-sky-200/80"></i>
      </div>
    </div>
  </section>

  <main class="py-10">
    <section class="max-w-6xl mx-auto px-4">
      <div class="text-center mb-8">
        <span class="uppercase tracking-[0.2em] text-xs text-slate-500 font-semibold">Tratamentos principais</span>
        <h2 class="text-2xl md:text-3xl font-bold mt-2 mb-2">Cuidamos do seu sorriso em todas as fases</h2>
        <div class="w-16 h-1 bg-sky-500 mx-auto rounded-full"></div>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Ortodontia -->
        <article id="ortodontia"
                 class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
          <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-sky-500 to-sky-400 text-white text-2xl">
            <i class="fas fa-teeth"></i>
          </div>
          <h3 class="text-lg font-semibold text-center">Ortodontia</h3>
          <p class="mt-2 inline-block self-center rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">
            Desde 45€/mês
          </p>
          <p class="mt-3 text-sm text-slate-600 text-center">
            Alinhamento dos dentes com aparelhos fixos, estéticos ou alinhadores invisíveis.
          </p>
          <ul class="mt-4 text-xs text-slate-600 space-y-1">
            <li>• Aparelho fixo metálico ou estético</li>
            <li>• Alinhadores transparentes</li>
            <li>• Correção da mordida e alinhamento</li>
            <li>• Acompanhamento regular</li>
          </ul>
          <button onclick="scrollToMarcacao()"
                  class="mt-4 w-full rounded-full border border-sky-500 py-2 text-xs font-semibold text-sky-600 hover:bg-sky-50">
            Marcar consulta
          </button>
        </article>

        <!-- Odontopediatria -->
        <article id="odontopediatria"
                 class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
          <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-emerald-400 text-white text-2xl">
            <i class="fas fa-baby"></i>
          </div>
          <h3 class="text-lg font-semibold text-center">Odontopediatria</h3>
          <p class="mt-2 inline-block self-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
            Consulta: 35€
          </p>
          <p class="mt-3 text-sm text-slate-600 text-center">
            Cuidados dentários especializados para bebés, crianças e adolescentes.
          </p>
          <ul class="mt-4 text-xs text-slate-600 space-y-1">
            <li>• Primeira consulta infantil</li>
            <li>• Aplicação de flúor</li>
            <li>• Selantes de fissuras</li>
            <li>• Educação de higiene oral</li>
          </ul>
          <button onclick="scrollToMarcacao()"
                  class="mt-4 w-full rounded-full border border-sky-500 py-2 text-xs font-semibold text-sky-600 hover:bg-sky-50">
            Marcar consulta
          </button>
        </article>

        <!-- Implantes -->
        <article id="implantes"
                 class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
          <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-amber-500 to-amber-400 text-white text-2xl">
            <i class="fas fa-tooth"></i>
          </div>
          <h3 class="text-lg font-semibold text-center">Implantes dentários</h3>
          <p class="mt-2 inline-block self-center rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
            Desde 800€ / implante
          </p>
          <p class="mt-3 text-sm text-slate-600 text-center">
            Substituição de dentes perdidos com resultados naturais e duradouros.
          </p>
          <ul class="mt-4 text-xs text-slate-600 space-y-1">
            <li>• Implantes unitários</li>
            <li>• Reabilitação total fixa</li>
            <li>• Planeamento digital</li>
            <li>• Material de alta qualidade</li>
          </ul>
          <button onclick="scrollToMarcacao()"
                  class="mt-4 w-full rounded-full border border-sky-500 py-2 text-xs font-semibold text-sky-600 hover:bg-sky-50">
            Marcar consulta
          </button>
        </article>

        <!-- Estética -->
        <article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
          <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-fuchsia-500 to-fuchsia-400 text-white text-2xl">
            <i class="fas fa-smile-beam"></i>
          </div>
          <h3 class="text-lg font-semibold text-center">Estética dental & Clareamento</h3>
          <p class="mt-2 inline-block self-center rounded-full bg-fuchsia-50 px-3 py-1 text-xs font-semibold text-fuchsia-700">
            Clareamento desde 120€
          </p>
          <p class="mt-3 text-sm text-slate-600 text-center">
            Tratamentos focados na melhoria da aparência do sorriso.
          </p>
          <ul class="mt-4 text-xs text-slate-600 space-y-1">
            <li>• Clareamento em consultório e em casa</li>
            <li>• Facetas de resina ou cerâmica</li>
            <li>• Fecho de espaços</li>
            <li>• Harmonização do sorriso</li>
          </ul>
          <button onclick="scrollToMarcacao()"
                  class="mt-4 w-full rounded-full border border-sky-500 py-2 text-xs font-semibold text-sky-600 hover:bg-sky-50">
            Marcar consulta
          </button>
        </article>

        <!-- Higiene -->
        <article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
          <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-slate-500 to-slate-400 text-white text-2xl">
            <i class="fas fa-tooth"></i>
          </div>
          <h3 class="text-lg font-semibold text-center">Check-up & Higiene oral</h3>
          <p class="mt-2 inline-block self-center rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700">
            Consulta + limpeza desde 50€
          </p>
          <p class="mt-3 text-sm text-slate-600 text-center">
            Prevenção de cáries, tártaro e doenças das gengivas.
          </p>
          <ul class="mt-4 text-xs text-slate-600 space-y-1">
            <li>• Consulta de avaliação</li>
            <li>• Destartarização e polimento</li>
            <li>• Raio-X, quando necessário</li>
            <li>• Plano de prevenção personalizado</li>
          </ul>
          <button onclick="scrollToMarcacao()"
                  class="mt-4 w-full rounded-full border border-sky-500 py-2 text-xs font-semibold text-sky-600 hover:bg-sky-50">
            Marcar consulta
          </button>
        </article>

        <!-- Periodontia -->
        <article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
          <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-rose-500 to-rose-400 text-white text-2xl">
            <i class="fas fa-heartbeat"></i>
          </div>
          <h3 class="text-lg font-semibold text-center">Periodontia</h3>
          <p class="mt-2 inline-block self-center rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700">
            Consulta desde 50€
          </p>
          <p class="mt-3 text-sm text-slate-600 text-center">
            Tratamento das gengivas e estruturas de suporte dos dentes.
          </p>
          <ul class="mt-4 text-xs text-slate-600 space-y-1">
            <li>• Tratamento de gengivite e periodontite</li>
            <li>• Raspagem e alisamento radicular</li>
            <li>• Acompanhamento periódico</li>
            <li>• Educação em saúde gengival</li>
          </ul>
          <button onclick="scrollToMarcacao()"
                  class="mt-4 w-full rounded-full border border-sky-500 py-2 text-xs font-semibold text-sky-600 hover:bg-sky-50">
            Marcar consulta
          </button>
        </article>

        <!-- Endodontia -->
        <article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
          <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-indigo-400 text-white text-2xl">
            <i class="fas fa-toolbox"></i>
          </div>
          <h3 class="text-lg font-semibold text-center">Endodontia</h3>
          <p class="mt-2 inline-block self-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
            80€ - 150€
          </p>
          <p class="mt-3 text-sm text-slate-600 text-center">
            Tratamento de canal para salvar dentes com inflamação ou infeção.
          </p>
          <ul class="mt-4 text-xs text-slate-600 space-y-1">
            <li>• Tratamento de canal</li>
            <li>• Retratamento endodôntico</li>
            <li>• Controlo radiográfico</li>
            <li>• Alívio de dor aguda</li>
          </ul>
          <button onclick="scrollToMarcacao()"
                  class="mt-4 w-full rounded-full border border-sky-500 py-2 text-xs font-semibold text-sky-600 hover:bg-sky-50">
            Marcar consulta
          </button>
        </article>

        <!-- Cirurgia -->
        <article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
          <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-slate-800 to-slate-600 text-white text-2xl">
            <i class="fas fa-hospital"></i>
          </div>
          <h3 class="text-lg font-semibold text-center">Cirurgia oral</h3>
          <p class="mt-2 inline-block self-center rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700">
            Sob orçamento
          </p>
          <p class="mt-3 text-sm text-slate-600 text-center">
            Procedimentos cirúrgicos como extrações de sisos e pequenas cirurgias.
          </p>
          <ul class="mt-4 text-xs text-slate-600 space-y-1">
            <li>• Extrações simples e de sisos</li>
            <li>• Cirurgias pré-protéticas</li>
            <li>• Cirurgias com sedação consciente</li>
            <li>• Acompanhamento pós-operatório</li>
          </ul>
          <button onclick="scrollToMarcacao()"
                  class="mt-4 w-full rounded-full border border-sky-500 py-2 text-xs font-semibold text-sky-600 hover:bg-sky-50">
            Marcar consulta
          </button>
        </article>
      </div>
    </section>

    <!-- Tabela de preços -->
    <section class="bg-slate-100 py-10 mt-10">
      <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-center text-xl md:text-2xl font-semibold mb-4">
          Tabela de preços (valores indicativos)
        </h2>
        <div class="overflow-x-auto">
          <table class="min-w-full text-xs md:text-sm border border-slate-200 bg-white rounded-xl overflow-hidden">
            <thead class="bg-sky-50 text-slate-800">
              <tr>
                <th class="px-3 py-2 text-left font-semibold">Tratamento</th>
                <th class="px-3 py-2 text-left font-semibold">Descrição</th>
                <th class="px-3 py-2 text-left font-semibold">Preço</th>
                <th class="px-3 py-2 text-left font-semibold">Duração média</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr>
                <td class="px-3 py-2 font-semibold">Consulta de rotina</td>
                <td class="px-3 py-2">Avaliação geral e diagnóstico</td>
                <td class="px-3 py-2">35€</td>
                <td class="px-3 py-2">30 min</td>
              </tr>
              <tr class="bg-slate-50/50">
                <td class="px-3 py-2 font-semibold">Check-up + Higiene oral</td>
                <td class="px-3 py-2">Limpeza, polimento e instruções de higiene</td>
                <td class="px-3 py-2">50€</td>
                <td class="px-3 py-2">40 min</td>
              </tr>
              <tr>
                <td class="px-3 py-2 font-semibold">Clareamento em consultório</td>
                <td class="px-3 py-2">Tratamento completo com kit de manutenção</td>
                <td class="px-3 py-2">120€ - 180€</td>
                <td class="px-3 py-2">1-2 sessões</td>
              </tr>
              <tr class="bg-slate-50/50">
                <td class="px-3 py-2 font-semibold">Aparelho fixo (tratamento)</td>
                <td class="px-3 py-2">Ortodontia completa (casos simples a moderados)</td>
                <td class="px-3 py-2">1.200€ - 2.500€</td>
                <td class="px-3 py-2">18 - 24 meses</td>
              </tr>
              <tr>
                <td class="px-3 py-2 font-semibold">Implante unitário</td>
                <td class="px-3 py-2">Colocação de implante e coroa</td>
                <td class="px-3 py-2">800€ - 1.200€</td>
                <td class="px-3 py-2">3 - 6 meses</td>
              </tr>
              <tr class="bg-slate-50/50">
                <td class="px-3 py-2 font-semibold">Tratamento de canal</td>
                <td class="px-3 py-2">Endodontia em dente anterior ou posterior</td>
                <td class="px-3 py-2">80€ - 150€</td>
                <td class="px-3 py-2">1 - 2 sessões</td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="mt-3 text-center text-[11px] text-slate-600">
          * Valores meramente indicativos. O plano e orçamento final são definidos após consulta de avaliação.
        </p>
      </div>
    </section>

    <!-- CTA final -->
    <section class="bg-blue-900 text-white py-10 mt-10">
      <div class="max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-xl md:text-2xl font-semibold mb-3">Pronto para o seu novo sorriso?</h2>
        <p class="text-sm md:text-base text-sky-100 mb-5">
          Marque já a sua consulta e descubra o tratamento ideal para si.
        </p>
        <a href="marcacoes.php"
           class="inline-flex items-center rounded-full bg-sky-400 text-slate-900 px-6 py-2 text-sm font-semibold hover:bg-sky-300">
          Marcar consulta agora
        </a>
      </div>
    </section>
  </main>

  <?php require('includes/footer.php') ?>

  <script>
    function scrollToMarcacao() {
      window.location.href = 'marcacoes.php';
    }
    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('ano-footer').textContent = new Date().getFullYear();
      const btn = document.getElementById('menu-toggle');
      const mobile = document.getElementById('mobile-menu');
      btn?.addEventListener('click', () => mobile.classList.toggle('hidden'));
    });
  </script>
</body>
</html>
