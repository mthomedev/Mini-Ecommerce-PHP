<?php

function limparTexto($texto) {
    return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
}

function formatarPreco($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

function gerarNomeImagem($nomeOriginal) {
    $ext = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
    return uniqid('produto_', true) . '.' . strtolower($ext);
}

?>
