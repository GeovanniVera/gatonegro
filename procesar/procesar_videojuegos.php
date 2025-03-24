<?php
include '../rutas/header__servicios.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombreVideojuego = mysqli_real_escape_string($conn, $_POST['nombreVideojuego']);
    $descripcionVideojuego = mysqli_real_escape_string($conn, $_POST['descripcionVideojuego']);
    $fechaLanzamiento = mysqli_real_escape_string($conn, $_POST['fechaLanzamiento']);
    $generoId = $_POST['generoId'];
    $consolaId = $_POST['consolaId'];

    $errores = []; // Array para almacenar errores

    // Validaciones para el nombre del videojuego
    if (empty($nombreVideojuego)) {
        $errores[] = "El nombre del videojuego es obligatorio.";
    } elseif (strlen($nombreVideojuego) < 3 || strlen($nombreVideojuego) > 30) {
        $errores[] = "El nombre del videojuego debe tener entre 3 y 30 caracteres.";
    }

    // Validaciones para la descripción del videojuego
    if (empty($descripcionVideojuego)) {
        $errores[] = "La descripción del videojuego es obligatoria.";
    } elseif (strlen($descripcionVideojuego) < 3 || strlen($descripcionVideojuego) > 150) {
        $errores[] = "La descripción del videojuego debe tener entre 3 y 150 caracteres.";
    }

    // Validaciones para la fecha de lanzamiento
    if (empty($fechaLanzamiento)) {
        $errores[] = "La fecha de lanzamiento es obligatoria.";
    } else {
        // Verificar formato de fecha válido (YYYY-MM-DD HH:MM:SS)
        if (!preg_match("/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/", str_replace(' ', 'T', $fechaLanzamiento))) {
            $errores[] = "El formato de la fecha de lanzamiento no es válido.";
        } else {
            // Verificar fecha futura
            $fechaActual = date("Y-m-d H:i:s");
            if (str_replace('T', ' ', $fechaLanzamiento) > $fechaActual) {
                $errores[] = "La fecha de lanzamiento no puede ser una fecha futura.";
            }
        }
    }

    // Validaciones para el género y la consola
    if (empty($generoId)) {
        $errores[] = "El género es obligatorio.";
    }
    if (empty($consolaId)) {
        $errores[] = "La consola es obligatoria.";
    }

    if (!empty($errores)) {
        // Redirigir de vuelta al formulario con los errores
        session_start();
        $_SESSION['errores'] = $errores;
        header("Location: ../formularios/Form-Videojuegos.php" . ($id ? "?id=$id" : ""));
        exit();
    }

    try {
        if ($id) {
            $sql = "UPDATE Videojuegos SET Nombre = '$nombreVideojuego', Descripcion = '$descripcionVideojuego', Fecha_Lanzamiento = '$fechaLanzamiento', Genero = '$generoId', Consola = '$consolaId' WHERE Id = $id";
        } else {
            $sql = "INSERT INTO Videojuegos (Nombre, Descripcion, Fecha_Lanzamiento, Genero, Consola) VALUES ('$nombreVideojuego', '$descripcionVideojuego', '$fechaLanzamiento', '$generoId', '$consolaId')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Videojuego guardado correctamente.";
            header("Location: ../listas/lista-videojuegos.php");
            exit();
        } else {
            throw new Exception("Error al guardar el videojuego: " . $conn->error);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>