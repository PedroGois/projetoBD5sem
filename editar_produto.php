<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Editar Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            text-align: center;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
    <meta charset="utf-8">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>

    <?php
    include('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $qtde_estoque = $_POST["qtde_estoque"];
        $valor_unitario = $_POST["valor_unitario"];
        $unidade_medida = $_POST["unidade_medida"];

        $sql = "UPDATE produtos SET nome='$nome', qtde_estoque=$qtde_estoque, valor_unitario=$valor_unitario, unidade_medida='$unidade_medida' WHERE id=$id";

        if (mysqli_query($con, $sql)) {
            echo "Produto atualizado com sucesso!";
        } else {
            echo "Erro na atualização do produto: " . mysqli_error($con);
        }
    } elseif (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM produtos WHERE id=$id";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $row = mysqli_fetch_array($result);
    }
    ?>

    <form action="editar_produto.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nome">Nome do Produto:</label>
        <input type="text" name="nome" value="<?php if(isset($row)){echo $row['nome'];}else{ echo ' ';} ?>" required><br>

        <label for="qtde_estoque">Quantidade em Estoque:</label>
        <input type="number" name="qtde_estoque" value="<?php echo $row['qtde_estoque']; ?>" required><br>

        <label for="valor_unitario">Valor Unitário:</label>
        <input type="text" name="valor_unitario" value="<?php if(isset($row)){echo $row['valor_unitario'];}else{ echo ' ';} ?>" required><br>

        <label for="unidade_medida">Unidade de Medida:</label>
        <input type="text" name="unidade_medida" value="<?php if(isset($row)){echo $row['unidade_medida'];}else{ echo ' ';} ?>" required><br>

        <input type="submit" value="Salvar Alterações">
    </form>

    <p>
        <a href="lista_produtos.php">Voltar para Lista de Produtos</a>
    </p>

    <?php
    mysqli_close($con);
    ?>
</body>
</html>