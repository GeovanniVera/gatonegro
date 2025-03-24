<?php
include '../rutas/header__servicios.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$nombreConsola = '';
$descripcionConsola = '';
$modeloConsola = '';
$fechaCreacionConsola = '';
$errores = []; // Array para almacenar errores

if ($id) {
    $sql = "SELECT * FROM consolas WHERE Id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreConsola = $row['Nombre'];
        $descripcionConsola = $row['Descripcion'];
        $modeloConsola = $row['Modelo'];
        $fechaCreacionConsola = $row['Fecha_Creacion'];
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
            <form action="../procesar/procesar_consola.php" method="POST">
                <h3><?php echo $id ? 'Editar Consola' : 'Agregar Consola'; ?></h3>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombreConsola" class="form-label">Nombre de la consola:</label>
                        <input type="text" class="form-control" id="nombreConsola" name="nombreConsola" value="<?php echo $nombreConsola; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="descripcionConsola" class="form-label">Descripción de la consola:</label>
                        <input type="text" class="form-control" id="descripcionConsola" name="descripcionConsola" value="<?php echo $descripcionConsola; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="modeloConsola" class="form-label">Modelo de la consola:</label>
                        <input type="text" class="form-control" id="modeloConsola" name="modeloConsola" value="<?php echo $modeloConsola; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fechaCreacionConsola" class="form-label">Fecha de creación:</label>
                        <input type="datetime-local" class="form-control" id="fechaCreacionConsola" name="fechaCreacionConsola" value="<?php echo str_replace(' ', 'T', $fechaCreacionConsola); ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <input type="submit" value="<?php echo $id ? 'Guardar Cambios' : 'Aceptar'; ?>" class="btn btn-primary">
                        <input type="button" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='../listas/lista-consolas.php'">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../rutas/footer.php'; ?>