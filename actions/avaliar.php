<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../index.php#avaliacoes');
  exit;
}

// So utentes logados podem avaliar
if (empty($_SESSION['user']['id'])) {
  $_SESSION['avaliacao_flash'] = 'Para avaliar, faz login primeiro.';
  header('Location: ../login.php');
  exit;
}


$tokenPost = (string)($_POST['csrf_token'] ?? '');
$tokenSess = (string)($_SESSION['csrf_token'] ?? '');
if ($tokenPost === '' || $tokenSess === '' || !hash_equals($tokenSess, $tokenPost)) {
  $_SESSION['avaliacao_flash'] = 'Pedido inválido (CSRF). Tenta novamente.';
  header('Location: ../index.php#avaliacoes');
  exit;
}

$utenteId = (int)$_SESSION['user']['id'];
$consultaId = (int)($_POST['consulta_id'] ?? 0);
$rating = (int)($_POST['rating'] ?? 0);
$comentario = trim((string)($_POST['comentario'] ?? ''));

if ($consultaId <= 0 || $rating < 1 || $rating > 5) {
  $_SESSION['avaliacao_flash'] = 'Preenche a consulta e a classificação (1 a 5).';
  header('Location: ../index.php#avaliacoes');
  exit;
}

// Verifica se a consulta e do utente e ja foi realizada
$stmt = $pdo->prepare("SELECT id FROM consultas WHERE id = ? AND utente_id = ? AND estado = 'realizada' AND data_hora < NOW() LIMIT 1");
$stmt->execute([$consultaId, $utenteId]);
$ok = $stmt->fetch();
if (!$ok) {
  $_SESSION['avaliacao_flash'] = 'Essa consulta não pode ser avaliada.';
  header('Location: ../index.php#avaliacoes');
  exit;
}

// Evita duplicados
$stmt = $pdo->prepare('SELECT id FROM avaliacoes WHERE consulta_id = ? LIMIT 1');
$stmt->execute([$consultaId]);
if ($stmt->fetch()) {
  $_SESSION['avaliacao_flash'] = 'Essa consulta já foi avaliada.';
  header('Location: ../index.php#avaliacoes');
  exit;
}

$ins = $pdo->prepare('INSERT INTO avaliacoes (utente_id, consulta_id, rating, comentario) VALUES (?,?,?,?)');
$ins->execute([$utenteId, $consultaId, $rating, $comentario]);

$_SESSION['avaliacao_flash'] = 'Obrigado! A tua avaliação foi enviada.';
header('Location: ../index.php#avaliacoes');
exit;
