<?php
include '../rutas/header__servicios.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombreConsola = mysqli_real_escape_string($conn, $_POST['nombreConsola']);
    $descripcionConsola = mysqli_real_escape_string($conn, $_POST['descripcionConsola']);
    $modeloConsola = mysqli_real_escape_string($conn, $_POST['modeloConsola']);
    $fechaCreacionConsola = mysqli_real_escape_string($conn, $_POST['fechaCreacionConsola']);

    $errores = []; // Array para almacenar errores

    // Validaciones para el nombre de la consola
    if (empty($nombreConsola)) {
        $errores[] = "El nombre de la consola es obligatorio.";
    } elseif (strlen($nombreConsola) < 3 || strlen($nombreConsola) > 30) {
        $errores[] = "El nombre de la consola debe tener entre 3 y 30 caracteres.";
    }

    // Validaciones para la descripción de la consola
    if (empty($descripcionConsola)) {
        $errores[] = "La descripción de la consola es obligatoria.";
    } elseif (strlen($descripcionConsola) < 3 || strlen($descripcionConsola) > 60) {
        $errores[] = "La descripción de la consola debe tener entre 3 y 60 caracteres.";
    }

    // Validaciones para el modelo de la consola
    if (empty($modeloConsola)) {
        $errores[] = "El modelo de la consola es obligatorio.";
    } elseif (strlen($modeloConsola) < 3 || strlen($modeloConsola) > 30) {
        $errores[] = "El modelo de la consola debe tener entre 3 y 30 caracteres.";
    }

    // Validaciones para la fecha de creación

    if (!empty($errores)) {
        // Redirigir de vuelta al formulario con los errores
        session_start();
        $_SESSION['errores'] = $errores;
        header("Location: ../formularios/Form-Consolas.php" . ($id ? "?id=$id" : ""));
        exit();
    }

    try {
        if ($id) {
            $sql = "UPDATE Consolas SET Nombre = '$nombreConsola', Descripcion = '$descripcionConsola', Modelo = '$modeloConsola', Fecha_Creacion = '$fechaCreacionConsola' WHERE Id = $id";
        } else {
            $sql = "INSERT INTO Consolas (Nombre, Descripcion, Modelo, Fecha_Creacion) VALUES ('$nombreConsola', '$descripcionConsola', '$modeloConsola', '$fechaCreacionConsola')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Consola guardada correctamente.";
            header("Location: ../listas/lista-consolas.php");
            exit();
        } else {
            throw new Exception("Error al guardar la consola: " . $conn->error);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>