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
        $consulta_item = "SELECT id_cliente FROM pedidos WHERE id_cliente = $id ";
        $result_item = mysqli_query($con, $consulta_item);

        if ($result_item && mysqli_num_rows($result_item) > 0) {
            echo "Já existe um pedido para este cliente";
            header("Location:  lista_pedidos.php?msg=errorcliente");
            exit();
        }else{
            $sql = "DELETE FROM login_usuarios WHERE id_cliente=$id";
            if (mysqli_query($con, $sql)) {
                echo "Login excluído com sucesso!";
                $sql2 = "DELETE FROM clientes WHERE id=$id";
                if (mysqli_query($con, $sql2)) {
                    echo "Cliente excluído com sucesso!";
                }else{
                    echo "Erro na exclusão do Cliente: " . mysqli_error($con);
                }
            } else {
                echo "Erro na exclusão do Login: " . mysqli_error($con);
            }
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