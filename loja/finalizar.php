<?php

session_start();

require_once __DIR__ . "/../conexao.php";

/* ───────── VALIDA CARRINHO ───────── */

if (
    !isset($_POST['produtos']) ||
    empty($_POST['produtos'])
) {

    ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Carrinho vazio • Rock Pulse</title>

    <link
        rel="icon"
        href="../imgs/favicon.png"
        sizes="any"
        type="image/svg+xml"
    >
    <link
        rel="icon"
        href="../imgs/favicon.png"
        sizes="any"
        type="image/svg+xml"
    >
    <link
        rel="stylesheet"
        href="/loja/style.css"
    >

</head>

<body>

<div class="checkout-container">

    <div class="checkout-box empty-cart-box fade-in">

        <div class="empty-cart-icon">
            🛒
        </div>

        <span class="checkout-status">
            Carrinho vazio
        </span>

        <h1 class="checkout-title">
            Nenhum produto selecionado
        </h1>

        <p class="checkout-subtitle">

            Você precisa adicionar produtos ao carrinho
            antes de finalizar sua compra.

        </p>

        <div class="checkout-actions">

            <a
                href="index.php"
                class="checkout-btn"
            >

                Explorar produtos

            </a>

        </div>

    </div>

</div>

</body>
</html>

<?php

    exit;
}

/* ───────── PROCESSAR COMPRA ───────── */

$produtos = $_POST['produtos'];

$totalCompra = 0;

$totalItens = 0;

$erros = [];

$itensComprados = [];

foreach ($produtos as $id) {

    $id = (int)$id;

    if (
        !isset($_SESSION['carrinho'][$id]) ||
        $_SESSION['carrinho'][$id] <= 0
    ) {
        continue;
    }

    $quantidade = (int)$_SESSION['carrinho'][$id];

    $sql = "
        SELECT
            id,
            nome,
            preco,
            estoque,
            imagem
        FROM produtos
        WHERE id = $id
        LIMIT 1
    ";

    $result = mysqli_query($con, $sql);

    if (
        !$result ||
        mysqli_num_rows($result) === 0
    ) {

        $erros[] = "Produto inválido.";

        continue;
    }

    $produto = mysqli_fetch_assoc($result);

    if ($quantidade > $produto['estoque']) {

        $erros[] =
            "Estoque insuficiente para \"" .
            htmlspecialchars($produto['nome']) .
            "\".";

        continue;
    }

    $novoEstoque =
        $produto['estoque'] - $quantidade;

    $update = "
        UPDATE produtos
        SET estoque = $novoEstoque
        WHERE id = $id
    ";

    mysqli_query($con, $update);

    $subtotal =
        $produto['preco'] * $quantidade;

    $totalCompra += $subtotal;

    $totalItens += $quantidade;

    $itensComprados[] = [

        "nome" => $produto['nome'],

        "imagem" => $produto['imagem'],

        "quantidade" => $quantidade,

        "subtotal" => $subtotal

    ];

    unset($_SESSION['carrinho'][$id]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Compra Finalizada • Rock Pulse</title>

    <link
        rel="stylesheet"
        href="/loja/style.css"
    >

</head>

<body>

<div class="checkout-container">

    <div class="checkout-box fade-in">

        <?php if (empty($erros)): ?>

            <div class="checkout-success-icon">
                ✓
            </div>

            <span class="checkout-status success">
                Pedido confirmado
            </span>

            <h1 class="checkout-title">
                Compra finalizada!
            </h1>

            <p class="checkout-subtitle">

                Seu pedido foi processado com sucesso.
                Obrigado por comprar na Rock Pulse.

            </p>

            <div class="checkout-summary">

                <div class="checkout-summary-item">

                    <span>
                        Produtos
                    </span>

                    <strong>
                        <?php echo $totalItens; ?>
                    </strong>

                </div>

                <div class="checkout-summary-item">

                    <span>
                        Status
                    </span>

                    <strong class="status-success">
                        Pago
                    </strong>

                </div>

            </div>

            <div class="checkout-total-box">

                <p class="checkout-total-label">
                    Total da compra
                </p>

                <h2 class="checkout-total-value">

                    R$
                    <?php
                    echo number_format(
                        $totalCompra,
                        2,
                        ',',
                        '.'
                    );
                    ?>

                </h2>

            </div>

            <?php if (!empty($itensComprados)): ?>

                <div class="checkout-products">

                    <?php foreach ($itensComprados as $item): ?>

                        <div class="checkout-product">

                            <img
                                src="../uploads/<?php echo htmlspecialchars($item['imagem']); ?>"
                                alt="<?php echo htmlspecialchars($item['nome']); ?>"
                            >

                            <div class="checkout-product-info">

                                <h3>
                                    <?php echo htmlspecialchars($item['nome']); ?>
                                </h3>

                                <p>

                                    Quantidade:
                                    <?php echo $item['quantidade']; ?>

                                </p>

                            </div>

                            <span class="checkout-product-price">

                                R$
                                <?php
                                echo number_format(
                                    $item['subtotal'],
                                    2,
                                    ',',
                                    '.'
                                );
                                ?>

                            </span>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        <?php else: ?>

            <div class="empty-cart-icon error">
                !
            </div>

            <span class="checkout-status error">
                Erro ao finalizar
            </span>

            <h1 class="checkout-title">
                Alguns problemas aconteceram
            </h1>

            <p class="checkout-subtitle">

                Alguns produtos não puderam
                ser processados corretamente.

            </p>

            <div class="checkout-errors">

                <?php foreach ($erros as $erro): ?>

                    <div class="checkout-error">
                        <?php echo $erro; ?>
                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

        <div class="checkout-actions">

            <a
                href="index.php"
                class="checkout-btn"
            >

                Voltar para loja

            </a>

        </div>

    </div>

</div>

</body>
</html>