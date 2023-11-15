<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inserir Pedido</title>
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
        form {
            text-align: left;
        }
        label {
            font-weight: bold;
        }
        input[type="date"],
        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inserir Pedido</h1>

        
        <?php
        $servidor='localhost';
        $usuario='root';
        $senha='';
        $db='restaurante';
        $con = mysqli_connect($servidor,$usuario,$senha,$db);
        // Verificando a conexão
        if ($con->connect_error) {
            die("Erro na conexão: " . $con->connect_error);
        }

        // Executando a query para selecionar os produtos
        $sql = "SELECT id, nome FROM produtos";
        $result = $con->query($sql);

        ?>

        <form action="processaPedido.php" method="POST">
            <label for="produto">Selecione um produto:</label>
            <select name="produto" id="produto">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["id"] . '">' . $row["nome"] . '</option>';
                    }
                } else {
                    echo "Nenhum produto encontrado na tabela.";
                }

                // Fechando a conexão após usar os resultados
                $con->close();
                ?>
            </select>
            <label for="qtde">Quantidade:</label>
            <input type="number" name="qtde" required>
            <br>    
            <hr>
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
    </div>
</body>
</html>
