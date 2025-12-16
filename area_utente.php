<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/connection.php';

function h(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
function fmt_dt(string $dt): string {
  try {
    $d = new DateTime($dt);
    return $d->format('d/m/Y H:i');
  } catch (Throwable $e) {
    return $dt;
  }
}


if (empty($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

$userId = (int)$_SESSION['user']['id'];

// Proximas consultas (futuras)
$stmtUp = $pdo->prepare("
  SELECT c.*, d.nome AS dentista_nome, d.especialidade AS dentista_esp
  FROM consultas c
  LEFT JOIN dentistas d ON d.id = c.dentista_id
  WHERE c.utente_id = ?
    AND c.estado = 'agendada'
    AND c.data_hora >= NOW()
  ORDER BY c.data_hora ASC
  LIMIT 20
");
$stmtUp->execute([$userId]);
$upcoming = $stmtUp->fetchAll();

// Consultas anteriores (passadas)
$stmtPast = $pdo->prepare("
  SELECT c.*, d.nome AS dentista_nome, d.especialidade AS dentista_esp
  FROM consultas c
  LEFT JOIN dentistas d ON d.id = c.dentista_id
  WHERE c.utente_id = ?
    AND c.estado IN ('realizada','agendada')
    AND c.data_hora < NOW()
  ORDER BY c.data_hora DESC
  LIMIT 20
");
$stmtPast->execute([$userId]);
$past = $stmtPast->fetchAll();

$stmtCount = $pdo->prepare("SELECT
  SUM(estado='realizada') AS realizadas,
  SUM(estado='agendada') AS agendadas
  FROM consultas WHERE utente_id = ?
");
$stmtCount->execute([$userId]);
$counts = $stmtCount->fetch() ?: ['realizadas'=>0,'agendadas'=>0];

$nome = (string)($_SESSION['user']['nome'] ?? 'Utente');
$apelido = (string)($_SESSION['user']['apelido'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Área do Utente - Sorriso Premium +</title>
  <link rel="shortcut icon" href="imgs/logo_clinica.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="font-sans antialiased bg-slate-50 pt-[104px]">
  <?php require('includes/nav.php'); ?>

  <section class="bg-blue-900 text-white py-16 md:py-20">
    <div class="max-w-6xl mx-auto px-4">
      <h1 class="text-2xl md:text-4xl font-bold">Área do Utente</h1>
      <p class="text-sky-100 mt-2 text-sm md:text-base">
        Olá, <span class="font-semibold"><?php echo h($nome . ' ' . $apelido); ?></span>.
        Aqui podes ver as tuas consultas e resultados anteriores.
      </p>
    </div>
  </section>

  <main class="max-w-6xl mx-auto px-4 py-8 space-y-6">

    
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="bg-white rounded-2xl shadow-sm p-5">
        <div class="text-sm text-slate-500">Consultas realizadas</div>
        <div class="text-2xl font-bold mt-1"><?php echo (int)$counts['realizadas']; ?></div>
      </div>
      <div class="bg-white rounded-2xl shadow-sm p-5">
        <div class="text-sm text-slate-500">Consultas agendadas</div>
        <div class="text-2xl font-bold mt-1"><?php echo (int)$counts['agendadas']; ?></div>
      </div>
      <div class="bg-white rounded-2xl shadow-sm p-5 flex items-center justify-between">
        <div>
          <div class="text-sm text-slate-500">Marcar nova consulta</div>
          <div class="text-sm text-slate-600 mt-1">Escolhe tratamento/data</div>
        </div>
        <a href="marcacoes.php" class="rounded-full bg-sky-500 px-4 py-2 text-white text-sm font-semibold hover:bg-sky-600">
          Marcar
        </a>
      </div>
    </div>

    <!-- Proximas consultas -->
    <section class="bg-white rounded-2xl shadow-sm p-6">
      <h2 class="text-lg font-bold">Consultas futuras</h2>
      <p class="text-sm text-slate-600 mt-1">Agendadas a partir de hoje.</p>

      <?php if (!$upcoming): ?>
        <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4 text-slate-700 text-sm">
          Não tens consultas futuras agendadas.
        </div>
      <?php else: ?>
        <div class="mt-4 overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="text-slate-500">
              <tr class="border-b">
                <th class="py-3 text-left font-semibold">Data</th>
                <th class="py-3 text-left font-semibold">Tratamento</th>
                <th class="py-3 text-left font-semibold">Médico</th>
                <th class="py-3 text-left font-semibold">Clínica</th>
                <th class="py-3 text-left font-semibold">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($upcoming as $c): ?>
                <tr class="border-b last:border-b-0">
                  <td class="py-3"><?php echo h(fmt_dt((string)$c['data_hora'])); ?></td>
                  <td class="py-3"><?php echo h((string)$c['tratamento']); ?></td>
                  <td class="py-3">
                    <?php
                      $med = $c['dentista_nome'] ? ((string)$c['dentista_nome']) : 'Sem preferência';
                      $esp = $c['dentista_esp'] ? (' — ' . (string)$c['dentista_esp']) : '';
                      echo h($med . $esp);
                    ?>
                  </td>
                  <td class="py-3"><?php echo h((string)$c['clinica']); ?></td>
                  <td class="py-3">
                    <span class="inline-flex items-center rounded-full bg-sky-100 text-sky-800 px-3 py-1 text-xs font-semibold">
                      agendada
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </section>

    <!-- Histórico -->
    <section class="bg-white rounded-2xl shadow-sm p-6">
      <h2 class="text-lg font-bold">Consultas anteriores</h2>
      <p class="text-sm text-slate-600 mt-1">Histórico + resultados (quando existirem).</p>

      <?php if (!$past): ?>
        <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4 text-slate-700 text-sm">
          Ainda não tens consultas registadas no histórico.
        </div>
      <?php else: ?>
        <div class="mt-4 space-y-3">
          <?php foreach ($past as $c): ?>
            <details class="rounded-xl border border-slate-200 bg-slate-50 p-4">
              <summary class="cursor-pointer flex flex-wrap items-center justify-between gap-2">
                <div class="font-semibold text-slate-800">
                  <?php echo h(fmt_dt((string)$c['data_hora'])); ?> — <?php echo h((string)$c['tratamento']); ?>
                </div>
                <div class="text-xs text-slate-600">
                  Médico:
                  <?php
                    $med = $c['dentista_nome'] ? ((string)$c['dentista_nome']) : 'Sem preferência';
                    echo h($med);
                  ?>
                  | Clínica: <?php echo h((string)$c['clinica']); ?>
                </div>
              </summary>

              <div class="mt-3 grid md:grid-cols-2 gap-4 text-sm">
                <div>
                  <div class="text-slate-500 font-semibold">Motivo / Observações</div>
                  <div class="mt-1 text-slate-700">
                    <?php echo $c['motivo'] ? nl2br(h((string)$c['motivo'])) : '<span class="text-slate-400">—</span>'; ?>
                  </div>
                </div>

                <div>
                  <div class="text-slate-500 font-semibold">Resultado</div>
                  <div class="mt-1 text-slate-700">
                    <?php echo $c['resultado'] ? nl2br(h((string)$c['resultado'])) : '<span class="text-slate-400">Sem resultados registados.</span>'; ?>
                  </div>
                </div>
              </div>
            </details>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

  </main>

  <?php require('includes/footer.php'); ?>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const btn = document.getElementById('menu-toggle');
      const mobile = document.getElementById('mobile-menu');
      btn?.addEventListener('click', () => mobile.classList.toggle('hidden'));
    });
  </script>
</body>
</html>