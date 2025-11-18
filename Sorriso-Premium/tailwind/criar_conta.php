<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Criar Conta - Sorriso Premium +</title>
  <link rel="shortcut icon" href="imgs/logo_clinica.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="font-sans antialiased bg-slate-50 pt-[104px]">

  <?php require('includes/nav.php') ?>

  <main class="py-10">
    <div class="max-w-md md:max-w-lg mx-auto px-4">
      <div class="bg-white rounded-2xl shadow p-6 md:p-8">
        <h1 class="text-xl font-semibold text-center mb-2">Criar Conta</h1>
        <p class="text-xs md:text-sm text-slate-500 text-center mb-5">
          Cria uma conta para gerir as tuas marcações e dados de forma simples.
        </p>

        <form id="signupForm" action="trataInscricao.php" method="get" novalidate class="space-y-4">
          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label for="f-nome" class="block text-sm font-medium text-slate-700 mb-1">Nome</label>
              <input id="f-nome" name="fNome" type="text" required
                     class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500" />
            </div>
            <div>
              <label for="f-apelido" class="block text-sm font-medium text-slate-700 mb-1">Apelido</label>
              <input id="f-apelido" name="fApelido" type="text" required
                     class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500" />
            </div>
          </div>

          <div>
            <label for="f-data-nascimento" class="block text-sm font-medium text-slate-700 mb-1">
              Data de Nascimento
            </label>
            <input id="f-data-nascimento" name="fDataNascimento" type="date" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500" />
          </div>

          <div>
            <label for="f-telemovel" class="block text-sm font-medium text-slate-700 mb-1">
              Telemóvel
            </label>
            <input id="f-telemovel" name="fTelemovel" type="tel" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500" />
          </div>

          <div>
            <label for="f-email" class="block text-sm font-medium text-slate-700 mb-1">
              Endereço de e-mail
            </label>
            <input id="f-email" name="fEmail" type="email" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500" />
          </div>

          <div>
            <label for="f-password" class="block text-sm font-medium text-slate-700 mb-1">
              Palavra-passe
            </label>
            <input id="f-password" name="fPassword" type="password" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500" />
          </div>

          <div>
            <label for="f-confirm-password" class="block text-sm font-medium text-slate-700 mb-1">
              Confirmar palavra-passe
            </label>
            <input id="f-confirm-password" name="fConfirmPassword" type="password" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500" />
          </div>

          <button type="submit"
                  class="w-full rounded-full bg-sky-500 py-2 text-sm font-semibold text-white hover:bg-sky-400">
            Criar uma conta
          </button>

          <p class="text-center text-xs md:text-sm text-slate-600">
            Já tens conta?
            <a href="log.php" class="text-sky-600 hover:underline">Fazer login</a>
          </p>
        </form>
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

      const form = document.getElementById('signupForm');
      const pass = document.getElementById('f-password');
      const passConf = document.getElementById('f-confirm-password');

      form.addEventListener('submit', (e) => {
        if (pass.value !== passConf.value) {
          e.preventDefault();
          passConf.setCustomValidity('As palavras-passe não coincidem.');
          passConf.reportValidity();
          return;
        }
        passConf.setCustomValidity('');

        const userData = {
          nome: document.getElementById('f-nome').value,
          sobrenome: document.getElementById('f-apelido').value,
          dataNascimento: document.getElementById('f-data-nascimento').value,
          telemovel: document.getElementById('f-telemovel').value,
          email: document.getElementById('f-email').value
        };

        localStorage.setItem('sorrisoUserData', JSON.stringify(userData));
        localStorage.setItem('sorrisoLoggedIn', '1');
      });
    });
  </script>
</body>
</html>
