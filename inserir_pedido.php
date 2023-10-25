<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inserir Pedido</title>
</head>
<body>
    <h1>Inserir Pedido</h1>

    <?php
    include('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST["data"];
        $id_cliente = $_POST["id_cliente"];
        $observacao = $_POST["observacao"];
        $cond_pagto = $_POST["cond_pagto"];
        $prazo_entrega = $_POST["prazo_entrega"];

        $sql = "INSERT INTO pedidos (data, id_cliente, observacao, cond_pagto, prazo_entrega)
                VALUES ('$data', $id_cliente, '$observacao', '$cond_pagto', '$prazo_entrega')";

        if (mysqli_query($con, $sql)) {
            echo "Pedido inserido com sucesso!";
        } else {
            echo "Erro na inserção do pedido: " . mysqli_error($con);
        }
    }
    ?>

    <form action="inserir_pedido.php" method="POST">
        <label for="data">Data do Pedido:</label>
        <input type="date" name="data" required><br>

        <label for="id_cliente">ID do Cliente:</label>
        <input type="number" name="id_cliente" required><br>

        <label for="observacao">Observação:</label>
        <input type="text" name="observacao"><br>

        <label for="cond_pagto">Condição de Pagamento:</label>
        <input type="text" name="cond_pagto" required><br>

        <label for="prazo_entrega">Prazo de Entrega:</label>
        <input type="text" name="prazo_entrega"><br>

        <input type="submit" value="Inserir Pedido">
    </form>

    <p>
        <a href="lista_pedidos.php">Voltar para Lista de Pedidos</a>
    </p>

    <?php
    mysqli_close($con);
    ?>
</body>
</html>