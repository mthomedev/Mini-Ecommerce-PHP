<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>
    <h1 id="title">Painel Administrativo</h1>
</header>

<main>
    <div class="card-grid">

        <div class="card">
            <h3>Produtos</h3>
            <ul>
                <li><a href="cadastrar.php">Cadastrar produto</a></li>
                <li><a href="listar.php">Listar produtos</a></li>
                <li><a href="logout.php" class="logout">Sair</a></li>
            </ul>
        </div>

        <div class="card">
            <h3>Loja</h3>
            <ul>
                <li><a href="../loja/index.php">Ver loja</a></li>
            </ul>
        </div>

    </div>
</main>

</body>
</html>
