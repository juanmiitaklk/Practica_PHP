<?php
session_start();

if (!isset($_COOKIE['numero_pedidos'])) {
    setcookie('numero_pedidos', 0, time() + (86400 * 30), "/"); 
    $numero_pedidos = 0; 
} else {
    $numero_pedidos = $_COOKIE['numero_pedidos']; 
}

if (isset($_POST['procesar_pedido'])) {
    $numero_pedidos += 1; 
    setcookie('numero_pedidos', $numero_pedidos, time() + (86400 * 30), "/"); 
    $_SESSION['fecha_ultimo_pedido'] = date('Y-m-d H:i:s');

    $_SESSION['carrito'] = [];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - Historial de Pedidos</title>
</head>
<body>
    <h1>Historial de Pedidos</h1>
    <p>Número total de pedidos: <?php echo $numero_pedidos; ?></p>
    <p>Fecha del último pedido: <?php echo isset($_SESSION['fecha_ultimo_pedido']) ? $_SESSION['fecha_ultimo_pedido'] : 'No hay pedidos realizados.'; ?></p>
    <form action="" method="post">
        <button type="submit" name="borrar_historial">Borrar historial</button>
    </form>

    <?php
    if (isset($_POST['borrar_historial'])) {
        setcookie('numero_pedidos', 0, time() - 3600, "/"); 
        unset($_SESSION['fecha_ultimo_pedido']); 
        echo "<p>Historial borrado.</p>";
    }
    ?>
</body>
</html>
