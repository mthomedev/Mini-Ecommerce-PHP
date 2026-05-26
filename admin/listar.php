<?php
include "../conexao.php";

$busca = "";
if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];
}
if ($busca == "") {
    $sql = "SELECT * FROM produtos";
} else {
    $sql = "SELECT * FROM produtos WHERE nome LIKE '%$busca%' ";
}
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <link rel="stylesheet" href="listar.css">

</head>
<body>
    <header>
    <h2 id="title">Produtos Cadastrados</h2>
    <a id="novo" href="cadastrar.php">Novo produto</a>
    <a href="index.php" id="menu">Menu</a>
    </header>
    <br><br>
    <main>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Estoque</th>
            <th>Imagem</th>
            <th>Status</th>
            <th>Ação</th>
        </tr>
        <?php while ($linha = mysqli_fetch_assoc($result)) { ?>

            <tr>
                 <td><?php echo $linha['id']; ?></td>
                 <td><?php echo $linha['nome']; ?></td>
                 <td><?php echo $linha['descricao']; ?></td>    
                 <td><?php echo $linha['preco']; ?></td>
                 <td><?php echo $linha['categoria']; ?></td>
                 <td><?php echo $linha['estoque']; ?></td>
                 <td>
                 <img src="../uploads/<?php echo $linha['imagem']; ?>" width="80">
                 </td>
                 <td><?php echo $linha['status']; ?></td>
                 <td>
                    <a href="editar.php?id=<?php echo $linha['id']; ?>">Editar</a>
                    <a href="excluir.php?id=<?php echo $linha['id']; ?>"
                    onclick="return confirm('deseja realmente excluir')">
                    Excluir
                </a>
                 </td> 
            </tr>
        <?php }?>
    </table>  
    </main> 

    <footer>
    <form method="get" action="">
        <input id="searchBusca" type="text" name="busca" placeholder="Digite o nome"
         value="<?php echo $busca; ?>">
         <button id="btnBusca" type="submit">Buscar</button>
    </form>
    </footer>
</body>
</html>