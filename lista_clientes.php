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

        <!-- Botão de voltar -->
        <p><a href="lista_clientes.php">Voltar para Lista de Clientes</a></p>
        <h1>Lista de Clientes</h1>

        <!-- Formulário de filtro por nome e cidade -->
        <form method="GET" action="lista_clientes.php">
            <label for="filtro_nome">Filtrar por Nome:</label>
            <input type="text" name="filtro_nome" id="filtro_nome">

            <label for="filtro_cidade">Filtrar por Cidade:</label>
            <input type="text" name="filtro_cidade" id="filtro_cidade">

            <button type="submit">Filtrar</button>
        </form>

         <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Email</th>
                <th>CPF/CNPJ</th>
                <th>RG</th>
                <th>Telefone</th>
                <th>Celular</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
            <?php
            include('conexao.php');

            // Inicializar a consulta SQL base
            $sql = "SELECT * FROM clientes";

            // Adicionar filtros se foram fornecidos
            if(isset($_GET['filtro_nome']) && !empty($_GET['filtro_nome'])) {
                $filtro_nome = $_GET['filtro_nome'];
                $sql .= " WHERE nome LIKE '%$filtro_nome%'";
            }

            if(isset($_GET['filtro_cidade']) && !empty($_GET['filtro_cidade'])) {
                $filtro_cidade = $_GET['filtro_cidade'];
                $sql .= (isset($filtro_nome) ? " AND" : " WHERE") . " cidade LIKE '%$filtro_cidade%'";
            }

            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

            // Verificar se foram encontrados clientes
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['endereco'] . "</td>";
                    echo "<td>" . $row['numero'] . "</td>";
                    echo "<td>" . $row['bairro'] . "</td>";
                    echo "<td>" . $row['cidade'] . "</td>";
                    echo "<td>" . $row['estado'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['cpf_cnpj'] . "</td>";
                    echo "<td>" . $row['rg'] . "</td>";
                    echo "<td>" . $row['telefone'] . "</td>";
                    echo "<td>" . $row['celular'] . "</td>";
                    echo "<td>" . $row['data_nasc'] . "</td>";
                    echo "<td>
                          <a href='editar_cliente.php?id=" . $row['id'] . "'>Editar</a> | <a href='excluir_cliente.php?id=" . $row['id'] . "'>Excluir</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                // Mensagem caso nenhum cliente seja encontrado
                echo "<tr><td colspan='14'>Nenhum cliente encontrado com os filtros informados.</td></tr>";
            }
            ?>
        </table>

        <p>
            <form method="POST" action="CadCliUsu.php">
                <input type="submit" value="Novo Cliente">
            </form>
        </p>


        <?php
        mysqli_close($con);
        ?>
    </div>
</body>
</html>
