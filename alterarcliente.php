<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>

    <table border="1" width="100%">
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
        $sql = "SELECT * FROM clientes";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
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
                  <a href='editar_cliente.php?id=" . $row['id'] . "'>Editar</a> | 
                  <a href='delete_cliente.html?id=" . $row['id'] . "'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p>
    <form method="POST" action="InserirCliente.html">
        <input type="submit" value="Novo Cliente">
    </form>
    <p>
    <a href="index.html">Home</a>
    <?php
    mysqli_close($con);
    ?>
</body>
</html>