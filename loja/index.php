<?php
session_start();
include "../conexao.php";

$qtdCarrinho = 0;

if (isset($_SESSION['carrinho'])) {
    $qtdCarrinho = array_sum($_SESSION['carrinho']);
}

$busca = "";

if (isset($_GET['busca'])) {
    $busca = mysqli_real_escape_string($con, $_GET['busca']);
}

if ($busca == "") {

    $sql = "SELECT * FROM produtos 
            WHERE status='ativo' 
            AND estoque > 0";

} else {

    $sql = "SELECT * FROM produtos 
            WHERE status='ativo' 
            AND estoque > 0 
            AND nome LIKE '%$busca%'";
}

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Rock Pulse</title>

    <link
        rel="icon"
        href="../imgs/favicon.png"
        sizes="any"
        type="image/svg+xml"
    >

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

<header>

    <nav>

        <a href="index.php" class="logo-link">

            <img
                src="../imgs/logo.png"
                alt="Rock Pulse"
                id="logo"
            >

        </a>

        <form method="GET" class="search-form">

            <input
                type="text"
                name="busca"
                placeholder="Pesquisar produtos..."
                class="search-input"
                value="<?php echo htmlspecialchars($busca); ?>"
            >

            <button type="submit" class="search-btn">
                Buscar
            </button>

        </form>

        <a
            href="#"
            class="cart"
            id="cart-btn"
        >

            <img
                src="https://img.icons8.com/?size=100&id=59997&format=png&color=ffffff"
                alt="Carrinho"
                id="cart-img"
            >

            <?php if ($qtdCarrinho > 0): ?>

                <span class="cart-badge">
                    <?php echo $qtdCarrinho; ?>
                </span>

            <?php endif; ?>

        </a>

    </nav>

    <section id="top">

        <div class="hero-content">

            <span class="hero-tag">
                Premium Music Gear
            </span>

            <h1 id="title">
                Unleash Your Sound.
            </h1>

            <h3 id="subt">
                Premium Guitars & Musical Gear
            </h3>

            <div class="hero-buttons">

                <a href="#produtos" id="explore">
                    Explorar
                </a>

                <a href="#categorias" class="hero-secondary-btn">
                    Categorias
                </a>

            </div>

        </div>

    </section>

</header>

<main>

    <section class="abas" id="categorias">

        <div id="aba-electric" class="aba">

            <div class="aba-img">

                <img
                    src="https://static.vecteezy.com/system/resources/previews/001/207/359/non_2x/electric-guitar-png.png"
                    alt="Guitarra elétrica"
                >

            </div>

            <h3>Elétricas</h3>

            <button class="vertd">
                Ver tudo
            </button>

        </div>

        <div id="aba-acoustic" class="aba">

            <div class="aba-img">

                <img
                    src="https://cdn.awsli.com.br/2500x2500/2469/2469270/produto/321353493/2x_0009_rx207acnc_img_7785-cnyki3hmoc.png"
                    alt="Violão"
                >

            </div>

            <h3>Acústico</h3>

            <button class="vertd">
                Ver tudo
            </button>

        </div>

        <div id="aba-amplifier" class="aba">

            <div class="aba-img">

                <img
                    src="https://s3.wasabisys.com/michael.smserver.com.br/stagepro-g30-30w-guitarra_57e5.png"
                    alt="Amplificador"
                >

            </div>

            <h3>Amps & Pedais</h3>

            <button class="vertd">
                Ver tudo
            </button>

        </div>

    </section>

    <div class="section-title-wrapper">

        <h3 id="produto-title">
            Produtos em alta
        </h3>

        <p class="section-subtitle">
            Equipamentos selecionados para músicos exigentes.
        </p>

    </div>

    <section class="produtos" id="produtos">

        <?php if (mysqli_num_rows($result) > 0): ?>

            <?php while ($linha = mysqli_fetch_assoc($result)) { ?>

                <div class="produto">

                    <div class="produto-image-wrapper">

                        <img
                            src="../uploads/<?php echo htmlspecialchars($linha['imagem']); ?>"
                            alt="<?php echo htmlspecialchars($linha['nome']); ?>"
                            id="img-produto"
                        >

                    </div>

                    <div class="produto-info">

                        <h2>
                            <?php echo htmlspecialchars($linha['nome']); ?>
                        </h2>

                        <p>
                            <?php echo htmlspecialchars($linha['descricao']); ?>
                        </p>

                    </div>

                    <div class="comprar">

                        <div class="price-stock">

                            <h3>
                                R$ <?php echo number_format($linha['preco'], 2, ',', '.'); ?>
                            </h3>

                            <span class="stock-info">

                                <?php echo $linha['estoque']; ?>
                                em estoque

                            </span>

                        </div>

                        <form
                            class="cart-form"
                        >

                            <input
                                type="hidden"
                                name="id"
                                value="<?php echo $linha['id']; ?>"
                            >

                            <input
                                type="number"
                                id="quant"
                                name="quantidade"
                                value="1"
                                min="1"
                                max="<?php echo $linha['estoque']; ?>"
                            >

                            <button
                                type="submit"
                                class="addtocart"
                            >

                                Adicionar

                            </button>

                        </form>

                    </div>

                </div>

            <?php } ?>

        <?php else: ?>

            <div class="empty-products">

                <h2>
                    Nenhum produto encontrado
                </h2>

                <p>
                    Tente pesquisar outro termo.
                </p>

            </div>

        <?php endif; ?>

    </section>

</main>

<div id="toast">
    Produto adicionado ao carrinho
</div>

<!-- SIDEBAR -->

<div id="cart-overlay"></div>

<aside id="cart-sidebar">

    <div class="cart-header">

        <h2>
            Seu Carrinho
        </h2>

        <button id="close-cart">
            ✕
        </button>

    </div>

    <div
        class="cart-content"
        id="cart-content"
    >

        <p class="empty-cart">
            Carregando carrinho...
        </p>

    </div>

</aside>

<script src="script.js"></script>

</body>
</html>