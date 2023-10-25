<?php
// Conexão com o banco de dados
include('conexao.php');
 
    // Obter dados do formulário
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $rg = $_POST['rg'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $data_nasc = $_POST['data_nasc'];
 
    // Inserir o cliente na tabela
    $query = "INSERT INTO clientes (nome, endereco, numero, bairro, cidade, estado, email, cpf_cnpj, rg, telefone, celular, data_nasc)
              VALUES ('$nome', '$endereco', '$numero', '$bairro', '$cidade', '$estado', '$email', '$cpf_cnpj', '$rg', '$telefone', '$celular', '$data_nasc')";
 
    $resu = mysqli_query($con, $query);
 
    if ($resu) {
        echo "<br><font color='blue'>Inclusão realizada com sucesso!</font>";
    } else {
        echo "<br><font color='red'>ERRO: Inclusão não realizada!</font>";
    }
 
mysqli_close($con);
?>