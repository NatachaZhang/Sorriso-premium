<?php
declare(strict_types=1);



if (session_status() === PHP_SESSION_NONE) {
  $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');

  
  session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'httponly' => true,
    'secure' => $secure,
    'samesite' => 'Lax',
  ]);

  session_start();
}

if (empty($_SESSION['csrf_token'])) {
  try {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  } catch (Throwable $e) {
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
  }
}

date_default_timezone_set('Europe/Lisbon');
