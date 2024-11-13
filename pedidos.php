<?php
session_start();

if (!isset($_COOKIE['numero_pedidos'])) {
    setcookie('numero_pedidos', 0, time() + (86400 * 30), "/", "", true, true);
    $numero_pedidos = 0;
} else {
    $numero_pedidos = intval($_COOKIE['numero_pedidos']);
}

if (isset($_POST['procesar_pedido'])) {
    $numero_pedidos++;
    setcookie('numero_pedidos', $numero_pedidos, time() + (86400 * 30), "/", "", true, true);
    $_SESSION['fecha_ultimo_pedido'] = date('Y-m-d H:i:s');
    $_SESSION['carrito'] = [];  // Vaciar el carrito
}

if (isset($_POST['borrar_historial'])) {
    setcookie('numero_pedidos', 0, time() - 3600, "/", "", true, true);  // Eliminar cookie
    unset($_SESSION['fecha_ultimo_pedido']);  // Borrar sesión
    $numero_pedidos = 0;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - Historial de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            color: #5a5a5a;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ff6347;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e5533d;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Historial de Pedidos</h1>
        <p>Número total de pedidos: <?php echo $numero_pedidos; ?> <br></p>
        <p>Fecha del último pedido: <?php echo isset($_SESSION['fecha_ultimo_pedido']) ? htmlspecialchars($_SESSION['fecha_ultimo_pedido']) : 'No hay pedidos realizados.'; ?></p>
        <form action="" method="post">
            <button type="submit" name="borrar_historial">Borrar historial</button>
        </form>
        <form action="inicio.php">
            <button type="submit">Volver a la tienda</button>
        </form>
    </div>
</body>
</html>