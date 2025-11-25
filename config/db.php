<?php

$host = '127.0.0.1'; //en principio no cambia
$dbname = 'pizzeriaputanesca'; //nombre base de datos
$username = 'root';
$password = '';
$port = "3307";

//En lugar de hacer un try-catch en cada pagina, se hace en esta unicamente y se llama desde otras páginas
try {
    //Para poder meter variables en medio de un string se usa ""
    /*
    Colocar debajo de host para indicar el puerto en el mac
    */
    $db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",$username,$password);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
