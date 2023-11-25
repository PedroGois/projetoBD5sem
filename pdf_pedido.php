<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

include('conexao.php');

if (isset($_POST['data_inicial']) && isset($_POST['data_final'])) {
    $dtini = date('Y-m-d', strtotime($_POST['data_inicial']));
    $dtfim = date('Y-m-d', strtotime($_POST['data_final']));
    } else{
    header("Location: filtropdf_pedido.php?msg=filternotfound");
    }


// Faça a inserção no banco de dados aqui
$query = "SELECT * FROM pedidos where data >='$dtini' and data <= '$dtfim' ORDER BY id ";
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
                    <th scope="col">Data</th>
                    <th scope="col">Id Cliente</th>
                    <th scope="col">Observação</th>
                    <th scope="col">Cond. Pagamento</th>
                    <th scope="col">Prazo de Entrega</th>
                </tr>
            </thead>
            <tbody>';

foreach ($prod as $p) {
    $html .= '
        <tr>
            <td>' . $p['id'] . '</td>
            <td>' . $p['data'] . '</td>
            <td>' . $p['id_cliente'] . '</td>
            <td>' . $p['observacao'] . '</td>
            <td>' . $p['cond_pagto'] . '</td>
            <td>' . $p['prazo_entrega'] . '</td>
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
