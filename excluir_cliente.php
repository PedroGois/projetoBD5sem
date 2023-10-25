<?php
// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha o ID do cliente a ser excluído
    $id = $_POST["id"];

    // Conexão com o banco de dados já estabelecida (a partir do seu código)
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $db = 'restaurante';
    $con = mysqli_connect($servidor, $usuario, $senha, $db);

    // Verifique a conexão
    if (!$con) {
        die("Erro na conexão com MySQL: " . mysqli_connect_error());
    }

    // Crie a consulta SQL para excluir o cliente com base no ID
    $sql = "DELETE FROM clientes WHERE id = $id";

    // Execute a consulta SQL
    if (mysqli_query($con, $sql)) {
        echo "Cliente excluído com sucesso!";
    } else {
        echo "Erro na exclusão do cliente: " . mysqli_error($con);
    }

    // Feche a conexão com o banco de dados
    mysqli_close($con);
}
?>