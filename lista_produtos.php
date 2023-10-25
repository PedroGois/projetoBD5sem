<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Produtos</title>
</head>
<body>
    <h1>Lista de Produtos</h1>

    <table border="1" width="100%">
        <tr>
            <td><b>ID</td>
            <td><b>Nome</td>
            <td><b>Quantidade em Estoque</td>
            <td><b>Valor Unitário</td>
            <td><b>Unidade de Medida</td>
            <td><b>Ações</td>
        </tr>
        <?php
        include('conexao.php');
        $sql = "SELECT * FROM produtos";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['qtde_estoque'] . "</td>";
            echo "<td>" . $row['valor_unitario'] . "</td>";
            echo "<td>" . $row['unidade_medida'] . "</td>";
            echo "<td><a href='editar_produto.php?id=" . $row['id'] . "'>Editar</a> | <a href='excluir_produto.php?id=" . $row['id'] . "'>Excluir</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p>
    <a href="inserir_produto.php">Inserir Produto</a>
    </p>
    <p>
    <a href="index.html">Home</a>
    <?php
    mysqli_close($con);
    ?>
</body>
</html>