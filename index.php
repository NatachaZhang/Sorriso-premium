<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/connection.php';

function h(string $v): string {
  return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}

function stars_int(int $rating, int $max = 5): string {
  $rating = max(0, min($max, $rating));
  $out = '<span class="inline-flex items-center gap-1" aria-label="'.$rating.' de '.$max.'">';
  for ($i = 1; $i <= $max; $i++) {
    $out .= ($i <= $rating)
      ? '<i class="fa-solid fa-star text-amber-400"></i>'
      : '<i class="fa-regular fa-star text-slate-300"></i>';
  }
  $out .= '</span>';
  return $out;
}

function stars_avg(?float $rating, int $max = 5): string {
  if ($rating === null) return stars_int(0, $max);
  $rating = max(0, min($max, $rating));

  $out = '<span class="inline-flex items-center gap-1" aria-label="'.number_format($rating, 1, '.', '').' de '.$max.'">';
  for ($i = 1; $i <= $max; $i++) {
    if ($rating >= $i) {
      $out .= '<i class="fa-solid fa-star text-amber-400"></i>';
    } elseif ($rating >= ($i - 0.5)) {
      $out .= '<i class="fa-solid fa-star-half-stroke text-amber-400"></i>';
    } else {
      $out .= '<i class="fa-regular fa-star text-slate-300"></i>';
    }
  }
  $out .= '</span>';
  return $out;
}

$flashAvaliacao = $_SESSION['avaliacao_flash'] ?? '';
unset($_SESSION['avaliacao_flash']);


$stats = ['avg_rating' => null, 'total' => 0];
$ultimasAvaliacoes = [];
try {
  $stats = $pdo->query('SELECT AVG(rating) AS avg_rating, COUNT(*) AS total FROM avaliacoes')->fetch() ?: $stats;

  $ultimasAvaliacoes = $pdo->query(
    "SELECT a.rating, a.comentario, a.created_at, u.nome, u.apelido, c.tratamento, c.data_hora
     FROM avaliacoes a
     LEFT JOIN utentes u ON u.id = a.utente_id
     LEFT JOIN consultas c ON c.id = a.consulta_id
     ORDER BY a.created_at DESC
     LIMIT 6"
  )->fetchAll();
} catch (Throwable $e) {
}

$avg = ($stats['avg_rating'] !== null) ? number_format((float)$stats['avg_rating'], 1, '.', '') : '0.0';
$tot = (int)($stats['total'] ?? 0);

