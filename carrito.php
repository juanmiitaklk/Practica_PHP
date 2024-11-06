<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];

    if (isset($_SESSION['carrito'][$producto])) {
        $_SESSION['carrito'][$producto] += $cantidad; 
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
</head>
<body>
    <h1>Carrito de Compras</h1>
    <ul>
        <?php if (empty($_SESSION['carrito'])): ?>
            <li>Tu carrito está vacío.</li>
        <?php else: ?>
            <?php foreach ($_SESSION['carrito'] as $id => $cantidad): ?>
                <li>Producto ID: <?php echo $id; ?>, Cantidad: <?php echo $cantidad; ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <form action="inicio.php">
        <button type="submit">Seguir comprando</button>
    </form>
    <form action="pedidos.php" method="post">
        <button type="submit" name="procesar_pedido">Procesar pedido</button>
    </form>
</body>
</html>
