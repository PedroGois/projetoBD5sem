<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tela Inicial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
            font-size: 18px;
            margin: 10px 0;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tela Inicial</h1>
        <p>
            <a href="lista_clientes.php">Lista de Clientes</a>
        </p>
        <p>
            <a href="lista_produtos.php">Lista de Produtos</a>
        </p>
        <p>
            <a href="lista_pedidos.php">Lista de Pedidos</a>
        </p>
        <p>
            <a href="lista_itenspedido.php">Itens Pedidos</a>
        </p>
        <p>
            <a href="relatorios.php">Relatórios</a>
        </p>
    </div>
</body>
</html>