<?php

session_start();

// limpa variáveis da sessão
$_SESSION = [];

// destrói cookie da sessão
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// destrói sessão
session_destroy();

// redireciona
header("Location: login.php");

exit;
?>

<link rel="stylesheet" href="style.css">
