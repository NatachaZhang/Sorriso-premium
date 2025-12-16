<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../criar_conta.php');
  exit;
}


function fail(string $msg, array $old, bool $clearTel = false): void {
  $_SESSION['signup_error'] = $msg;

  if ($clearTel) {
    $old['fTelemovel'] = '';
  }

  $_SESSION['signup_old'] = $old;

  header('Location: ../criar_conta.php');
  exit;
}


$tokenPost = (string)($_POST['csrf_token'] ?? '');
$tokenSess = (string)($_SESSION['csrf_token'] ?? '');
if ($tokenPost === '' || $tokenSess === '' || !hash_equals($tokenSess, $tokenPost)) {
  fail('Pedido inválido (CSRF). Tenta novamente.', []);
}

$email = trim((string)($_POST['fEmail'] ?? ''));
$pass  = (string)($_POST['fPassword'] ?? '');
$pass2 = (string)($_POST['fConfirmPassword'] ?? '');
$nome  = trim((string)($_POST['fNome'] ?? ''));
$apel  = trim((string)($_POST['fApelido'] ?? ''));
$telRaw = trim((string)($_POST['fTelemovel'] ?? ''));   
$dn    = trim((string)($_POST['fDataNascimento'] ?? ''));

$old = [
  'fNome' => $nome,
  'fApelido' => $apel,
  'fDataNascimento' => $dn,
  'fTelemovel' => $telRaw,
  'fEmail' => $email,
];

// validações
if (mb_strlen($nome) < 2 || mb_strlen($apel) < 2) {
  fail('Indica nome e apelido (mín. 2 caracteres).', $old);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  fail('Indica um e-mail válido.', $old);
}

if (mb_strlen($pass) < 8) {
  fail('A palavra-passe deve ter pelo menos 8 caracteres.', $old);
}

if ($pass !== $pass2) {
  fail('As palavras-passe não coincidem.', $old);
}

$d = DateTime::createFromFormat('Y-m-d', $dn);
if (!$d) {
  fail('Data de nascimento inválida.', $old);
}

// telefone: aceita "912345678", "912 345 678", "+351912345678", "+351 912 345 678"
$digits = preg_replace('/\D+/', '', $telRaw) ?? '';
if (strlen($digits) === 12 && str_starts_with($digits, '351')) {
  $digits = substr($digits, 3);
}

if (strlen($digits) !== 9) {
  fail('Indica um número de telemóvel válido (9 dígitos).', $old, true);
}

// Email unico
$chk = $pdo->prepare('SELECT id FROM utentes WHERE email = ? LIMIT 1');
$chk->execute([$email]);
if ($chk->fetch()) {
  $_SESSION['signup_error'] = 'Já existe uma conta com esse email. Faz login.';
  header('Location: ../login.php');
  exit;
}

// inserir
$hash = password_hash($pass, PASSWORD_DEFAULT);
$ins = $pdo->prepare('INSERT INTO utentes (email, password, nome, apelido, telefone, data_nascimento) VALUES (?,?,?,?,?,?)');
$ins->execute([$email, $hash, $nome, $apel, $digits, $dn]);

$id = (int)$pdo->lastInsertId();

// auto-login
$_SESSION['user'] = [
  'id' => $id,
  'email' => $email,
  'nome' => $nome,
  'apelido' => $apel,
];

unset($_SESSION['signup_error'], $_SESSION['signup_old']);

header('Location: ../index.php');
exit;