<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../conexao.php";

$id = (int) $_GET['id'];

$stmt = $con->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$produto = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body class="center-page">

    <h1 id="editar">Editar produto</h1>

    <form class="form-card" action="atualizar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

        <label for="nome">Nome</label>
        <input id="nome" type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>

        <label for="descricao">Descrição</label>
        <input id="descricao" type="text" name="descricao" placeholder="Descrição" value="<?php echo htmlspecialchars($produto['descricao']); ?>" required>

        <label for="preco">Preço</label>
        <input id="preco" type="text" name="preco" placeholder="Preço" value="<?php echo htmlspecialchars($produto['preco']); ?>" required>

        <label for="categoria">Categoria</label>
        <input id="categoria" type="text" name="categoria" placeholder="Categoria" value="<?php echo htmlspecialchars($produto['categoria']); ?>" required>

        <label for="estoque">Estoque</label>
        <input id="estoque" type="text" name="estoque" placeholder="Estoque" value="<?php echo htmlspecialchars($produto['estoque']); ?>" required>

        <label>Imagem atual</label>
        <?php if ($produto['imagem'] != "") { ?>
            <img class="img-preview" src="../uploads/<?php echo htmlspecialchars($produto['imagem']); ?>" width="120">
        <?php } else { ?>
            <span style="color:var(--muted);font-size:0.85rem;">Sem imagem cadastrada</span>
        <?php } ?>

        <label>Nova imagem</label>
        <input type="file" name="imagem" accept=".jpg,.jpeg,.png">

        <label>Status</label>
        <select name="status">
            <option value="ativo" <?php if ($produto['status'] == 'ativo') echo 'selected'; ?>>Ativo</option>
            <option value="inativo" <?php if ($produto['status'] == 'inativo') echo 'selected'; ?>>Inativo</option>
        </select>

        <button type="submit">Atualizar produto</button>

    </form>

    <div class="form-links">
        <a href="listar.php">Voltar para lista</a>
        <a href="index.php">Menu</a>
    </div>

</body>
</html>
