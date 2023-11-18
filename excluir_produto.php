<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Excluir Produto</title>
</head>
<body>
    <h1>Excluir Produto</h1>

    <?php
    include('conexao.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM produtos WHERE id=$id";

        if (mysqli_query($con, $sql)) {
            echo "Produto excluído com sucesso!";
            header("Location:  lista_produtos.php?msg=success");

        } else {
            echo "Erro na exclusão do produto: " . mysqli_error($con);
            header("Location:  lista_produtos.php?msg=error");
        }
    }
    ?>

    <p>
        <a href="lista_produtos.php">Voltar para Lista de Produtos</a>
    </p>

    <?php
    mysqli_close($con);
    ?>
</body>
</html>