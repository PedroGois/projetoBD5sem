<?php
// Conexão com o banco de dados
include('conexao.php');

// Obter dados do formulário
$login = $_POST['login'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha para segurança
$id_cliente = $_POST['id_cliente'];

// Inserir o usuário na tabela
$query = "INSERT INTO login_usuarios (login, senha, id_cliente) VALUES ('$login', '$senha', $id_cliente)";
$resu = mysqli_query($con, $query);

if ($resu) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "ERRO: Cadastro não realizado!";
}

mysqli_close($con);
?>