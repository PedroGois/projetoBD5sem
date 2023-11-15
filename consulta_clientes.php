<?php
// Conectar ao banco de dados (substitua pelos seus dados de conexão)
$servername = "seu_servidor";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Filtros
$filtro_nome = isset($_GET['filtro_nome']) ? $_GET['filtro_nome'] : '';
$filtro_cidade = isset($_GET['filtro_cidade']) ? $_GET['filtro_cidade'] : '';

// Consulta SQL base
$sql = "SELECT * FROM clientes WHERE 1";

// Adicionar filtros à consulta
if (!empty($filtro_nome)) {
    $sql .= " AND nome LIKE '%$filtro_nome%'";
}

if (!empty($filtro_cidade)) {
    $sql .= " AND cidade LIKE '%$filtro_cidade%'";
}

// Executar a consulta
$result = $conn->query($sql);

// Exibir resultados
if ($result->num_rows > 0) {
    echo "<h2>Resultados:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Cidade</th><!-- Adicione mais colunas conforme necessário --></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['nome']}</td><td>{$row['cidade']}</td><!-- Adicione mais colunas conforme necessário --></tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nenhum resultado encontrado.</p>";
}

// Fechar conexão
$conn->close();
?>
