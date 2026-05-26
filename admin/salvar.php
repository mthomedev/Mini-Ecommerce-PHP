<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit;
}

include "../conexao.php";

// valida inputs
$nome = trim($_POST['nome']);
$descricao = trim($_POST['descricao']);
$preco = (float) $_POST['preco'];
$categoria = trim($_POST['categoria']);
$estoque = (int) $_POST['estoque'];

$status = $_POST['status'] === 'inativo'
    ? 'inativo'
    : 'ativo';

// pasta upload
$destino = "../uploads/";

if (!is_dir($destino)) {

    mkdir($destino, 0777, true);
}

// valida upload
if (
    !isset($_FILES['imagem']) ||
    $_FILES['imagem']['error'] != 0
) {

    die("Erro no upload da imagem.");
}

// extensões permitidas
$permitidos = ['jpg', 'jpeg', 'png'];

$extensao = strtolower(
    pathinfo(
        $_FILES['imagem']['name'],
        PATHINFO_EXTENSION
    )
);

if (!in_array($extensao, $permitidos)) {

    die("Formato de imagem inválido.");
}

// valida MIME
$finfo = finfo_open(FILEINFO_MIME_TYPE);

$mime = finfo_file(
    $finfo,
    $_FILES['imagem']['tmp_name']
);

$mimesPermitidos = [
    'image/jpeg',
    'image/png'
];

if (!in_array($mime, $mimesPermitidos)) {

    die("Arquivo inválido.");
}

// nome seguro
$imagem = uniqid() . "." . $extensao;

$tmp = $_FILES['imagem']['tmp_name'];

if (
    !move_uploaded_file(
        $tmp,
        $destino . $imagem
    )
) {

    die("Erro ao fazer upload.");
}

// INSERT seguro
$stmt = $con->prepare("
    INSERT INTO produtos (
        nome,
        descricao,
        preco,
        categoria,
        estoque,
        imagem,
        status
    )
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssdssss",
    $nome,
    $descricao,
    $preco,
    $categoria,
    $estoque,
    $imagem,
    $status
);

$stmt->execute();

header("Location: listar.php");

exit;