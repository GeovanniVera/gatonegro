<?php
include '../rutas/header__servicios.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombreGenero = mysqli_real_escape_string($conn, $_POST['nombreGenero']);
    $descripcionGenero = mysqli_real_escape_string($conn, $_POST['descripcionGenero']);

    $errores = []; // Array para almacenar errores

    // Validaciones para el nombre del género
    if (empty($nombreGenero)) {
        $errores[] = "El nombre del género es obligatorio.";
    } elseif (strlen($nombreGenero) < 3 || strlen($nombreGenero) > 30) {
        $errores[] = "El nombre del género debe tener entre 3 y 30 caracteres.";
    }

    // Validaciones para la descripción del género
    if (empty($descripcionGenero)) {
        $errores[] = "La descripción del género es obligatoria.";
    } elseif (strlen($descripcionGenero) < 3 || strlen($descripcionGenero) > 150) {
        $errores[] = "La descripción del género debe tener entre 3 y 150 caracteres.";
    }

    if (!empty($errores)) {
        // Redirigir de vuelta al formulario con los errores
        session_start();
        $_SESSION['errores'] = $errores;
        header("Location: ../formularios/Form-Genero.php" . ($id ? "?id=$id" : ""));
        exit();
    }

    try {
        if ($id) {
            $sql = "UPDATE generos SET Nombre = '$nombreGenero', Descripcion = '$descripcionGenero' WHERE Id = $id";
        } else {
            $sql = "INSERT INTO generos (Nombre, Descripcion) VALUES ('$nombreGenero', '$descripcionGenero')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Género guardado correctamente.";
            header("Location: ../listas/lista-generos.php");
            exit();
        } else {
            // Verificar si el error es por duplicación
            if (strpos($conn->error, "Duplicate entry") !== false) {
                echo "Error: El nombre del género ya existe.";
            } else {
                throw new Exception("Error al guardar el género: " . $conn->error);
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>