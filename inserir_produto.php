<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inserir Produto</title>
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
        input[type="text"],
        input[type="number"] {
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
        <h1>Inserir Produto</h1>

        <?php
        include('conexao.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST["nome"];
            $qtde_estoque = $_POST["qtde_estoque"];
            $valor_unitario = $_POST["valor_unitario"];
            $unidade_medida = $_POST["unidade_medida"];

            $sql_produto = "INSERT INTO produtos (nome, qtde_estoque, valor_unitario, unidade_medida)
                            VALUES ('$nome', $qtde_estoque, $valor_unitario, '$unidade_medida')";

            if (mysqli_query($con, $sql_produto)) {
                // Obter o ID do produto recém-inserido
                $produto_id = mysqli_insert_id($con);

                // Verifica se um pedido foi passado por parâmetro na URL
                if (isset($_GET['pedido_id'])) {
                    $pedido_id = $_GET['pedido_id'];

                    // Insere um vínculo entre o pedido e o produto na tabela itens_pedido
                    $sql_itens_pedido = "INSERT INTO itens_pedido (id_pedido, id_produto, qtde)
                                        VALUES ($pedido_id, $produto_id, $qtde_estoque)";

                    if (mysqli_query($con, $sql_itens_pedido)) {
                        echo "Produto inserido com sucesso e associado ao pedido!";
                    } else {
                        echo "Erro ao inserir o item do pedido: " . mysqli_error($con);
                    }
                } else {
                    echo "Produto inserido com sucesso, mas não associado a nenhum pedido.";
                }
            } else {
                echo "Erro na inserção do produto: " . mysqli_error($con);
            }
        }
        ?>

        <form action="inserir_produto.php" method="POST">
            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" required><br>

            <label for="qtde_estoque">Quantidade em Estoque:</label>
            <input type="number" name="qtde_estoque" required><br>

            <label for="valor_unitario">Valor Unitário:</label>
            <input type="text" name="valor_unitario" required><br>

            <label for="unidade_medida">Unidade de Medida:</label>
            <input type="text" name="unidade_medida" required><br>

            <input type="submit" value="Inserir Produto">
        </form>

        <p>
            <a href="lista_produtos.php">Voltar para Lista de Produtos</a>
        </p>
    </div>
</body>
</html>
