<?php
require_once("../../config/db.php");
require_once("../../model/Ingrediente.php");

$ingredienteId = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$ingrediente = new Ingrediente($db);
if (!$ingrediente -> loadById($ingredienteId)){
    echo "Ingrediente no encontrado.";
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $ingrediente -> setNombre($_POST["nombre"]);

    if ($ingrediente -> save()){
        header("Location: list-ingredientes.php");
    } else{
        echo "Error al actualizar el ingrediente";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar ingredientes</title>
</head>
<body>
    <h1>Editar Ingrediente</h1>

    <form action="<?= $_SERVER["PHP_SELF"] . "?id=" . $ingredienteId?>" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?= $ingrediente -> getNombre() ?>" required>
        <br>
        <input type="submit" name="submit" id="submit" value="Guardar cambios">
    </form>
</body>
</html>