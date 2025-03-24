<?php
include '../rutas/header__servicios.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$nombreGenero = '';
$descripcionGenero = '';
$errores = []; // Array para almacenar errores

if ($id) {
    $sql = "SELECT * FROM Generos WHERE Id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreGenero = $row['Nombre'];
        $descripcionGenero = $row['Descripcion'];
    }
}

// Mostrar errores si existen
if (isset($_SESSION['errores'])) {
    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']); // Limpiar la sesión
}

if (!empty($errores)) {
    echo "<div style='color: red;'>";
    foreach ($errores as $error) {
        echo "<p>$error</p>";
    }
    echo "</div>";
}
?>

<div class="page-container">
    <div class="contenido-formulario">
        <div class="contenedor contenedor-formulario">
            <form action="../procesar/procesar_genero.php" method="POST">
                <h3><?php echo $id ? 'Editar Género' : 'Agregar Género'; ?></h3>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombreGenero" class="form-label">Nombre del género:</label>
                        <input type="text" class="form-control" id="nombreGenero" name="nombreGenero" value="<?php echo $nombreGenero; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="descripcionGenero" class="form-label">Descripción del género:</label>
                        <input type="text" class="form-control" id="descripcionGenero" name="descripcionGenero" value="<?php echo $descripcionGenero; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <input type="submit" value="<?php echo $id ? 'Guardar Cambios' : 'Aceptar'; ?>" class="btn btn-primary">
                        <input type="button" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='../listas/lista-generos.php'">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../rutas/footer.php'; ?>