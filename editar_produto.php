<!DOCTYPE html>
<html>
<head>
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