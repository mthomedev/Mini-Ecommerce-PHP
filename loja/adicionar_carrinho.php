<?php

session_start();
include "../conexao.php";

header('Content-Type: application/json');

if (!isset($_POST['id']) || $_POST['id'] == "") {

    echo json_encode([
        "success" => false,
        "message" => "Produto inválido"
    ]);

    exit;
}

$id = (int) $_POST['id'];
$qtd = (int) $_POST['quantidade'];

$sql = "SELECT estoque FROM produtos WHERE id = $id";

$result = mysqli_query($con, $sql);

$produto = mysqli_fetch_assoc($result);

if (!$produto) {

    echo json_encode([
        "success" => false,
        "message" => "Produto não encontrado"
    ]);

    exit;
}

$estoque = (int)$produto['estoque'];

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$qtdCarrinho = $_SESSION['carrinho'][$id] ?? 0;

$novaQtd = $qtdCarrinho + $qtd;

if ($novaQtd > $estoque) {

    echo json_encode([
        "success" => false,
        "message" => "Quantidade maior que o estoque disponível!"
    ]);

    exit;
}

$_SESSION['carrinho'][$id] = $novaQtd;

$totalCarrinho = array_sum($_SESSION['carrinho']);

echo json_encode([
    "success" => true,
    "message" => "Produto adicionado ao carrinho!",
    "cartCount" => $totalCarrinho
]);