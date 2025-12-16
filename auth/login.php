<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../login.php');
  exit;
}


$tokenPost = $_POST['csrf_token'] ?? '';
$tokenSess = $_SESSION['csrf_token'] ?? '';
if ($tokenPost === '' || $tokenSess === '' || !hash_equals($tokenSess, $tokenPost)) {
  $_SESSION['login_error'] = 'Pedido inválido (CSRF). Tenta novamente.';
  header('Location: ../login.php');
  exit;
}

$email = trim((string)($_POST['fEmail'] ?? ''));
$pass  = trim((string)($_POST['fPassword'] ?? ''));

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $pass === '') {
  $_SESSION['login_error'] = 'Preenche um email válido e a palavra-passe.';
  header('Location: ../login.php');
  exit;
}

$stmt = $pdo->prepare('SELECT id, email, password, nome, apelido FROM utentes WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
  $_SESSION['login_error'] = 'Email ou palavra-passe incorretos.';
  header('Location: ../login.php');
  exit;
}

$stored = (string)$user['password'];

$ok = false;
if (strpos($stored, '$2y$') === 0 || strpos($stored, '$argon2') === 0) {
  $ok = password_verify($pass, $stored);
} else {
  $ok = hash_equals($stored, $pass);

  
  if ($ok) {
    $newHash = password_hash($pass, PASSWORD_DEFAULT);
    $upd = $pdo->prepare('UPDATE utentes SET password = ? WHERE id = ?');
    $upd->execute([$newHash, (int)$user['id']]);
  }
}

if (!$ok) {
  $_SESSION['login_error'] = 'Email ou palavra-passe incorretos.';
  header('Location: ../login.php');
  exit;
}

$_SESSION['user'] = [
  'id'      => (int)$user['id'],
  'email'   => (string)$user['email'],
  'nome'    => (string)$user['nome'],
  'apelido' => (string)$user['apelido'],
];

unset($_SESSION['login_error']);

header('Location: ../index.php');
exit;