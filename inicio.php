<?php
session_start();

// Lista de productos
$productos = [
    "1" => "Camisetas",
    "2" => "Sudadera",
    "3" => "Pantalones",
];

// Agregar al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoSeleccionado = $_POST['producto'];
    $cantidad = intval($_POST['cantidad']);

    if ($cantidad > 0) {  
        // Iniciar el carrito si no existe
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Agregar el producto y cantidad al carrito, junto con el nombre del producto
        if (isset($_SESSION['carrito'][$productoSeleccionado])) {
            $_SESSION['carrito'][$productoSeleccionado]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$productoSeleccionado] = [
                'nombre' => $productos[$productoSeleccionado],
                'cantidad' => $cantidad
            ];
        }

        // Redirigir a la pagina de carrito
        header('Location: carrito.php');
        exit();
    } else {
        $mensaje = "La cantidad debe ser mayor que cero.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - Selección de Artículos</title>
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
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            font-size: 18px;
            color: #5a5a5a;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 25px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        select:focus, input[type="number"]:focus {
            border-color: #007bff;
            outline: none;
            background-color: #f1f7ff;
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
        }

        .message {
            font-size: 16px;
            color: #d9534f;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selecciona un Artículo</h1>
        <form action="inicio.php" method="post">
            <label for="producto">Artículo:</label>
            <select name="producto" id="producto" required>
                <?php foreach ($productos as $id => $nombre): ?>
                    <option value="<?php echo htmlspecialchars($id); ?>"><?php echo htmlspecialchars($nombre); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>

            <?php if (isset($mensaje)): ?>
                <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endif; ?>

            <button type="submit">Añadir al carrito</button>
        </form>
    </div>
</body>
</html>