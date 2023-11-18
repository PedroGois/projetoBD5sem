<?php
include('conexao.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pedido_id = $_GET['id'];

    // Excluir o pedido e produtos associados
    $sql_delete_itens = "DELETE FROM itens_pedido WHERE id_pedido = $pedido_id";

    if (mysqli_query($con, $sql_delete_itens)) {
        echo "Produtos associados excluídos com sucesso.";
        $sql_delete_pedido = "DELETE FROM pedidos WHERE id = $pedido_id";

        if (mysqli_query($con, $sql_delete_pedido)) {
            echo "Pedido e produtos associados excluídos com sucesso.";
        } else {
            echo "Erro ao excluir o pedido: " . mysqli_error($con);
        }
    } else {
        echo "Erro ao excluir os produtos associados ao pedido: " . mysqli_error($con);
    }
} else {
    echo "ID do pedido inválido";
}

mysqli_close($con);
?>
