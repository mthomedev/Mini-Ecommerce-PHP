<?php

$host = getenv('DB_HOST') ?: 'mysql';
$usuario = getenv('DB_USER') ?: 'root';
$senha = getenv('DB_PASS') ?: 'root';
$banco = getenv('DB_NAME') ?: 'mini_ecommerce';

$con = mysqli_connect($host, $usuario, $senha, $banco);

if (!$con) {
    die("Erro ao conectar no banco.");
}