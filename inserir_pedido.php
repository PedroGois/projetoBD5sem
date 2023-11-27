<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inserir Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #007BFF;
        }
        form {
            text-align: left;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        select,
        input[type="number"],
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
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
            font-size: 16px;
            margin-top: 10px;
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
        // Executando a query para selecionar os produtos
        $sql2 = "SELECT id, nome FROM clientes";
        $resultcli = $con->query($sql2);
 
        ?>
 
        <form action="processaPedido.php" method="POST">
            <label for="id_cliente">Selecione um Cliente:</label>
            <select name="id_cliente" id="id_cliente">
                <?php
                if ($resultcli->num_rows > 0) {
                    while ($row = $resultcli->fetch_assoc()) {
                        echo '<option value="' . $row["id"] . '">' . $row["nome"] . '</option>';
                    }
                } else {
                    echo "Nenhum cliente encontrado na tabela.";
                }
 
                ?>
            </select>
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
                $con->close();
                ?>
            </select>
            <label for="qtde">Quantidade:</label>
            <input type="number" name="qtde" required>
            <br>    
            <hr>
            <label for="data">Data do Pedido:</label>
            <input type="date" name="data" required><br>
 
            <label for="observacao">Observação:</label>
            <input type="text" name="observacao"><br>
 
            <label for="cond_pagto">Condição de Pagamento:</label>
            <select name="cond_pagto" id="cond_pagto" required>
                <option value="avista">À vista</option>
                <option value="aprazo">A prazo</option>
                <option value="credito_debito">Crédito/Débito</option>
                <option value="pix">Pix</option>
            </select><br>
 
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