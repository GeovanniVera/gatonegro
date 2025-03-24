<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "lacalledelgatonegro";
$password = "lacalledelgatonegro123";
$dbname = "lacalledelgatonegro";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar las entradas del usuario
    $correo = filter_var($_POST["usuario"], FILTER_SANITIZE_EMAIL);
    $contraseña = $_POST["contraseña"];

    // Verificar si el correo es válido
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Consulta para obtener el usuario por correo electrónico
        $sql = "SELECT * FROM Usuarios WHERE Correo_Electronico = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verificar contraseña (usar password_verify() para contraseñas hasheadas)
            if ($contraseña == $row["Contraseña"]) {
                // Inicio de sesión exitoso
                session_start();
                $_SESSION["usuario"] = $row["Nombre"];
                header("Location: Servicios.php");
                exit();
            } else {
                $error = "Correo electrónico o contraseña incorrectos.";
            }
        } else {
            $error = "Correo electrónico o contraseña incorrectos.";
        }
    } else {
        $error = "Correo electrónico no válido.";
    }

    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
} else {
    // Redirigir si se intenta acceder a Sesion.php mediante GET
    header("Location: sesion.php");
    exit();
}

$conn->close();
?>