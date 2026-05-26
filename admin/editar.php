<?php

include "../conexao.php";

$id = $_GET['id'];

$sql = "SELECT * FROM produtos WHERE id = $id";

$resultado = mysqli_query($con, $sql);

$produto = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
    <h2>Editar Produto</h2>

    <form action="atualizar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
        <br><br>

        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" placeholder="Descrição" value="<?php echo htmlspecialchars($produto['descricao']); ?>" required>
        <br><br>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" placeholder="Preço" value="<?php echo htmlspecialchars($produto['preco']);?>" required>
        <br><br>

        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" placeholder="Categoria" value="<?php echo htmlspecialchars($produto['categoria']);?>" required>
        <br><br>

        <label for="estoque">Estoque</label>
        <input type="text" name="estoque" placeholder="Estoque" value="<?php echo htmlspecialchars($produto['estoque']); ?>" required>
        <br><br>

        <label>Imagem atual:</label><br>

        <?php if ($produto['imagem'] != "") { ?>
            <img src="../uploads/<?php echo $produto['imagem']; ?>" width="120">
        <?php } else { ?>
            Sem imagem cadastrada
        <?php } ?>
        <br><br>

        <label>Nova imagem:</label>
        <input type="file" name="imagem"><br><br>

        <label>Status:</label>

<select name="status">

<option value="ativo" <?php if ($produto['status'] == 'ativo') {
    echo 'selected';
} ?>>
Ativo
</option>

<option value="inativo" <?php if ($produto['status'] == 'inativo') {
    echo 'selected';
} ?>>
Inativo
</option>

</select>

<br><br>
        
        <button type="submit">Atualizar</button>
    </form>

    <br>
    <a href="listar.php">Voltar para lista</a>
</body>
</html>