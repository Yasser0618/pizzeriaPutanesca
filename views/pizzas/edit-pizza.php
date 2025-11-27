<?php
require_once("../../config/db.php");
require_once("../../model/Pizza.php");

$pizzaId = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$ingredientes = [];
try {
    $stmt = $db->query("SELECT * FROM ingredientes");
    $ingredientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener los ingredientes: " . $e->getMessage();
    return [];
} 

$pizza = new Pizza($db);
if (!$pizza -> loadById($pizzaId)){
    echo "Pizza no encontrada.";
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pizza-> setNombre($_POST["nombre"])
        -> setDescripcion($_POST["descripcion"])
        -> setImagen($_POST["imagen"])
        -> setPrecio(isset($_POST["precio"]) ? $_POST["precio"] : 0);
    
    if ($pizza->save()){
        header("Location: list-pizza.php");
        exit;
    } else{
        echo "Error al actualizar la pizza";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pizza</title>
</head>
<body>
    <h1>Editar Pizza</h1>

    <form action="<?= $_SERVER["PHP_SELF"] . "?id=" . $pizzaId?>" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?= $pizza -> getNombre() ?>" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"><?= $pizza->getDescripcion() ?></textarea>
        <br>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" value="<?= $pizza->getPrecio() ?>" step="0.1">
        <br>
        <label for="imagen">imagen:</label>
        <input type="text" name="imagen" id="imagen" value="<?= $pizza->getImagen() ?>" required>
        <br>
        <fieldset>
            <legend>Ingredientes</legend>
            <?php foreach ($ingredientes as $ingrediente) {
                $checked = in_array($ingrediente["id"], $pizza->getIngredientes()) ? "checked" : "" ?>
                <input type="checkbox" name="ingredientes[]" id="ingrediente<?= $ingrediente["id"] ?>" value="<?= $ingrediente["id"] ?>" <?= $checked ?>>
                <label for="<?= $ingrediente["nombre"] ?>"><?= $ingrediente["nombre"] ?></label>
                <br>
            <?php } ?>
        </fieldset>
        <br>
        <input type="submit" name="submit" id="submit" value="Guardar Cambios">
    </form>
</body>
</html>