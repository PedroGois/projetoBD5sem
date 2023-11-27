<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>

    <?php
    include('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $id = $_GET["id"];
        
        // Verifique se o ID é válido (um número inteiro positivo)
        if (is_numeric($id) && $id > 0) {
            // Recupere os dados do cliente com base no ID
            $sql = "SELECT * FROM clientes WHERE id = $id";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $estados = array(
                    'AC' => 'Acre',
                    'AL' => 'Alagoas',
                    'AP' => 'Amapá',
                    'AM' => 'Amazonas',
                    'BA' => 'Bahia',
                    'CE' => 'Ceará',
                    'DF' => 'Distrito Federal',
                    'ES' => 'Espírito Santo',
                    'GO' => 'Goiás',
                    'MA' => 'Maranhão',
                    'MT' => 'Mato Grosso',
                    'MS' => 'Mato Grosso do Sul',
                    'MG' => 'Minas Gerais',
                    'PA' => 'Pará',
                    'PB' => 'Paraíba',
                    'PR' => 'Paraná',
                    'PE' => 'Pernambuco',
                    'PI' => 'Piauí',
                    'RJ' => 'Rio de Janeiro',
                    'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul',
                    'RO' => 'Rondônia',
                    'RR' => 'Roraima',
                    'SC' => 'Santa Catarina',
                    'SP' => 'São Paulo',
                    'SE' => 'Sergipe',
                    'TO' => 'Tocantins'
                );

                ?>

                <form action="atualizar_cliente.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required><br>

                    <label for="endereco">Endereço:</label>
                    <input type="text" name="endereco" value="<?php echo $row['endereco']; ?>" required><br>

                    <label for="numero">Número:</label>
                    <input type="text" name="numero" value="<?php echo $row['numero']; ?>" required><br>

                    <label for="bairro">Bairro:</label>
                    <input type="text" name="bairro" value="<?php echo $row['bairro']; ?>" required><br>

                    <label for="cidade">Cidade:</label>
                    <input type="text" name="cidade" value="<?php echo $row['cidade']; ?>" required><br>

                    <label for="estado">Estado:</label>
                    <select name="estado">
                        <?php
                        foreach ($estados as $sigla => $nomeEstado) {
                            echo "<option value='$sigla'";
                            if ($sigla == $row['estado']) {
                                echo " selected";
                            }
                            echo ">$nomeEstado</option>";
                        }
                        ?>
                    </select><br>


                    <label for="email">E-mail:</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>

                    <label for="cpf_cnpj">CPF ou CNPJ:</label>
                    <input type="text" name="cpf_cnpj" value="<?php echo $row['cpf_cnpj']; ?>" required><br>

                    <label for="rg">RG:</label>
                    <input type="text" name="rg" value="<?php echo $row['rg']; ?>"><br>

                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" value="<?php echo $row['telefone']; ?>"><br>

                    <label for="celular">Celular:</label>
                    <input type="text" name="celular" value="<?php echo $row['celular']; ?>" required><br>

                    <label for="data_nasc">Data de Nascimento:</label>
                    <input type="date" name="data_nasc" value="<?php echo $row['data_nasc']; ?>" required><br>

                    <input type="submit" value="Salvar Alterações">
                </form>
                <?php
            } else {
                echo "Cliente não encontrado.";
            }
        } else {
            echo "ID de cliente inválido.";
        }
    } else {
        echo "ID de cliente não especificado.";
    }

    mysqli_close($con);
    ?>
</body>
</html>