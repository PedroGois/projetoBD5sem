<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

include('conexao.php');

// Faça a inserção no banco de dados aqui
$query = "SELECT * FROM produtos ORDER BY nome ";
$result = mysqli_query($con, $query);

$prod = array();
while ($user_data = mysqli_fetch_assoc($result)) {
    $prod[] = $user_data;
}

// Configuração do Dompdf
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// HTML para o relatório
$html = '
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            color: #333;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        .table-container {
            margin: 20px auto;
            width: 90%;
            max-width: 800px;
            overflow-x: auto; 
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
    <title>RELATÓRIO</title>
</head>
<body>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantidade Estoque</th>
                    <th scope="col">Valor Unitário</th>
                    <th scope="col">Unidade de Medida</th>
                </tr>
            </thead>
            <tbody>';

foreach ($prod as $p) {
    $html .= '
        <tr>
            <td>' . $p['id'] . '</td>
            <td>' . $p['nome'] . '</td>
            <td>' . $p['qtde_estoque'] . '</td>
            <td>' . $p['valor_unitario'] . '</td>
            <td>' . $p['unidade_medida'] . '</td>
        </tr>';
}

$html .= '
            </tbody>
        </table>
    </div>
</body>
</html>';

// Carregue o HTML no Dompdf
$dompdf->loadHtml($html);

// Configuração e orientação da página
$dompdf->setPaper('A4', 'portrait');

// Renderize o HTML em PDF
$dompdf->render();

// Gere o arquivo PDF
$dompdf->stream("Relatório", array("Attachment" => false));

mysqli_close($con);
?>
