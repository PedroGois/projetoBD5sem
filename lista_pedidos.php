<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Pedidos</title>
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
        <h1>Lista de Pedidos</h1>

        <!-- Formulário de filtro por período -->
        <form method="GET" action="lista_pedidos.php">
            <label for="filtro_inicio">Início do Período:</label>
            <input type="date" name="filtro_inicio" id="filtro_inicio">

            <label for="filtro_fim">Fim do Período:</label>
            <input type="date" name="filtro_fim" id="filtro_fim">

            <button type="submit">Filtrar</button>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>ID do Cliente</th>
                <th>Nome do Cliente</th>
                <th>Observação</th>
                <th>Condição de Pagamento</th>
                <th>Prazo de Entrega</th>
                <th>Ações</th>
            </tr>
            <?php
            include('conexao.php');
            if (isset($_GET['msg'])) {
                $message = $_GET['msg'];
                if ($message === "success") {
                    echo "Exclusão concluída com sucesso.";
                } elseif ($message === "error") {
                    echo "Houve um erro ao realizar a exclusão.";
                }
            }

            // Inicializar a consulta SQL base
            $sql = "SELECT pedidos.*, clientes.nome AS nome_cliente
                    FROM pedidos
                    INNER JOIN clientes ON pedidos.id_cliente = clientes.id";

            // Adicionar filtro por período se fornecido
            if(isset($_GET['filtro_inicio']) && isset($_GET['filtro_fim'])) {
                $filtro_inicio = $_GET['filtro_inicio'];
                $filtro_fim = $_GET['filtro_fim'];
                $sql .= " WHERE pedidos.data BETWEEN '$filtro_inicio' AND '$filtro_fim'";
            }

            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['data'] . "</td>";
                echo "<td>" . $row['id_cliente'] . "</td>";
                echo "<td>" . $row['nome_cliente'] . "</td>";
                echo "<td>" . $row['observacao'] . "</td>";
                echo "<td>" . $row['cond_pagto'] . "</td>";
                echo "<td>" . $row['prazo_entrega'] . "</td>";
                echo "<td><a href='excluir_pedido.php?id=" . $row['id'] . "'>Excluir</a></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <p>
            <a href="inserir_pedido.php">Inserir Pedido</a>
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
