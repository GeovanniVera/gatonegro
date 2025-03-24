<?php
include '../rutas/header__servicios.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM Usuarios WHERE Id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado correctamente.";
        header("Location: ../listas/lista-usuarios.php");
        exit();
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }
}

$conn->close();
?>