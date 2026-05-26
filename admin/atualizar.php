<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../conexao.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$categoria = $_POST['categoria'];
$estoque = $_POST['estoque'];
$status = $_POST['status'];

$imagem = $_FILES['imagem']['name'];

if ($imagem != "" && $_FILES['imagem']['error'] == 0) {

    $imagem = time() . "_" . $imagem;
    $tmp = $_FILES['imagem']['tmp_name'];

    move_uploaded_file($tmp, "../uploads/".$imagem);

    $sql = "UPDATE produtos SET
    nome='$nome',
    descricao='$descricao',
    preco='$preco',
    categoria='$categoria',
    estoque='$estoque',
    status='$status',
    imagem='$imagem'
    WHERE id=$id";

} else {

    $sql = "UPDATE produtos SET
    nome='$nome',
    descricao='$descricao',
    preco='$preco',
    categoria='$categoria',
    estoque='$estoque',
    status='$status'
    WHERE id=$id";

}

mysqli_query($con, $sql);

header("Location: listar.php");
