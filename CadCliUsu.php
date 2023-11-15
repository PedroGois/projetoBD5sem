<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
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
        input[type="email"],
        input[type="number"],
        input[type="date"],
        select {
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
    </style>
</head>
<body>


    <h1>Cadastro</h1>

    <form action="InsereCliente.php" method="POST">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>

    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" required>

    <label for="numero">Número:</label>
    <input type="text" name="numero" required>

    <label for="bairro">Bairro:</label>
    <input type="text" name="bairro" required>

    <label for="cidade">Cidade:</label>
    <input type="text" name="cidade" required>

    <label for="estado">Estado:</label>
    <select name="estado" required>
        <option value="AC">Acre</option>
        <option value="AL">Alagoas</option>
        <option value="AP">Amapá</option>
        <option value="AM">Amazonas</option>
        <option value="BA">Bahia</option>
        <option value="CE">Ceará</option>
        <option value="DF">Distrito Federal</option>
        <option value="ES">Espírito Santo</option>
        <option value="GO">Goiás</option>
        <option value="MA">Maranhão</option>
        <option value="MT">Mato Grosso</option>
        <option value="MS">Mato Grosso do Sul</option>
        <option value="MG">Minas Gerais</option>
        <option value="PA">Pará</option>
        <option value="PB">Paraíba</option>
        <option value="PR">Paraná</option>
        <option value="PE">Pernambuco</option>
        <option value="PI">Piauí</option>
        <option value="RJ">Rio de Janeiro</option>
        <option value="RN">Rio Grande do Norte</option>
        <option value="RS">Rio Grande do Sul</option>
        <option value="RO">Rondônia</option>
        <option value="RR">Roraima</option>
        <option value="SC">Santa Catarina</option>
        <option value="SP">São Paulo</option>
        <option value="SE">Sergipe</option>
        <option value="TO">Tocantins</option>
    </select>

    <label for="email">E-mail:</label>
    <input type="email" name="email">

    <label for="cpf_cnpj">CPF ou CNPJ:</label>
    <input type="text" name="cpf_cnpj" required>

    <label for="rg">RG:</label>
    <input type="text" name="rg">

    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone">

    <label for="celular">Celular:</label>
    <input type="text" name="celular" required>

    <label for="data_nasc">Data de Nascimento:</label>
    <input type="date" name="data_nasc" required>

    <hr> Login <hr>

    <label for="login">Login:</label>
    <input type="text" name="login" required><br>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" required><br>

    <input type="submit" value="Cadastrar">
    </form>

    <p>Já possui uma conta? <a href="index.html">Faça login</a></p>
</body>
</html>