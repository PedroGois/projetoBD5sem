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
                
                $sql_quantidade_estoque = "SELECT qtde_estoque FROM produtos WHERE id = '$produto'";
                $result_quantidade = mysqli_query($con, $sql_quantidade_estoque);
        
                if ($result_quantidade) {
                    $row = mysqli_fetch_assoc($result_quantidade);
                    $qtde_estoque = $row['qtde_estoque'];
                    // Verificar se há estoque suficiente
                    if ( $qtde <= $qtde_estoque) {
                        // Atualizar a quantidade no estoque
                        $sql_atualizar_estoque = "UPDATE produtos SET qtde_estoque = qtde_estoque - $qtde WHERE id = '$produto'";
                        if (mysqli_query($con, $sql_atualizar_estoque)) {
                            echo "Estoque atualizado com sucesso.";
        
                            } else {
                                echo "Erro ao atualizar o estoque: " . mysqli_error($con);
                                
                            }
                    } else {
        
                        echo "Quantidade insuficiente em estoque.". mysqli_error($con);
                        header("Location:  inserir_pedido.php");
                        }
                } else {
                    echo "Erro ao recuperar a quantidade em estoque: " . mysqli_error($con);
                    header("Location:  inserir_pedido.php");
                } 

                echo "Pedido e item inseridos com sucesso!";
                header("Location:  lista_pedidos.php");
                exit;
            } else {
                echo "Erro na inserção do item do pedido: " . mysqli_error($con);
                header("Location:  inserir_pedido.php");
            }
        } else {
            echo "Erro na inserção do pedido: " . mysqli_error($con);
            header("Location:  inserir_pedido.php");
        }
    } else {
        echo "Cliente ou produto com o ID especificado não existe na tabela de clientes ou produtos.";
        header("Location:  inserir_pedido.php");
        
    }

} 

?>



?>