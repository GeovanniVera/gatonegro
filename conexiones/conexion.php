<?php
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

// Opcional: Configurar el juego de caracteres a UTF-8 (recomendado)
$conn->set_charset("utf8");
?>