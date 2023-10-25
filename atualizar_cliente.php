<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $endereco = $_POST["endereco"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $email = $_POST["email"];
    $cpf_cnpj = $_POST["cpf_cnpj"];
    $rg = $_POST["rg"];
    $telefone = $_POST["telefone"];
    $celular = $_POST["celular"];
    $data_nasc = $_POST["data_nasc"];

    $sql = "UPDATE clientes SET
        nome = '$nome',
        endereco = '$endereco',
        numero = '$numero',
        bairro = '$bairro',
        cidade = '$cidade',
        estado = '$estado',
        email = '$email',
        cpf_cnpj = '$cpf_cnpj',
        rg = '$rg',
        telefone = '$telefone',
        celular = '$celular',
        data_nasc = '$data_nasc'
        WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        echo "Cliente atualizado com sucesso!";
    } else {
        echo "Erro na atualização do cliente: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>