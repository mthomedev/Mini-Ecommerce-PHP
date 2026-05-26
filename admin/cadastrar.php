<?php include "../conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto</title>
    <link rel="stylesheet" href="cadastrar.css">
</head>
<body>
    <h1 id="cadastrar">Cadastrar produto</h1>
    <form action="salvar.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Nome"><br>
        <input type="text" name="descricao" placeholder="Descrição"><br>
        <input type="text" name="preco" placeholder="Preço"><br>
        <input type="text" name="categoria" placeholder="Categoria"><br>
        <input type="number" name="estoque" placeholder="Estoque"><br>
        <input type="file" name="imagem" accept="image/*"><br><br>

        <label>Status</label><br>
        <select name="status">
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
        </select><br><br>

        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="listar.php">Ver produtos cadastrados</a>
    <a href="index.php" style="margin-left:10px">Menu</a>
</body>
</html>
