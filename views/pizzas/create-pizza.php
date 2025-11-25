<?php
require_once("../../config/db.php");
require_once("../../model/Pizza.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $pizza = new Pizza($db);
    $pizza->setNombre($_POST["nombre"]);
    $pizza->setDescripcion($_POST["descripcion"]);
    $pizza->setImagen($_POST["imagen"]);
    $pizza->setPrecio($_POST["precio"]);
    if ($pizza->save()){
        echo "Pizza guardada con exito";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar pizza</title>
</head>
<body>
    <?php require_once("../partials/_menu.php") ?>
    <h1>Crea tu pizza</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>
        <br>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" step="0.1">
        <br>
        <label for="imagen">Imagen:</label>
        <input type="text" name="imagen" id="imagen" required>
        <br>
        <input type="submit" name="submit" id="submit" value="Crear pizza">
    </form>
</body>
</html>