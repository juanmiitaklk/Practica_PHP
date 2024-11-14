<?php
session_start();

$productos = [
    "1" => "Camisetas",
    "2" => "Sudadera",
    "3" => "Pantalones",
];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];

    if (isset($_SESSION['carrito'][$producto])) {
        $_SESSION['carrito'][$producto]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto] = [
            'nombre' => $productos[$producto],
            'cantidad' => $cantidad
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - Carrito de Compras</title>

    <style>
        body {
            font-family: "Comic Sans MS", cursive, sans-serif;
            background-color: #ffcccb;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(45deg, #fddfcb, #d0e7d1);
        }

        .container {
            background-color: #ffffe0;
            padding: 20px;
            border: 3px solid #ff69b4;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #ff1493;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }

        li {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px dashed #ff6347;
            font-size: 16px;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li:hover {
            background-color: #f0f8ff;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ff4500;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: 2px solid #ff6347;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #ff6347;
        }

        .carrito-lista {
            margin-bottom: 20px;
        }

        .mensaje {
            font-size: 16px;
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Carrito de Compras</h1>
        
        <div class="carrito-lista">
            <ul>
                <?php if (empty($_SESSION['carrito'])): ?>
                    <li>Tu carrito está vacío.</li>
                <?php else: ?>
                    <?php foreach ($_SESSION['carrito'] as $id => $producto): ?>
                        <li>
                            <span> <?php echo $producto['nombre']; ?></span>
                            <span>Cantidad: <?php echo $producto['cantidad']; ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>

        <form action="inicio.php">
            <button type="submit">Seguir comprando</button>
        </form>
        
        <form action="pedidos.php" method="post">
            <button type="submit" name="procesar_pedido">Procesar pedido</button>
        </form>
    </div>
</body>
</html>
