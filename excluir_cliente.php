<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Excluir CLiente</title>
</head>
<body>
    <h1>Excluir Cliente</h1>

    <?php
    include('conexao.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM clientes WHERE id=$id";

        if (mysqli_query($con, $sql)) {
            echo "Cliente excluído com sucesso!";
        } else {
            echo "Erro na exclusão do Cliente: " . mysqli_error($con);
        }
    }
    ?>

    <p>
        <a href="lista_clientes.php">Voltar para Lista de Clientes</a>
    </p>

    <?php
    mysqli_close($con);
    ?>
</body>
</html>