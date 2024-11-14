<?php
session_start();

$productos = [
    "1" => "Camisetas",
    "2" => "Sudadera",
    "3" => "Pantalones",
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoSeleccionado = $_POST['producto'];
    $cantidad = $_POST['cantidad'];

    if ($cantidad > 0) {  
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        if (isset($_SESSION['carrito'][$productoSeleccionado])) {
            $_SESSION['carrito'][$productoSeleccionado]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$productoSeleccionado] = [
                'nombre' => $productos[$productoSeleccionado],
                'cantidad' => $cantidad
            ];
        }

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
    <title>Tienda - Selección de Artículos</title>
    <style>
   body {
            font-family: "Comic Sans MS", sans-serif;
            background-color: #ffddc1;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(45deg, #ffd1dc, #c1ffd7);
        }

        .container {
            background-color: #ffe4e1;
            padding: 20px;
            border: 2px solid #ff69b4;
            border-radius: 0;
            width: 90%;
            max-width: 400px;
            text-align: left;
            box-shadow: none;
        }

        h1 {
            text-align: center;
            color: #ff1493;
            margin-bottom: 15px;
            font-size: 24px;
            font-weight: bold;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 16px;
            color: #8b0000;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 2px solid #ff7f50;
            border-radius: 0;
            font-size: 14px;
            background-color: #faf0e6;
            color: #333;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ff4500;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: 2px solid #8b0000;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #ff6347;
        }

        .message {
            font-size: 14px;
            color: #ff0000;
            margin-top: 10px;
            text-align: center;
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
                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>

            <?php if (isset($mensaje)): ?>
                <p class="message"><?php echo $mensaje; ?></p>
            <?php endif; ?>

            <button type="submit">Añadir al carrito</button>
        </form>
    </div>
</body>
</html>
