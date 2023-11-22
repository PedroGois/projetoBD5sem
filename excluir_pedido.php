<?php
include('conexao.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pedido_id = $_GET['id'];

    // Excluir o pedido e produtos associados
    $sql_delete_itens = "DELETE FROM itens_pedido WHERE id_pedido = $pedido_id";

   // Consultar o item do pedido para atualização do estoque
    $consulta_item = "SELECT id_produto, qtde FROM itens_pedido WHERE id_pedido = $pedido_id ";
    $result_item = mysqli_query($con, $consulta_item);

    if ($result_item && mysqli_num_rows($result_item) > 0) {
        $row = mysqli_fetch_assoc($result_item);
        $id_produto = $row['id_produto'];
        $qtde = $row['qtde'];

        // Atualizar estoque para o produto específico
        $sql_atualizar_estoque = "UPDATE produtos SET qtde_estoque = qtde_estoque + $qtde WHERE id = $id_produto";
        if (mysqli_query($con, $sql_atualizar_estoque)) {
            echo "Estoque do produto $id_produto atualizado com sucesso.<br>";
        } else {
            echo "Erro ao atualizar o estoque do produto $id_produto: " . mysqli_error($con) . "<br>";
        }
    } else {
        echo "Erro ao recuperar o item do pedido ou não foi encontrado nenhum item.<br>";
        header("Location: inserir_pedido.php");
        exit(); // Encerrar o script após redirecionamento
    }

        if (mysqli_query($con, $sql_delete_itens )) {
            // echo "Pedido e produtos associados excluídos com sucesso.";
            $sql_delete_pedido = "DELETE FROM pedidos WHERE id = $pedido_id";
            if (mysqli_query($con, $sql_delete_pedido)) {
                mysqli_commit($con); // Commit se tudo foi executado com sucesso
                header("Location: lista_pedidos.php?msg=success");
                exit();
            } else {
                mysqli_rollback($con); // Reverter alterações se houver um erro
                echo "Erro ao excluir o pedido: " . mysqli_error($con) . "<br>";
            }
            header("Location:  lista_pedidos.php?msg=success");
        } else {
            // echo "Erro ao excluir o pedido: " . mysqli_error($con);
            header("Location:  lista_pedidos.php?msg=error");
        }
    
} else {
    // echo "ID do pedido inválido";
    header("Location:  lista_pedidos.php?msg=error");
}

mysqli_close($con);
?>
