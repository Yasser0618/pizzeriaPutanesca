<?php
require_once("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("No se ha recibido un ID.");
    }

    try {
        $stmt = $db->prepare("DELETE FROM pizzas WHERE id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        if ($stmt->execute()) {
            header("Location: list-pizza.php?");
            exit;
        } else {
            die("No se pudo eliminar la pizza.");
        }
    } catch (PDOException $e) {
        die("Error al borrar la pizza: " . $e->getMessage());
    }
} else {
    die("Método no permitido.");
}