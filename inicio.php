<?php
session_start();

$productos = [
    "1" => "Producto A",
    "2" => "Producto B",
    "3" => "Producto C",
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda - Selección de Artículos</title>
</head>
<body>
    <h1>Selecciona un artículo</h1>
    <form action="carrito.php" method="post">
        <label for="producto">Artículo:</label>
        <select name="producto" id="producto" required>
            <?php foreach ($productos as $id => $nombre): ?>
                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>
        <br>
        <button type="submit">Añadir al carrito</button>
    </form>
</body>
</html>
