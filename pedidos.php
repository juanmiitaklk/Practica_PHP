<?php
session_start();

if (!isset($_COOKIE['numero_pedidos'])) {
    setcookie('numero_pedidos', 0, time() + (86400 * 30), "/");
    $numero_pedidos = 0;
} else {
    $numero_pedidos = $_COOKIE['numero_pedidos'];
}

// Procesar el pedido 
if (isset($_POST['procesar_pedido'])) {
    $numero_pedidos += 1;
    setcookie('numero_pedidos', $numero_pedidos, time() + (86400 * 30), "/");
    $_SESSION['fecha_ultimo_pedido'] = date('Y-m-d H:i:s');
    $_SESSION['carrito'] = [];  
}

// Borrar historial
if (isset($_POST['borrar_historial'])) {
    setcookie('numero_pedidos', 0, time() - 3600, "/");  
    unset($_SESSION['fecha_ultimo_pedido']);  
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - Historial de Pedidos</title>
    <style>
               body {
            font-family: "Comic Sans MS", cursive, sans-serif;
            background-color: #e0e0e0;
            color: #222;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #d3d3d3;
            padding: 15px;
            border: 3px solid #a9a9a9;
            border-radius: 0;
            width: 90%;
            max-width: 500px;
            text-align: left;
            box-shadow: none;
        }

        h1 {
            color: #4b0082;
            font-size: 24px;
            margin: 0 0 15px 0;
            text-align: left;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
            color: #333;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ffd700;
            color: #000;
            font-size: 14px;
            font-weight: bold;
            border: 2px solid #808080;
            border-radius: 0;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #daa520;
        }

        form {
            display: block;
        }

        form button {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Historial de Pedidos</h1>
        <p>Número total de pedidos: <?php echo $numero_pedidos; ?> <br></p>
        <p>Fecha del último pedido: <?php echo isset($_SESSION['fecha_ultimo_pedido']) ? $_SESSION['fecha_ultimo_pedido'] : 'No hay pedidos realizados.'; ?></p>
        <form action="" method="post">
            <button type="submit" name="borrar_historial">Borrar historial</button>
        </form>
    </div>
</body>
</html>
