<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Pedidos</title>
</head>
<body>
    <h1>Lista de Pedidos</h1>

    <table border="1" width="100%">
        <tr>
            <td><b>ID</td>
            <td><b>Data</td>
            <td><b>ID do Cliente</td>
            <td><b>Observação</td>
            <td><b>Condição de Pagamento</td>
            <td><b>Prazo de Entrega</td>
            <td><b>Ações</td>
        </tr>
        <?php
        include('conexao.php');
        $sql = "SELECT * FROM pedidos";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['data'] . "</td>";
            echo "<td>" . $row['id_cliente'] . "</td>";
            echo "<td>" . $row['observacao'] . "</td>";
            echo "<td>" . $row['cond_pagto'] . "</td>";
            echo "<td>" . $row['prazo_entrega'] . "</td>";
            echo "<td> <a href='excluir_pedido.php?id=" . $row['id'] . "'>Excluir</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p>
    <a href="inserir_pedido.php">Inserir Pedido</a>
</p>
    <p>
    <a href="index.html">Home</a>
    <?php
    mysqli_close($con);
    ?>
</body>
</html>