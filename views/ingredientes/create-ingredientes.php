<?php
require_once("../../config/db.php");
require_once("../../model/Ingrediente.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ingrediente = new Ingrediente($db);
    $ingrediente->setNombre($_POST["nombre"]);
    if ($ingrediente->save()){
        echo "Ingrediente guardado con éxito";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar ingrediente</title>
</head>
<body>
    <?php require_once("../partials/_menu.php"); ?>
    <h1>Crea tu ingrediente</h1>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>
        <input type="submit" name="submit" id="submit" value="Crear ingrediente">
    </form>
</body>
</html>