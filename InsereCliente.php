<?php
// Conexão com o banco de dados
include('conexao.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $verif = "SELECT * from clientes WHERE cpf_cnpj = '$cpf_cnpj'";
    $resu = $con->query($verif);
    if ($resu->num_rows > 0) {
        echo "Cadastro ja existente !"; 
        header("Location:  CadCliUsu.php");
    } else {
    // Inserir o cliente na tabela
    $query = "INSERT INTO clientes (nome, endereco, numero, bairro, cidade, estado, email, cpf_cnpj, rg, telefone, celular, data_nasc)
              VALUES ('$nome', '$endereco', '$numero', '$bairro', '$cidade', '$estado', '$email', '$cpf_cnpj', '$rg', '$telefone', '$celular', '$data_nasc')";
    $insert = mysqli_query($con, $query);

    if ($insert) {
        echo "<br><font color='blue'>Inclusão realizada com sucesso!</font>";
        $login = $_POST['login'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha
        $sql = "SELECT id from clientes WHERE nome = '$nome' and cpf_cnpj = '$cpf_cnpj'";
        $sel = $con->query($sql);
        $row = $sel->fetch_assoc();
        $id = $row["id"];

        // Inserir o usuário na tabela
        $query = "INSERT INTO login_usuarios (login, senha, id_cliente) VALUES ('$login', '$senha', $id)";
        $insertus = mysqli_query($con, $query);

        if ($insertus) {
            echo "Cadastro realizado com sucesso!";
            header("Location:   Index.html");
            exit;
        } else {
            echo "ERRO: Cadastro não realizado!";
            header("Location:  CadCliUsu.php");
            exit;
        }
            
    } else {
        echo "<br><font color='red'>ERRO: Inclusão não realizada!</font>";
        header("Location:  CadCliUsu.php");
        exit;
    }
}
}
mysqli_close($con);
?>


