<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Sorriso Premium +</title>
  <link rel="shortcut icon" href="imgs/logo_clinica.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="font-sans antialiased bg-slate-50 pt-[104px]">

  <?php require('includes/nav.php') ?>

  <main class="py-10">
    <div class="max-w-md mx-auto px-4">
      <div class="bg-white rounded-2xl shadow p-6 md:p-8">
        <h1 class="text-xl font-semibold text-center mb-2">Iniciar sessão</h1>
        <p class="text-xs md:text-sm text-slate-500 text-center mb-5">
          Se já tens conta, faz login com o teu endereço de email.
        </p>

        <form id="loginForm" action="trataInscricao.php" method="get" novalidate class="space-y-4">
          <div>
            <label for="f-email" class="block text-sm font-medium text-slate-700 mb-1">
              Endereço de e-mail
            </label>
            <input id="f-email" name="fEmail" type="email" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"
                   placeholder="Introduza o seu email" />
          </div>

          <div>
            <label for="f-password" class="block text-sm font-medium text-slate-700 mb-1">
              Palavra-passe
            </label>
            <input id="f-password" name="fPassword" type="password" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"
                   placeholder="Introduza a sua palavra-passe" />
          </div>

          <div class="flex items-center justify-between text-xs md:text-sm">
            <label class="inline-flex items-center gap-2">
              <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300" />
              <span>Manter sessão iniciada</span>
            </label>
            <a href="recuperar_senha.php" class="text-sky-600 hover:underline">
              Esqueci-me da palavra-passe
            </a>
          </div>

          <button type="submit"
                  class="w-full rounded-full bg-sky-500 py-2 text-sm font-semibold text-white hover:bg-sky-400">
            Iniciar sessão
          </button>

          <p class="text-center text-xs md:text-sm text-slate-600">
            Ainda não tens conta?
            <a href="criar_conta.php" class="text-sky-600 hover:underline">Criar conta</a>
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
    });
  </script>

</body>
</html>
