<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Clientes</title>
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
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">

    <p><a href="dashboard.php">Home</a></p>

        <h1>Lista de de itens pedidos</h1>

         <table>
            <tr>
                <th>Nome</th>
                <th>Qtde em Pedido</th>
            </tr>
            <?php
            include('conexao.php');

            // Inicializar a consulta SQL base
            $sql = "SELECT p.nome as nome, sum(ip.qtde) as qtde FROM itens_pedido ip INNER JOIN produtos p on ip.id_produto = p.id group by nome";

            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['qtde'] . "</td>";
                    echo "</tr>";
                }
            } else {
                // Mensagem caso nenhum cliente seja encontrado
                echo "<tr><td colspan='14'>Nenhum cliente encontrado com os filtros informados.</td></tr>";
            }
            ?>
        </table>

        <p>
            <form method="POST" action="dashboard.php">
                <input type="submit" value="Voltar ao Dashboard">
            </form>
        </p>


        <?php
        mysqli_close($con);
        ?>
    </div>
</body>
</html>
