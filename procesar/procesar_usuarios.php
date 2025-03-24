<?php
include '../rutas/header__servicios.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombreUsuario = mysqli_real_escape_string($conn, $_POST['nombreUsuario']);
    $correoUsuario = mysqli_real_escape_string($conn, $_POST['correoUsuario']);
    $contrasenaUsuario = mysqli_real_escape_string($conn, $_POST['contrasenaUsuario']);

    $errores = []; // Array para almacenar errores

    if (empty($nombreUsuario) || empty($correoUsuario) || empty($contrasenaUsuario)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    if (!filter_var($correoUsuario, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    if (strlen($contrasenaUsuario) < 5) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (!empty($errores)) {
        // Redirigir de vuelta al formulario con los errores
        session_start();
        $_SESSION['errores'] = $errores;
        header("Location: ../formularios/Form-Usuario.php" . ($id ? "?id=$id" : ""));
        exit();
    }

    try {
        if ($id) {
            $sql = "UPDATE Usuarios SET Nombre = '$nombreUsuario', Correo_Electronico = '$correoUsuario', Contraseña = '$contrasenaUsuario' WHERE Id = $id";
        } else {
            $sql = "INSERT INTO Usuarios (Nombre, Correo_Electronico, Contraseña) VALUES ('$nombreUsuario', '$correoUsuario', '$contrasenaUsuario')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Usuario guardado correctamente.";
            header("Location: ../listas/lista-usuarios.php");
            exit();
        } else {
            throw new Exception("Error al guardar el usuario: " . $conn->error);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>