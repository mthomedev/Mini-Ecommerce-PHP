<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<?php

include "../conexao.php";

$id = $_GET['id'];

$sql = "DELETE FROM produtos WHERE id = $id";

mysqli_query($con, $sql);

header("Location: listar.php");
