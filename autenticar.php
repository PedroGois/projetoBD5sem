<?php
// Conexão com o banco de dados
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha =$_POST['senha']; 

    echo $senha;
    // Consulta SQL para encontrar o usuário pelo login
    $query = "SELECT * FROM login_usuarios WHERE login = '$login' ";
    $result = mysqli_query($con, $query);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $senha_hash = $row['senha'];
     
        // Verifique se a senha digitada corresponde ao hash no banco de dados
        if (password_verify($senha, $senha_hash)) {
            // Login bem-sucedido
            echo "Login bem-sucedido!";
            header("Location: dashboard.php");
            exit;
        } else {
            // Login falhou
            
            header("Location:  index.html");
            echo "<h1>Login falhou. Verifique suas credenciais.</h1>";
            exit;
        }
    } else {
        // Usuário não encontrado
        echo "Usuário não encontrado.";
        header("Location:  index.html");
        exit;
    }
    } else {
        echo "Erro na consulta ao banco de dados: " . mysqli_error($con);
        header("Location:  index.html");
        exit;
    }


mysqli_close($con);
?>