<?php
include '../rutas/header__servicios.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM generos WHERE Id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Género eliminado correctamente.";
        header("Location: ../listas/lista-generos.php");
        exit();
    } else {
        echo "Error al eliminar el género: " . $conn->error;
    }
}

$conn->close();
?>