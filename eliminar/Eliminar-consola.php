<?php
include '../rutas/header__servicios.php'; // Incluye la conexión a la base de datos

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar la consola de la base de datos
    $sql = "DELETE FROM Consolas WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Consola eliminada correctamente.";
        header("Location: ../listas/lista-consolas.php");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al eliminar la consola: " . $conn->error;
    }
} else {
    echo "ID de consola no especificado.";
}

$conn->close(); // Cerrar la conexión cuando hayas terminado
?>