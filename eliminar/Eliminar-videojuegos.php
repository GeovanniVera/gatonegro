<?php
include '../rutas/header__servicios.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM Videojuegos WHERE Id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Videojuego eliminado correctamente.";
        header("Location: ../listas/lista-videojuegos.php");
        exit();
    } else {
        echo "Error al eliminar el videojuego: " . $conn->error;
    }
}

$conn->close();
?>