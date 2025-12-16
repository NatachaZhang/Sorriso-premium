<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/connection.php';

function h(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

$treatments = [
  'Ortodontia',
  'Odontopediatria',
  'Implantes dentários',
  'Estética dental & Clareamento',
  'Check-up & Higiene oral',
  'Endodontia',
  'Cirurgia oral',
  'Periodontia',
];

// profissionais por tratamento
$dentistas = [
  'Ortodontia' => ['Dr. Afonso Nunes', 'Dra. Diana Figueiredo'],
  'Odontopediatria' => ['Dra. Rita Vinagreiro','Dr. Mateus Afonso'],
  'Implantes dentários' => ['Dr. Rodrigo Ferrão'],
  'Estética dental & Clareamento' => ['Dra. Iara Gomes'],
  'Check-up & Higiene oral' => ['Dr. Afonso Nunes', 'Dra. Diana Figueiredo','Dra. Rita Vinagreiro','Dr. Mateus Afonso','Dr. Rodrigo Ferrão','Dra. Iara Gomes','Dr. Tomás Moreira','Dr. Martim Ferreira','Dra. Ana Silva'],
  'Endodontia' => ['Dr. Tomás Moreira'],
  'Cirurgia oral' => ['Dr. Martim Ferreira'],
  'Periodontia' => ['Dra. Ana Silva'],
];

$clinicas = [
  'porto' => ['nome' => 'Porto', 'morada' => 'Rua do Sorriso, 12, 1º Esq. — 4000-000 Porto'],
  'lisboa' => ['nome' => 'Lisboa', 'morada' => 'Rua do Sorriso, 34 — 1000-000 Lisboa'],
  'coimbra' => ['nome' => 'Coimbra', 'morada' => 'Rua do Sorriso, 45 — 3000-000 Coimbra'],
];

function promo_ativa_por_data(string $inicio_md, string $fim_md, DateTime $hoje): bool {
  [$im, $id] = array_map('intval', explode('-', $inicio_md));
  [$fm, $fd] = array_map('intval', explode('-', $fim_md));
  $y = (int)$hoje->format('Y');

  $inicio = DateTime::createFromFormat('Y-m-d', sprintf('%04d-%02d-%02d', $y, $im, $id));
  $fim    = DateTime::createFromFormat('Y-m-d', sprintf('%04d-%02d-%02d', $y, $fm, $fd));
  if (!$inicio || !$fim) return false;

  if ($inicio <= $fim) return $hoje >= $inicio && $hoje <= $fim;

  $fim_next = DateTime::createFromFormat('Y-m-d', sprintf('%04d-%02d-%02d', $y + 1, $fm, $fd));
  $inicio_prev = DateTime::createFromFormat('Y-m-d', sprintf('%04d-%02d-%02d', $y - 1, $im, $id));
  return ($hoje >= $inicio && $hoje <= $fim_next) || ($hoje >= $inicio_prev && $hoje <= $fim);
}

$promocoes = [
  'verao-clareamento' => [
    'titulo' => 'Promo Verão — Sorriso Brilhante (-20% clareamento)',
    'tratamento' => 'Estética dental & Clareamento',
    'inicio_md' => '06-01',
    'fim_md'    => '08-31',
  ],
  'primavera-checkup' => [
    'titulo' => 'Promo Primavera — Check-up Familiar (2 pessoas)',
    'tratamento' => 'Check-up & Higiene oral',
    'inicio_md' => '03-01',
    'fim_md'    => '05-31',
  ],
  'outono-estetica' => [
    'titulo' => 'Promo Outono — Renova Sorriso (-15% estética)',
    'tratamento' => 'Estética dental & Clareamento',
    'inicio_md' => '09-01',
    'fim_md'    => '11-30',
  ],
  'inverno-endodontia' => [
    'titulo' => 'Promo Inverno — Inverno sem dor (-10% endodontia)',
    'tratamento' => 'Endodontia',
    'inicio_md' => '12-01',
    'fim_md'    => '02-28',
  ],
];

$hoje = new DateTime('today');
$promocoesAtivas = [];
foreach ($promocoes as $id => $p) {
  if (promo_ativa_por_data($p['inicio_md'], $p['fim_md'], $hoje)) $promocoesAtivas[$id] = $p;
}

function canonical_treatment(string $raw): string {
  $raw = trim($raw);
  if ($raw === '' || $raw === 'consulta') return '';
  $map = [
    'Implantes' => 'Implantes dentários',
    'Estética dental' => 'Estética dental & Clareamento',
    'Check-up' => 'Check-up & Higiene oral',
    'Higiene oral' => 'Check-up & Higiene oral',
  ];
  return $map[$raw] ?? $raw;
}

function build_slots(string $start, string $end, int $stepMin = 30): array {
  $out = [];
  $t = DateTime::createFromFormat('H:i', $start);
  $e = DateTime::createFromFormat('H:i', $end);
  if (!$t || !$e) return $out;

  while ($t < $e) {
    $out[] = $t->format('H:i');
    $t->modify("+{$stepMin} minutes");
  }
  return $out;
}

function slots_for_date(string $ymd): array {
  $d = DateTime::createFromFormat('Y-m-d', $ymd);
  if (!$d) return [];
  $dow = (int)$d->format('N'); 

  if ($dow === 7) return []; 
  if ($dow === 6) return build_slots('09:00', '13:00', 30); 
  return build_slots('09:00', '19:00', 30); 
}

$prefTrat = canonical_treatment((string)($_GET['tratamento'] ?? ($_GET['especialidade'] ?? '')));
$prefProf = trim((string)($_GET['dentista'] ?? ''));
$prefClin = trim((string)($_GET['clinica'] ?? 'porto'));
$origem = trim((string)($_GET['origem'] ?? ''));

$prefPromoRaw = trim((string)($_GET['promo'] ?? ''));
$prefPromo = isset($promocoesAtivas[$prefPromoRaw]) ? $prefPromoRaw : '';
$promoInativa = ($prefPromoRaw !== '' && $prefPromo === '');
if ($prefPromo) $prefTrat = $promocoesAtivas[$prefPromo]['tratamento'];

$errors = [];
$success = false;

$values = [
  'nome' => '',
  'email' => '',
  'telefone' => '',
  'tratamento' => $prefTrat,
  'promocao' => $prefPromo,
  'profissional' => $prefProf,
  'clinica' => in_array($prefClin, array_keys($clinicas), true) ? $prefClin : 'porto',
  'data' => '',
  'hora' => '',
  'contacto_preferido' => 'telefone',
  'mensagem' => '',
  'consent' => '',
];

if (!empty($_SESSION['user']['id']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
  try {
    $st = $pdo->prepare('SELECT nome, apelido, email, telefone FROM utentes WHERE id = ? LIMIT 1');
    $st->execute([(int)$_SESSION['user']['id']]);
    $u = $st->fetch(PDO::FETCH_ASSOC);
    if ($u) {
      $full = trim((string)$u['nome'] . ' ' . (string)$u['apelido']);
      if ($values['nome'] === '') $values['nome'] = $full;
      if ($values['email'] === '') $values['email'] = (string)$u['email'];
      if ($values['telefone'] === '') $values['telefone'] = (string)$u['telefone'];
    }
  } catch (Throwable $e) {}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tokenPost = (string)($_POST['csrf_token'] ?? '');
  $tokenSess = (string)($_SESSION['csrf_token'] ?? '');
  if ($tokenPost === '' || $tokenSess === '' || !hash_equals($tokenSess, $tokenPost)) {
    $errors['geral'] = 'Pedido inválido (CSRF). Atualiza a página e tenta novamente.';
  }

  foreach ($values as $k => $_) $values[$k] = trim((string)($_POST[$k] ?? $values[$k]));

  $values['tratamento'] = canonical_treatment($values['tratamento']);
  $values['consent'] = isset($_POST['consent']) ? '1' : '';

  // promocao — so aceita se esta ativa e correspondente ao tratamento
  $values['promocao'] = trim((string)($_POST['promocao'] ?? ''));
  if ($values['promocao'] !== '') {
    if (!isset($promocoesAtivas[$values['promocao']])) {
      $errors['promocao'] = 'A promoção selecionada já não está ativa.';
    } else {
      // força o tratamento da promoção
      $values['tratamento'] = $promocoesAtivas[$values['promocao']]['tratamento'];
    }
  }

  if (mb_strlen($values['nome']) < 3) $errors['nome'] = 'Indique o seu nome (mín. 3 caracteres).';
  if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Indique um e-mail válido.';

  $digits = preg_replace('/\D+/', '', $values['telefone']) ?? '';
  if (strlen($digits) < 9) $errors['telefone'] = 'Indique um telefone válido (mín. 9 dígitos).';

  if ($values['tratamento'] === '' || !in_array($values['tratamento'], $treatments, true)) {
    $errors['tratamento'] = 'Selecione um tipo de consulta/tratamento.';
  }


  if ($values['profissional'] === '') {
    $errors['profissional'] = 'Selecione um profissional.';
  }

  if (!isset($clinicas[$values['clinica']])) $errors['clinica'] = 'Selecione a clínica.';

  if ($values['data'] === '') {
    $errors['data'] = 'Selecione uma data preferida.';
  } else {
    $d = DateTime::createFromFormat('Y-m-d', $values['data']);
    $today = new DateTime('today');
    if (!$d) $errors['data'] = 'Data inválida.';
    elseif ($d < $today) $errors['data'] = 'A data não pode ser no passado.';
  }


  if ($values['hora'] === '') {
    $errors['hora'] = 'Selecione um horário disponível.';
  } else if ($values['data'] !== '') {
    $allowed = slots_for_date($values['data']);
    if (!in_array($values['hora'], $allowed, true)) {
      $errors['hora'] = 'Selecione um horário disponível dentro do horário de funcionamento.';
    }
  }

  if ($values['consent'] !== '1') $errors['consent'] = 'É necessário aceitar o consentimento.';

  if (!$errors) {
    try {
      $utenteId = !empty($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : 0;

      if ($utenteId <= 0) {
        // tenta encontrar pelo email, caso exista
        $stU = $pdo->prepare("SELECT id FROM utentes WHERE email = ? LIMIT 1");
        $stU->execute([$values['email']]);
        $utenteId = (int)($stU->fetchColumn() ?: 0);
      }

      if ($utenteId <= 0) {
        $errors['geral'] = 'Para guardar a consulta na base de dados, tens de iniciar sessão (ou usar um e-mail já registado).';
        $success = false;
      } else {
        // dentista_id pelo nome
        $stD = $pdo->prepare("SELECT id FROM dentistas WHERE nome = ? LIMIT 1");
        $stD->execute([$values['profissional']]);
        $dentistaId = (int)($stD->fetchColumn() ?: 0);

        if ($dentistaId <= 0) {
          $errors['profissional'] = 'Profissional inválido (não encontrado na base de dados).';
          $success = false;
        } else {
          $dataHora = $values['data'] . ' ' . $values['hora'] . ':00';

          // bloquear duplicados (mesmo dentista + data_hora)
          $stC = $pdo->prepare("
            SELECT COUNT(*)
            FROM consultas
            WHERE dentista_id = ? AND data_hora = ? AND estado <> 'cancelada'
            LIMIT 1
          ");
          $stC->execute([$dentistaId, $dataHora]);

          if ((int)$stC->fetchColumn() > 0) {
            $errors['hora'] = 'Esse dentista já tem consulta marcada nesse dia e horário.';
            $success = false;
          } else {
            $ins = $pdo->prepare("
              INSERT INTO consultas (utente_id, dentista_id, tratamento, clinica, data_hora, estado, motivo)
              VALUES (?, ?, ?, ?, ?, 'agendada', ?)
            ");
            $ins->execute([
              $utenteId,
              $dentistaId,
              $values['tratamento'],
              $values['clinica'],
              $dataHora,
              $values['mensagem'] !== '' ? $values['mensagem'] : null,
            ]);

            $success = true;
          }
        }
      }
    } catch (Throwable $e) {
      $success = false;
      $errors['geral'] = 'Erro ao guardar a consulta na base de dados: ' . $e->getMessage();
    }
  }
}

$profOptions = $dentistas[$values['tratamento']] ?? [];

$moradas = [];
foreach ($clinicas as $k => $c) $moradas[$k] = $c['morada'];

$promoToTrat = [];
$tratToPromos = [];
foreach ($promocoesAtivas as $id => $p) {
  $promoToTrat[$id] = $p['tratamento'];
  $tratToPromos[$p['tratamento']][] = ['id' => $id, 'titulo' => $p['titulo']];
}

$minDate = (new DateTime('today'))->format('Y-m-d');
$slotsInitial = ($values['data'] !== '') ? slots_for_date($values['data']) : [];

$slotsByDow = [
  1 => build_slots('09:00', '19:00', 30),
  2 => build_slots('09:00', '19:00', 30),
  3 => build_slots('09:00', '19:00', 30),
  4 => build_slots('09:00', '19:00', 30),
  5 => build_slots('09:00', '19:00', 30),
  6 => build_slots('09:00', '13:00', 30),
  7 => [],
];
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Marcação - Sorriso Premium +</title>
  <link rel="shortcut icon" href="imgs/logo_clinica.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="font-sans antialiased bg-slate-50 pt-[104px]">
  <?php require('includes/nav.php') ?>

  <section class="bg-blue-900 text-white py-16 md:py-20">
    <div class="max-w-6xl mx-auto px-4">
      <h1 class="text-2xl md:text-4xl font-bold">Marcação</h1>
      <p class="text-sky-100 mt-2 text-sm md:text-base">
        <?php if ($origem): ?>
          Vens de: <span class="font-semibold"><?php echo h($origem); ?></span>. O formulário já vem pré-preenchido quando possível.
        <?php else: ?>
          Preenche os dados e escolhe a data/horário preferidos. Entraremos em contacto para confirmar.
        <?php endif; ?>

        <?php if ($promoInativa): ?>
          <span class="block mt-2 text-amber-200 font-semibold">
            A promoção escolhida já não está ativa (fora da data). Podes marcar na mesma sem promoção.
          </span>
        <?php elseif ($values['promocao'] !== '' && isset($promocoesAtivas[$values['promocao']])): ?>
          <span class="block mt-2 text-emerald-200 font-semibold">
            Promoção aplicada: <?php echo h($promocoesAtivas[$values['promocao']]['titulo']); ?>
          </span>
        <?php endif; ?>
      </p>
    </div>
  </section>

  <main class="max-w-6xl mx-auto px-4 py-8">
    <div class="grid md:grid-cols-3 gap-6">
      <div class="md:col-span-2 bg-white rounded-2xl shadow-sm p-6">
        <?php if ($success): ?>
          <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-900">
            <div class="font-semibold">Pedido enviado!</div>
            <div class="text-sm mt-1">Consulta guardada na base de dados.</div>
          </div>
        <?php endif; ?>

        <?php if (isset($errors['geral'])): ?>
          <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-900"><?php echo h($errors['geral']); ?></div>
        <?php endif; ?>

        <form method="post" class="space-y-4">
          <input type="hidden" name="csrf_token" value="<?php echo h($_SESSION['csrf_token'] ?? ''); ?>">

          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label class="text-sm font-semibold">Nome</label>
              <input name="nome" value="<?php echo h($values['nome']); ?>" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2" />
              <?php if(isset($errors['nome'])): ?><p class="text-rose-600 text-xs mt-1"><?php echo h($errors['nome']); ?></p><?php endif; ?>
            </div>
            <div>
              <label class="text-sm font-semibold">Telefone</label>
              <input name="telefone" value="<?php echo h($values['telefone']); ?>" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2" />
              <?php if(isset($errors['telefone'])): ?><p class="text-rose-600 text-xs mt-1"><?php echo h($errors['telefone']); ?></p><?php endif; ?>
            </div>
          </div>

          <div>
            <label class="text-sm font-semibold">Email</label>
            <input name="email" value="<?php echo h($values['email']); ?>" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2" />
            <?php if(isset($errors['email'])): ?><p class="text-rose-600 text-xs mt-1"><?php echo h($errors['email']); ?></p><?php endif; ?>
          </div>

          <div class="grid md:grid-cols-3 gap-4">
            <div>
              <label class="text-sm font-semibold">Tipo de consulta / tratamento</label>
              <select id="tratamento" name="tratamento" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2">
                <option value="">Selecionar…</option>
                <?php foreach ($treatments as $t): ?>
                  <option value="<?php echo h($t); ?>" <?php echo ($values['tratamento'] === $t) ? 'selected' : ''; ?>>
                    <?php echo h($t); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <?php if(isset($errors['tratamento'])): ?><p class="text-rose-600 text-xs mt-1"><?php echo h($errors['tratamento']); ?></p><?php endif; ?>
            </div>

            <div>
              <label class="text-sm font-semibold">Promoções (ativas) (opcional)</label>
              <select id="promocao" name="promocao" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2">
                <option value="">Sem promoção</option>
              </select>
              <?php if(isset($errors['promocao'])): ?><p class="text-rose-600 text-xs mt-1"><?php echo h($errors['promocao']); ?></p><?php endif; ?>
              <p id="promo-hint" class="text-xs text-slate-500 mt-2"></p>
            </div>

            <div>
              <label class="text-sm font-semibold">Profissional (opcional)</label>
              <select id="profissional" name="profissional" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2">
                <option value="">Sem preferência</option>
                <?php foreach ($profOptions as $p): ?>
                  <option value="<?php echo h($p); ?>" <?php echo ($values['profissional'] === $p) ? 'selected' : ''; ?>>
                    <?php echo h($p); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <?php if(isset($errors['profissional'])): ?><p class="text-rose-600 text-xs mt-1"><?php echo h($errors['profissional']); ?></p><?php endif; ?>
            </div>
          </div>

          <div class="grid md:grid-cols-3 gap-4">
            <div>
              <label class="text-sm font-semibold">Clínica</label>
              <select id="clinica" name="clinica" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2">
                <?php foreach ($clinicas as $k => $c): ?>
                  <option value="<?php echo h($k); ?>" <?php echo ($values['clinica'] === $k) ? 'selected' : ''; ?>>
                    <?php echo h($c['nome']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <?php if(isset($errors['clinica'])): ?><p class="text-rose-600 text-xs mt-1"><?php echo h($errors['clinica']); ?></p><?php endif; ?>
              <p id="morada-clinica" class="text-xs text-slate-500 mt-2"></p>
            </div>

            <div>
              <label class="text-sm font-semibold">Data preferida</label>
              <input id="data" type="date" min="<?php echo h($minDate); ?>" name="data"
                     value="<?php echo h($values['data']); ?>"
                     class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2" />
              <?php if(isset($errors['data'])): ?><p class="text-rose-600 text-xs mt-1"><?php echo h($errors['data']); ?></p><?php endif; ?>
            </div>

            <div>
              <label class="text-sm font-semibold">Horário (blocos disponíveis)</label>
              <select id="hora" name="hora" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2">
                <?php if ($values['data'] === ''): ?>
                  <option value="">Seleciona a data primeiro…</option>
                <?php elseif (empty($slotsInitial)): ?>
                  <option value="">Sem horários disponíveis nessa data</option>
                <?php else: ?>
                  <option value="">Selecionar…</option>
                  <?php foreach ($slotsInitial as $t): ?>
                    <option value="<?php echo h($t); ?>" <?php echo ($values['hora'] === $t) ? 'selected' : ''; ?>>
                      <?php echo h($t); ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
              <?php if(isset($errors['hora'])): ?><p class="text-rose-600 text-xs mt-1"><?php echo h($errors['hora']); ?></p><?php endif; ?>
              <p class="text-xs text-slate-500 mt-2">2ª–6ª: 09:00–19:00 • Sáb: 09:00–13:00 • Dom: encerrado</p>
            </div>
          </div>

          <div>
            <label class="text-sm font-semibold">Observações (opcional)</label>
            <textarea name="mensagem" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2" rows="4"><?php echo h($values['mensagem']); ?></textarea>
          </div>

          <div>
            <label class="text-sm font-semibold">Preferência de contacto</label>
            <div class="mt-2 flex flex-wrap gap-4 text-sm text-slate-700">
              <label class="inline-flex items-center gap-2">
                <input type="radio" name="contacto_preferido" value="telefone" <?php echo ($values['contacto_preferido'] === 'telefone') ? 'checked' : ''; ?> />
                Telefone
              </label>
              <label class="inline-flex items-center gap-2">
                <input type="radio" name="contacto_preferido" value="email" <?php echo ($values['contacto_preferido'] === 'email') ? 'checked' : ''; ?> />
                Email
              </label>
            </div>
          </div>

          <div class="flex items-start gap-2">
            <input type="checkbox" name="consent" value="1" class="mt-1" <?php echo ($values['consent'] === '1') ? 'checked' : ''; ?> />
            <label class="text-sm text-slate-600">
              Aceito que os meus dados sejam usados apenas para o contacto relativo a este pedido.
            </label>
          </div>
          <?php if(isset($errors['consent'])): ?><p class="text-rose-600 text-xs -mt-2"><?php echo h($errors['consent']); ?></p><?php endif; ?>

          <div class="flex flex-wrap gap-3 pt-2">
            <button class="rounded-full bg-sky-500 hover:bg-sky-600 text-white px-5 py-2 font-semibold">
              Pedir marcação
            </button>
            <a href="index.php" class="rounded-full border border-slate-200 px-5 py-2 font-semibold text-slate-700 hover:bg-slate-50">
              Voltar à Home
            </a>
          </div>
        </form>
      </div>

      <aside class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="font-bold text-lg">Dica rápida</h2>
        <p class="text-sm text-slate-600 mt-2">
          Se vieres de “Corpo Clínico” ou “Tratamentos”, o tipo já vem selecionado. Podes alterar na mesma.
        </p>
      </aside>
    </div>
  </main>

  <?php require('includes/footer.php') ?>

  <script>
    (() => {
      // Moradas
      const moradas = <?php echo json_encode($moradas, JSON_UNESCAPED_UNICODE); ?>;
      const selClinica = document.getElementById('clinica');
      const moradaEl = document.getElementById('morada-clinica');
      const setAddr = () => { if (selClinica && moradaEl) moradaEl.textContent = moradas[selClinica.value] || ''; };
      selClinica?.addEventListener('change', setAddr);
      setAddr();

      // Dentistas
      const dentistas = <?php echo json_encode($dentistas, JSON_UNESCAPED_UNICODE); ?>;
      const selTrat = document.getElementById('tratamento');
      const selProf = document.getElementById('profissional');

      function rebuildProf() {
        if (!selTrat || !selProf) return;
        const current = selProf.value;
        const opts = dentistas[selTrat.value] || [];
        selProf.innerHTML = '<option value="">Sem preferência</option>';
        opts.forEach((p) => {
          const o = document.createElement('option');
          o.value = p; o.textContent = p;
          selProf.appendChild(o);
        });
        if (current && Array.from(selProf.options).some(o => o.value === current)) selProf.value = current;
      }
      selTrat?.addEventListener('change', rebuildProf);
      rebuildProf();

      // Promoções
      const promoToTrat = <?php echo json_encode($promoToTrat, JSON_UNESCAPED_UNICODE); ?>;
      const tratToPromos = <?php echo json_encode($tratToPromos, JSON_UNESCAPED_UNICODE); ?>;
      const selPromo = document.getElementById('promocao');
      const promoHint = document.getElementById('promo-hint');

      const initialPromo = <?php echo json_encode($values['promocao'], JSON_UNESCAPED_UNICODE); ?>;

      function rebuildPromo() {
        if (!selPromo || !selTrat) return;

        const trat = selTrat.value;
        const current = selPromo.value || initialPromo || '';
        const list = trat ? (tratToPromos[trat] || []) : Object.values(tratToPromos).flat();

        selPromo.innerHTML = '<option value="">Sem promoção</option>';

        list.forEach((p) => {
          const o = document.createElement('option');
          o.value = p.id;
          o.textContent = p.titulo;
          selPromo.appendChild(o);
        });

        if (trat && list.length === 0) {
          selPromo.value = '';
          selPromo.disabled = true;
          if (promoHint) promoHint.textContent = 'Este tratamento não tem promoções ativas.';
        } else {
          selPromo.disabled = false;
          if (promoHint) promoHint.textContent = (list.length ? 'Promoções disponíveis para este tratamento.' : 'Seleciona um tratamento para ver promoções.');
          if (current && Array.from(selPromo.options).some(o => o.value === current)) selPromo.value = current;
        }
      }

      selTrat?.addEventListener('change', () => {
        rebuildPromo();
        const pid = selPromo?.value || '';
        if (pid && promoToTrat[pid] && promoToTrat[pid] !== selTrat.value) selPromo.value = '';
      });

      selPromo?.addEventListener('change', () => {
        const pid = selPromo.value;
        if (pid && promoToTrat[pid]) {
          selTrat.value = promoToTrat[pid];
          rebuildProf();
          rebuildPromo();
          selPromo.value = pid;
        }
      });

      rebuildPromo();

      // Horários por blocos 
      const slotsByDow = <?php echo json_encode($slotsByDow, JSON_UNESCAPED_UNICODE); ?>;
      const inputData = document.getElementById('data');
      const selHora = document.getElementById('hora');

      function rebuildSlots() {
        if (!inputData || !selHora) return;

        const v = inputData.value;
        selHora.innerHTML = '';

        if (!v) {
          selHora.disabled = true;
          selHora.innerHTML = '<option value="">Seleciona a data primeiro…</option>';
          return;
        }

        const d = new Date(v + 'T00:00:00');
        const jsDow = d.getDay(); 
        const dow = (jsDow === 0) ? 7 : jsDow;
        const slots = slotsByDow[dow] || [];

        if (!slots.length) {
          selHora.disabled = true;
          selHora.innerHTML = '<option value="">Sem horários disponíveis nessa data</option>';
          return;
        }

        selHora.disabled = false;
        selHora.innerHTML = '<option value="">Selecionar…</option>';
        slots.forEach((t) => {
          const o = document.createElement('option');
          o.value = t; o.textContent = t;
          selHora.appendChild(o);
        });
      }

      inputData?.addEventListener('change', rebuildSlots);
      rebuildSlots();
    })();
  </script>
</body>
</html>