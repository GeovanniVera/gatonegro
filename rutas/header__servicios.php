<?php
session_start(); // Inicia la sesión si la necesitas en todas las páginas
include '../conexiones/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - La Calle del Gato Negro</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/495fbb564e.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header">
        <div class="container__header container">
            <div class="header__info">
                <a href="../Index.php" id="logo_enlace">
                    <img src="../img/logo.jpg" alt="Logo" class="header__logo">
                </a>
                <h2 class="header__titulo">La Calle del gato negro</h2>
            </div>
            <nav class="header__nav">
                <a href="../Index.php" class="header__enlace"><i class="fa-solid fa-house"></i> Inicio</a>
                <a href="../Servicios.php" class="header__enlace"><i class="fa-solid fa-gamepad"></i> Servicios</a>
            </nav>
        </div>
    </header>