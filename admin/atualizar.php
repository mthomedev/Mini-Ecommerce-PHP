<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit;
}

include "../conexao.php";

$id = (int) $_POST['id'];

$nome = trim($_POST['nome']);
$descricao = trim($_POST['descricao']);
$preco = (float) $_POST['preco'];
$categoria = trim($_POST['categoria']);
$estoque = (int) $_POST['estoque'];
$status = trim($_POST['status']);

if (!empty($_FILES['imagem']['name']) && $_FILES['imagem']['error'] == 0) {

    // extensões permitidas
    $permitidos = ['jpg', 'jpeg', 'png'];

    $extensao = strtolower(
        pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION)
    );

    if (!in_array($extensao, $permitidos)) {

        die("Formato de imagem inválido.");
    }

    // valida MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    $mime = finfo_file($finfo, $_FILES['imagem']['tmp_name']);

    $mimesPermitidos = ['image/jpeg', 'image/png'];

    if (!in_array($mime, $mimesPermitidos)) {

        die("Arquivo inválido.");
    }

    // nome seguro
    $imagem = uniqid() . "." . $extensao;

    $tmp = $_FILES['imagem']['tmp_name'];

    move_uploaded_file($tmp, "../uploads/" . $imagem);

    // UPDATE seguro
    $stmt = $con->prepare("
        UPDATE produtos SET
        nome = ?,
        descricao = ?,
        preco = ?,
        categoria = ?,
        estoque = ?,
        status = ?,
        imagem = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "ssdssssi",
        $nome,
        $descricao,
        $preco,
        $categoria,
        $estoque,
        $status,
        $imagem,
        $id
    );

} else {

    // UPDATE sem imagem
    $stmt = $con->prepare("
        UPDATE produtos SET
        nome = ?,
        descricao = ?,
        preco = ?,
        categoria = ?,
        estoque = ?,
        status = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "ssdsssi",
        $nome,
        $descricao,
        $preco,
        $categoria,
        $estoque,
        $status,
        $id
    );
}

$stmt->execute();

header("Location: listar.php");
exit;