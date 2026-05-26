<?php

session_start();
include "../conexao.php";

$carrinho = $_SESSION['carrinho'] ?? [];

$total = 0;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Carrinho</title>
<link
    rel="icon"
    href="../imgs/favicon.png"
    sizes="any"
    type="image/svg+xml"
>
<link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
<img src="../imgs/logo.png" id="logo">
<a href="index.php" class="voltar-loja">Voltar para loja</a>
</nav>

<div class="carrinho-container">

<h1>Seu Carrinho</h1>

<form action="finalizar.php" method="post">

<?php

foreach ($carrinho as $id => $quantidade) {

    $sql = "SELECT * FROM produtos WHERE id = $id";
    $result = mysqli_query($con, $sql);
    $produto = mysqli_fetch_assoc($result);

    if (!$produto) {
        continue;
    }

    $subtotal = $produto['preco'] * $quantidade;
    $total += $subtotal;
    ?>

<div class="item-carrinho">

<input type="checkbox" name="produtos[]" value="<?php echo $id; ?>">

<img src="../uploads/<?php echo $produto['imagem']; ?>">

<div class="item-info">

<h3><?php echo $produto['nome']; ?></h3>

<p>Preço: R$ <?php echo $produto['preco']; ?></p>

<p>Quantidade: <?php echo $quantidade; ?></p>

<p>Subtotal: R$ <?php echo $subtotal; ?></p>

</div>

<div class="item-actions">

<a class="remover" href="remover_carrinho.php?id=<?php echo $id; ?>">
Remover
</a>

</div>

</div>

<?php } ?>

<div class="total-carrinho">

<h2>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></h2>

<button class="finalizar-btn" type="submit">
Finalizar Compra
</button>

</div>

</form>

</div>

</body>
</html>