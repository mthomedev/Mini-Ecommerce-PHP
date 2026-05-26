<?php

session_start();

$usuarioCorreto = "admin";

// gera hash da senha
$hashSenha = '$2y$10$ZIsF5upNUPkUGy1F1YO1tOEFhXgwXrKXGVX9b5KcGRKsvAxwGwiZW';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    if (
        $usuario === $usuarioCorreto &&
        password_verify($senha, $hashSenha)
    ) {

        session_regenerate_id(true);

        $_SESSION['admin'] = true;

        header("Location: index.php");
        exit;
    }

    $erro = "Usuário ou senha inválidos";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body class="center-page">

    <h1 id="login-title">Painel Admin</h1>

    <form class="form-card" method="POST">

        <label for="usuario">Usuário</label>
        <input
            id="usuario"
            type="text"
            name="usuario"
            placeholder="admin"
            required
        >

        <label for="senha">Senha</label>
        <input
            id="senha"
            type="password"
            name="senha"
            placeholder="••••••••"
            required
        >

        <button type="submit">Entrar</button>

        <?php if (isset($erro)) { ?>
            <p class="error-msg"><?php echo htmlspecialchars($erro); ?></p>
        <?php } ?>

    </form>

</body>
</html>
