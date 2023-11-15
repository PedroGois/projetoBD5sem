<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto = $_POST["produto"];
    $data = $_POST["data"];
    $id_cliente = $_POST["id_cliente"];
    $observacao = $_POST["observacao"];
    $cond_pagto = $_POST["cond_pagto"];
    $prazo_entrega = $_POST["prazo_entrega"];
    $qtde = $_POST["qtde"];

    // Verifique se o cliente com o id_cliente fornecido existe na tabela clientes
    $check_cliente_query = "SELECT * FROM clientes WHERE id = $id_cliente";
    $result_cliente = mysqli_query($con, $check_cliente_query);

    // Verifique se o produto selecionado existe na tabela produtos
    $check_produto_query = "SELECT * FROM produtos WHERE id = $produto";
    $result_produto = mysqli_query($con, $check_produto_query);

    if (mysqli_num_rows($result_cliente) > 0 && mysqli_num_rows($result_produto) > 0) {
        $sql = "INSERT INTO pedidos (data, id_cliente, observacao, cond_pagto, prazo_entrega)
                VALUES ('$data', $id_cliente, '$observacao', '$cond_pagto', '$prazo_entrega')";

        if (mysqli_query($con, $sql)) {
            $id_pedido = mysqli_insert_id($con);

            // Inserindo o item do pedido na tabela itens_pedido
            $sql_itens = "INSERT INTO itens_pedido (id_pedido, id_produto, qtde)
                        VALUES ($id_pedido, $produto, $qtde)";

            if (mysqli_query($con, $sql_itens)) {
                echo "Pedido e item inseridos com sucesso!";
            } else {
                echo "Erro na inserção do item do pedido: " . mysqli_error($con);
            }
        } else {
            echo "Erro na inserção do pedido: " . mysqli_error($con);
        }
    } else {
        echo "Cliente ou produto com o ID especificado não existe na tabela de clientes ou produtos.";
    }
}
?>