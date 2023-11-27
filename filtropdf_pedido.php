<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Solicitação de Datas</title>
</head>
<body>
    <form method="post" action="pdf_pedido.php">
        <label for="data_inicial">Data Inicial:</label>
        <input type="date" id="data_inicial" name="data_inicial"><br><br>

        <label for="data_final">Data Final:</label>
        <input type="date" id="data_final" name="data_final"><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>