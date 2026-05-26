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
    <title>Novo Produto</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body class="center-page">

    <h1 id="cadastrar">Cadastrar produto</h1>

    <form class="form-card" action="salvar.php" method="post" enctype="multipart/form-data">

        <label>Nome</label>
        <input type="text" name="nome" placeholder="Nome do produto" maxlength="100" required>

        <label>Descrição</label>
        <input type="text" name="descricao" placeholder="Descrição breve" maxlength="255" required>

        <label>Preço</label>
        <input type="number" step="0.01" name="preco" placeholder="0,00" required>

        <label>Categoria</label>
        <input type="text" name="categoria" placeholder="Ex: Camisetas" maxlength="50" required>

        <label>Estoque</label>
        <input type="number" name="estoque" placeholder="Quantidade" min="0" required>

        <label>Imagem</label>
        <input type="file" name="imagem" accept=".jpg,.jpeg,.png" required>

        <label>Status</label>
        <select name="status">
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
        </select>

        <button type="submit">Salvar produto</button>

    </form>

    <div class="form-links">
        <a href="listar.php">Ver produtos</a>
        <a href="index.php">Menu</a>
    </div>

</body>
</html>
