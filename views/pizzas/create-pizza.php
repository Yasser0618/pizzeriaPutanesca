<?php
require_once("../../config/db.php");
require_once("../../model/Pizza.php");
require_once("../../model/Ingrediente.php");

$ingredientes = [];
try {
    $stmt = $db->query("SELECT * FROM ingredientes");
    $ingredientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener los ingredientes: " . $e->getMessage();
    return [];
}   

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizza = new Pizza($db);
    $pizza->setNombre($_POST["nombre"])
        ->setDescripcion($_POST["descripcion"])
        ->setImagen($_POST["imagen"])
        ->setPrecio($_POST["precio"])
        ->setIngredientes($_POST["ingredientes"]);
    if ($pizza->save()) {
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
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
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
        <fieldset>
            <legend>Ingredientes</legend>
            <?php foreach ($ingredientes as $ingrediente) { ?>
                <input type="checkbox" name="ingredientes[]" id="ingrediente<?= $ingrediente["id"] ?>" value="<?= $ingrediente["id"] ?>">
                <label for="<?= $ingrediente["nombre"] ?>"><?= $ingrediente["nombre"] ?></label>
                <br>
            <?php } ?>
        </fieldset>
        <br>
        <input type="submit" name="submit" id="submit" value="Crear pizza">
    </form>
</body>

</html>