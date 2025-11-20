<?php 
require_once("../../config/db.php");//carga de la base de datos
require_once("../../model/Ingrediente.php");//carga del modelo Ingredientes

$ingredientes = Ingrediente::getAll($db);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar ingredientes</title>
</head>
<body>
    <h1>Menú:</h1>
    <?php require_once("../partials/_menu.php") ?>

    <h1>Pizzas:</h1>
    <table border="1" cellspacing="10" cellpadding="10"></table>
    <thead>
        <tr>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ingredientes as $ingrediente) : ?>
            <tr>
                <td><?= $ingrediente["nombre"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</body>
</html>