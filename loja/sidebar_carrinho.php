<?php
session_start();
include "../conexao.php";

if (
    !isset($_SESSION['carrinho']) ||
    empty($_SESSION['carrinho'])
) {
    echo '
        <p class="empty-cart">
            Seu carrinho está vazio.
        </p>
    ';
    exit;
}

$total = 0;

foreach ($_SESSION['carrinho'] as $id => $quantidade) {

    // Sanitização de ambas as variáveis
    $id = (int)$id;
    $quantidade = (int)$quantidade; 

    // Ignora o item se a quantidade for inválida (zero ou negativa)
    if ($quantidade <= 0) {
        continue;
    }

    $sql = "SELECT * FROM produtos WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if (!$result || mysqli_num_rows($result) === 0) {
        continue;
    }

    $produto = mysqli_fetch_assoc($result);
    $subtotal = $produto['preco'] * $quantidade;
    $total += $subtotal;
?>

    <div class="sidebar-item">

        <img
            src="../uploads/<?php echo htmlspecialchars($produto['imagem']); ?>"
            alt="<?php echo htmlspecialchars($produto['nome']); ?>"
        >

        <div class="sidebar-item-info">
            <h3>
                <?php echo htmlspecialchars($produto['nome']); ?>
            </h3>
            <p>
                Quantidade: <?php echo $quantidade; ?>
            </p>
            <span>
                R$ <?php echo number_format($subtotal, 2, ",", "."); ?>
            </span>
        </div>

        <div class="sidebar-item-actions">
            <button
                class="remove-from-cart-btn"
                data-id="<?php echo $id; ?>"
            >
                Remover
            </button>
        </div>

    </div>
    <?php
} // FECHAMENTO DO FOREACH AQUI!
?>

<div class="sidebar-cart-footer">
    
    <div class="sidebar-total">
        <strong>Total: R$ <?php echo number_format($total, 2, ",", "."); ?></strong>
    </div>

    <a href="carrinho.php" class="sidebar-cart-btn">
        Ver Carrinho
    </a>
    
</div>