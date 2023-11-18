<?php

    include('conexao.php');

     $sql="SELECT * FROM PEDIDOS P INNER JOIN ITENS_PEDIDOS IP ON IP.ID_PEDIDO = P.ID";

    $res = $con->query($sql);

    if($res->num_rows > 0){
        $html = "<table border='1'>";
        while($row = $res->fetch_object()){
            $html .= "<tr>";
            $html .= "<td>".$row->id."</td>";
            $html .= "<td>".$row->data."</td>";
            $html .= "<td>".$row->id_cliente."</td>";
            $html .= "<td>".$row->observacao."</td>";
            $html .= "<td>".$row->cond_pagto."</td>";
            $html .= "<td>".$row->prazo_entrega."</td>";
            $html .= "<td>".$row->id_pedido."</td>";
            $html .= "<td>".$row->id_produto."</td>";
            $html .= "<td>".$row->qtde."</td>";
            $html .= "<td>".$row->id_item."</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
    }else{
        $html = "Nenhum dado encontrado!";
    }

    use Dompdf\Dompdf;

    require_once "dompdf/autoload.inc.php";

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);
    $dompdf->set_option("default font", "sans");
    $dompdf->setPaper("A4", "portrait");
    $dompdf->render();
    $dompdf->stream();


?>
