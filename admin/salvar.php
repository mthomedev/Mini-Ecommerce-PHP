<?php
include "../conexao.php";

$nome      = mysqli_real_escape_string($con, $_POST['nome']);
$descricao = mysqli_real_escape_string($con, $_POST['descricao']);
$preco     = mysqli_real_escape_string($con, $_POST['preco']);
$categoria = mysqli_real_escape_string($con, $_POST['categoria']);
$estoque   = (int) $_POST['estoque'];
$status    = $_POST['status'] === 'inativo' ? 'inativo' : 'ativo';

$destino = "../uploads/";

if (!is_dir($destino)) {
    mkdir($destino, 0777, true);
}

$imagem = basename($_FILES['imagem']['name']);
$tmp    = $_FILES['imagem']['tmp_name'];

if (!move_uploaded_file($tmp, $destino . $imagem)) {
    die("Erro ao fazer upload da imagem.");
}

$sql = "INSERT INTO produtos (nome, descricao, preco, categoria, estoque, imagem, status)
        VALUES ('$nome','$descricao','$preco','$categoria','$estoque','$imagem','$status')";

mysqli_query($con, $sql);

header("Location: listar.php");
exit;
