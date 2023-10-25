<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inserir Produto</title>
</head>
<body>
    <h1>Inserir Produto</h1>

    <?php
    include('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $qtde_estoque = $_POST["qtde_estoque"];
        $valor_unitario = $_POST["valor_unitario"];
        $unidade_medida = $_POST["unidade_medida"];

        $sql = "INSERT INTO produtos (nome, qtde_estoque, valor_unitario, unidade_medida)
                VALUES ('$nome', $qtde_estoque, $valor_unitario, '$unidade_medida')";

        if (mysqli_query($con, $sql)) {
            echo "Produto inserido com sucesso!";
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

    <?php
    mysqli_close($con);
    ?>
</body>
</html>