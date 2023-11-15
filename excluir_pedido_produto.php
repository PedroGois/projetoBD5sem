<?php
include('conexao.php');

if (isset($_GET['pedido_id']) && is_numeric($_GET['pedido_id'])) {
    $pedido_id = $_GET['pedido_id'];

    // Excluir o pedido e produtos associados
    $sql_delete_itens = "DELETE FROM itens_pedido WHERE id_pedido = $pedido_id";

    if (mysqli_query($con, $sql_delete_itens)) {
        $sql_delete_pedido = "DELETE FROM pedidos WHERE id = $pedido_id";

        if (mysqli_query($con, $sql_delete_pedido)) {
            echo "Pedido e produtos associados excluídos com sucesso.";
        } else {
            echo "Erro ao excluir o pedido: " . mysqli_error($con);
        }
    } else {
        echo "Erro ao excluir os produtos associados ao pedido: " . mysqli_error($con);
    }
} elseif (isset($_GET['produto_id']) && is_numeric($_GET['produto_id'])) {
    $produto_id = $_GET['produto_id'];

    // Excluir o produto e seu pedido associado
    $sql_delete_pedido_produto = "DELETE FROM itens_pedido WHERE id_produto = $produto_id";

    if (mysqli_query($con, $sql_delete_pedido_produto)) {
        $sql_delete_produto = "DELETE FROM produtos WHERE id = $produto_id";

        if (mysqli_query($con, $sql_delete_produto)) {
            echo "Produto e pedido associado excluídos com sucesso.";
        } else {
            echo "Erro ao excluir o produto: " . mysqli_error($con);
        }
    } else {
        echo "Erro ao excluir o pedido associado ao produto: " . mysqli_error($con);
    }
} else {
    echo "ID do pedido ou produto inválido";
}

mysqli_close($con);
?>
