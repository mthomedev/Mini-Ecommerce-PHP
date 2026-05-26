<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit;
}

include "../conexao.php";

// valida ID
$id = (int) $_GET['id'];

// prepared statement
$stmt = $con->prepare(
    "DELETE FROM produtos WHERE id = ?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: listar.php");
exit;