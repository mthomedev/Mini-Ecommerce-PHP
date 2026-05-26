<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../conexao.php";

$busca = "";

if (isset($_GET['busca'])) {
    $busca = trim($_GET['busca']);
}

if ($busca == "") {
    $stmt = $con->prepare("SELECT * FROM produtos");
} else {
    $stmt = $con->prepare("SELECT * FROM produtos WHERE nome LIKE ?");
    $termo = "%" . $busca . "%";
    $stmt->bind_param("s", $termo);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <header>
        <h2 id="title">Produtos Cadastrados</h2>
        <a id="novo" href="cadastrar.php">Novo produto</a>
        <a id="menu" href="index.php">Menu</a>
    </header>

    <main>
        <table>
            <thead>
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
            </thead>
            <tbody>
            <?php while ($linha = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($linha['id']); ?></td>
                    <td><?php echo htmlspecialchars($linha['nome']); ?></td>
                    <td><?php echo htmlspecialchars($linha['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($linha['preco']); ?></td>
                    <td><?php echo htmlspecialchars($linha['categoria']); ?></td>
                    <td><?php echo htmlspecialchars($linha['estoque']); ?></td>
                    <td>
                        <img src="../uploads/<?php echo htmlspecialchars($linha['imagem']); ?>" width="80">
                    </td>
                    <td><?php echo htmlspecialchars($linha['status']); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo htmlspecialchars($linha['id']); ?>">Editar</a>
                        <a href="excluir.php?id=<?php echo htmlspecialchars($linha['id']); ?>"
                           onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </main>

    <footer>
        <form class="search-form" method="get" action="">
            <input id="searchBusca" type="text" name="busca" placeholder="Buscar por nome"
                   value="<?php echo htmlspecialchars($busca); ?>">
            <button id="btnBusca" type="submit">Buscar</button>
        </form>
    </footer>

</body>
</html>
