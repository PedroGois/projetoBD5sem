<?php
include('conexao.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pedido_id = $_GET['id'];

    // Excluir o pedido e produtos associados
    $sql_delete_itens = "DELETE FROM itens_pedido WHERE id_pedido = $pedido_id";

    if (mysqli_query($con, $sql_delete_itens)) {
        // echo "Produtos associados excluídos com sucesso.";
        $sql_delete_pedido = "DELETE FROM pedidos WHERE id = $pedido_id";

        $produto = "SELECT id_produto FROM itens_pedido WHERE id_pedido = '$pedido_id'";
        $qtde = "SELECT qtde FROM itens_pedido WHERE id_pedido = '$pedido_id'";
        $result_ped = mysqli_query($con, $produto);
        
                if ($result_ped) {
                        $sql_atualizar_estoque = "UPDATE produtos SET qtde_estoque = qtde_estoque + $qtde WHERE id = $produto";
                        if (mysqli_query($con, $sql_atualizar_estoque)) {
                            echo "Estoque atualizado com sucesso.";
        
                            } else {
                                echo "Erro ao atualizar o estoque: " . mysqli_error($con);
                                
                            }
                } else {
                    echo "Erro ao recuperar a quantidade em estoque: " . mysqli_error($con);
                    header("Location:  inserir_pedido.php");
                } 


        if (mysqli_query($con, $sql_delete_pedido)) {
            // echo "Pedido e produtos associados excluídos com sucesso.";
            header("Location:  lista_pedidos.php?msg=success");
        } else {
            // echo "Erro ao excluir o pedido: " . mysqli_error($con);
            header("Location:  lista_pedidos.php?msg=error");
        }
    } else {
        // echo "Erro ao excluir os produtos associados ao pedido: " . mysqli_error($con);
        header("Location:  lista_pedidos.php?msg=error");
    }
} else {
    // echo "ID do pedido inválido";
    header("Location:  lista_pedidos.php?msg=error");
}

mysqli_close($con);
?>
