<?php
session_start();

// Lista de productos
$productos = [
    "1" => "Camisetas",
    "2" => "Sudadera",
    "3" => "Pantalones",
];

//Carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Manejo de la cantidad de productos en el carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];

    if (isset($_SESSION['carrito'][$producto])) {
        $_SESSION['carrito'][$producto] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto] = $cantidad;
    }
}

// Mostrar el carrito
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - Carrito de Compras</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(135deg, #f8f9fa, #e2e3e5);
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }

        li {
            background-color: #f9f9f9;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 18px;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s;
        }

        li:hover {
            background-color: #f1f1f1;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 20px;
        }

        button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        button:active {
            background-color: #388e3c;
            transform: translateY(1px);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .boton-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .carrito-lista {
            margin-bottom: 20px;
        }

        .mensaje {
            font-size: 18px;
            color: #d9534f;
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
                    <?php foreach ($_SESSION['carrito'] as $id => $cantidad): ?>
                        <li>
                            <span> <?php echo $productos[$id]; ?></span>
                            <span>Cantidad: <?php echo $cantidad ?></span>
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
