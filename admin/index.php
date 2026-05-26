<?php
include "../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Painel Admin</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1 id="title">Painel Administrativo</h1>
</header>
<hr>

<main>
<div class="produtos">
<h3>Produtos</h3>

<ul>

<li>
<a href="cadastrar.php">Cadastrar produto</a>
</li>

<li>
<a href="listar.php">Listar produtos</a>
</li>

</ul>

</div>

<hr>
<div class="loja">
<h3>Loja</h3>

<a href="../loja/index.php">Ver loja</a>
</div>
</main>
</body>
</html>