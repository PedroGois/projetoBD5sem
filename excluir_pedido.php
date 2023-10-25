<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Excluir Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Excluir Pedido</h1>

        <?php
        include('conexao.php');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM pedidos WHERE id=$id";

            if (mysqli_query($con, $sql)) {
                echo "<p>Pedido excluído com sucesso!</p>";
            } else {
                echo "<p>Erro na exclusão do pedido: " . mysqli_error($con) . "</p>";
            }
        }
        ?>

        <p>
            <a href="lista_pedidos.php">Voltar para Lista de Pedidos</a>
        </p>
    </div>
</body>
</html>