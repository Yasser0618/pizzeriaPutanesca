<?php
require_once("../../config/db.php");

if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(!isset($_GET["id"]) || empty($_GET["id"])){
        die("No se ha recibido un ID");
    }

    try{
        $stmt = $db -> prepare("DELETE FROM ingredientes WHERE id = :id");
        $stmt -> bindParam(":id", $_GET["id"]);
        if ($stmt -> execute()){
            header("Location: list-ingredientes.php?");
            exit;
        } else{
            die("No se pudo eliminar el ingrediente");
        }
    } catch(PDOException $e){
        die ("Error al borrar el ingrediente: " . $e -> getMessage());
    }
} else{
    die ("Metodo no permitido");
}