// Consultas do utente que podem ser avaliadas (so para quem tem login)
$avaliaveis = [];
if (!empty($_SESSION['user']['id'])) {
  try {
    $stmt = $pdo->prepare(
      "SELECT c.id, c.tratamento, c.data_hora
       FROM consultas c
       LEFT JOIN avaliacoes a ON a.consulta_id = c.id
       WHERE c.utente_id = ? AND c.estado = 'realizada' AND c.data_hora < NOW() AND a.id IS NULL
       ORDER BY c.data_hora DESC
       LIMIT 20"
    );
    $stmt->execute([(int)$_SESSION['user']['id']]);
    $avaliaveis = $stmt->fetchAll();
  } catch (Throwable $e) {
    $avaliaveis = [];
  }
}
?>

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

  <?php require('includes/nav.php') ?>

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
    <!-- Sobre a clínica -->
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

    <!-- Avaliações -->
    <section id="avaliacoes" class="py-16 bg-slate-50">
      <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-10">
          <span class="uppercase tracking-[0.2em] text-xs text-slate-500 font-semibold">Avaliações</span>
          <h2 class="text-2xl md:text-3xl font-bold mt-2 mb-3">Como foi a sua consulta?</h2>
          <div class="w-16 h-1 bg-sky-500 mx-auto rounded-full"></div>
          <p class="mt-3 text-sm md:text-base text-slate-600">As avaliações são públicas. Para avaliar, é necessário ter sessão iniciada.</p>
        </div>

        <?php if ($flashAvaliacao): ?>
          <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-900 max-w-3xl mx-auto">
            <?php echo h($flashAvaliacao); ?>
          </div>
        <?php endif; ?>

        <div class="grid lg:grid-cols-3 gap-6">
          <!-- Lista pública -->
          <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6">
            <div class="flex flex-wrap items-baseline justify-between gap-3">
              <h3 class="font-bold text-lg">Últimas avaliações</h3>
              <div class="text-sm text-slate-600 flex items-center gap-2">
                <span class="font-semibold">Média:</span>
                <?php echo stars_avg($stats['avg_rating'] !== null ? (float)$stats['avg_rating'] : null); ?>
                <span><?php echo h($avg); ?>/5 • <?php echo h((string)$tot); ?> avaliações</span>
              </div>
            </div>

            <?php if (!$ultimasAvaliacoes): ?>
              <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4 text-slate-700 text-sm">
                Ainda não existem avaliações.
              </div>
            <?php else: ?>
              <div class="mt-4 space-y-4">
                <?php foreach ($ultimasAvaliacoes as $a): ?>
                  <div class="rounded-xl border border-slate-200 p-4">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                      <div class="text-sm font-semibold text-slate-800">
                        <?php
                          $nome = trim((string)($a['nome'] ?? '') . ' ' . (string)($a['apelido'] ?? ''));
                          echo h($nome !== '' ? $nome : 'Utente');
                        ?>
                        <span class="text-slate-400 font-normal">•</span>
                        <span class="text-slate-600 font-normal">
                          <?php echo h((string)($a['tratamento'] ?? 'Consulta')); ?>
                        </span>
                      </div>
                      <div class="text-sm text-slate-700 flex items-center gap-2">
                        <?php echo stars_int((int)$a['rating']); ?>
                        <span class="text-xs text-slate-500"><?php echo (int)$a['rating']; ?>/5</span>
                      </div>
                    </div>

                    <?php if (!empty($a['comentario'])): ?>
                      <div class="mt-2 text-sm text-slate-700">
                        <?php echo nl2br(h((string)$a['comentario'])); ?>
                      </div>
                    <?php endif; ?>

                    <div class="mt-2 text-xs text-slate-500">
                      <?php echo h((string)$a['created_at']); ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

          <!-- Formulário -->
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-bold text-lg">Avaliar uma consulta</h3>
            <p class="text-sm text-slate-600 mt-1">Partilha a tua experiência com outros utentes.</p>

            <?php if (empty($_SESSION['user'])): ?>
              <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-700">
                Para avaliar, faz login.
                <div class="mt-3">
                  <a href="login.php" class="inline-flex items-center rounded-full bg-sky-500 px-4 py-2 text-white text-sm font-semibold hover:bg-sky-600">Fazer login</a>
                </div>
              </div>
            <?php else: ?>
              <?php if (!$avaliaveis): ?>
                <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-700">
                  Não tens consultas realizadas por avaliar (ou ainda não existem consultas concluídas).
                </div>
              <?php else: ?>
                <form action="actions/avaliar.php" method="post" class="mt-4 space-y-3">
                  <input type="hidden" name="csrf_token" value="<?php echo h($_SESSION['csrf_token'] ?? ''); ?>">

                  <div>
                    <label class="text-sm font-semibold">Consulta</label>
                    <select name="consulta_id" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" required>
                      <?php foreach ($avaliaveis as $c): ?>
                        <option value="<?php echo (int)$c['id']; ?>">
                          <?php echo h((string)$c['tratamento']); ?> — <?php echo h((string)$c['data_hora']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div>
                    <label class="text-sm font-semibold">Classificação</label>
                    <div class="mt-2 flex flex-wrap gap-2 text-sm">
                      <?php for ($i=5; $i>=1; $i--): ?>
                        <label class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-3 py-1 hover:bg-slate-50 cursor-pointer">
                          <input type="radio" name="rating" value="<?php echo $i; ?>" required>
                          <?php echo stars_int($i); ?>
                        </label>
                      <?php endfor; ?>
                    </div>
                  </div>

                  <div>
                    <label class="text-sm font-semibold">Comentário (opcional)</label>
                    <textarea name="comentario" rows="4" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="O que correu bem? O que podemos melhorar?"></textarea>
                  </div>

                  <button class="w-full rounded-full bg-sky-500 hover:bg-sky-600 text-white px-5 py-2 font-semibold">
                    Enviar avaliação
                  </button>
                </form>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php require('includes/footer.php') ?>

  <script>
    document.getElementById('ano-footer').textContent = new Date().getFullYear();
    const btn = document.getElementById('menu-toggle');
    const mobile = document.getElementById('mobile-menu');
    btn?.addEventListener('click', () => mobile.classList.toggle('hidden'));
  </script>

</body>
</html>
