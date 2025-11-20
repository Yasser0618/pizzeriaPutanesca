<?php
require_once("../../config/db.php");//carga base de datos
require_once("../../model/Pizza.php");//carga el modelo pizza

/* 
La clase Pizza es una clase estatica, lo que nos permite regoger metodos de la clase
sin haberla instanciado previamente 
En $pizzas casi seguro nos devolvera un array
*/
$pizzas = Pizza::getAll($db);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar pizzas</title>
</head>
<body>
    <h1>Menú:</h1>
    <?php include('../partials/_menu.php') ?>


    <h1>Pizzas:</h1>
    <table border="1" cellspacing="10" cellpadding="10">
        <thead>
            <tr>
                
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pizzas as $pizza) : ?>
                <tr>
                    <td><?= $pizza['nombre'] ?></td>
                    <td><?= $pizza['descripcion'] ?></td>
                    <td><?= $pizza['precio'] ?></td>
                    <td><?= $pizza['imagen'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>