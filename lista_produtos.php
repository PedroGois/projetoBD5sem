<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        a {
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Produtos</h1>

        <!-- Formulário de filtro por nome do produto -->
        <form method="GET" action="lista_produtos.php">
            <label for="filtro_nome">Filtrar por Nome do Produto:</label>
            <input type="text" name="filtro_nome" id="filtro_nome">
            <button type="submit">Filtrar</button>
        </form>

        <?php
        include('conexao.php');

        if (isset($_GET['msg'])) {
            $message = $_GET['msg'];
        
            if ($message === "success") {
                echo "Ação concluída com sucesso.";
            } elseif ($message === "error") {
                echo "Houve um erro ao realizar a ação.";
            }
        }

        // Inicializar a consulta SQL base
        $sql = "SELECT * FROM produtos";

        // Adicionar filtro por nome se fornecido
        if(isset($_GET['filtro_nome']) && !empty($_GET['filtro_nome'])) {
            $filtro_nome = $_GET['filtro_nome'];
            $sql .= " WHERE nome LIKE '%$filtro_nome%'";
        }

        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        // Verificar se foram encontrados produtos
        if(mysqli_num_rows($result) > 0) {
        ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Quantidade em Estoque</th>
                    <th>Valor Unitário</th>
                    <th>Unidade de Medida</th>
                    <th>Ações</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['qtde_estoque'] . "</td>";
                    echo "<td>" . $row['valor_unitario'] . "</td>";
                    echo "<td>" . $row['unidade_medida'] . "</td>";
                    echo "<td><a href='editar_produto.php?id=" . $row['id'] . "'>Editar</a> | <a href='excluir_produto.php?id=" . $row['id'] . "'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        <?php
        } else {
            // Mensagem caso nenhum produto seja encontrado
            echo "<p>Nenhum produto encontrado com o filtro informado.</p>";
        }
        ?>

        <p>
            <a href="inserir_produto.php">Inserir Produto</a>
        </p>
        <p>
            <a href="dashboard.php">Home</a>
        </p>
        <?php
        mysqli_close($con);
        ?>
    </div>
</body>
</html>
