<?php
include '../rutas/header__servicios.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$nombreVideojuego = '';
$descripcionVideojuego = '';
$fechaLanzamiento = '';
$generoId = '';
$consolaId = '';
$errores = []; // Array para almacenar errores

if ($id) {
    $sql = "SELECT * FROM Videojuegos WHERE Id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreVideojuego = $row['Nombre'];
        $descripcionVideojuego = $row['Descripcion'];
        $fechaLanzamiento = $row['Fecha_Lanzamiento'];
        $generoId = $row['Genero'];
        $consolaId = $row['Consola'];
    }
}

$sqlGeneros = "SELECT * FROM Generos";
$resultGeneros = $conn->query($sqlGeneros);

$sqlConsolas = "SELECT * FROM Consolas";
$resultConsolas = $conn->query($sqlConsolas);

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
            <form action="../procesar/procesar_videojuegos.php" method="POST">
                <h3><?php echo $id ? 'Editar Videojuego' : 'Agregar Videojuego'; ?></h3>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombreVideojuego" class="form-label">Nombre del videojuego:</label>
                        <input type="text" class="form-control" id="nombreVideojuego" name="nombreVideojuego" value="<?php echo $nombreVideojuego; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="descripcionVideojuego" class="form-label">Descripción del videojuego:</label>
                        <input type="text" class="form-control" id="descripcionVideojuego" name="descripcionVideojuego" value="<?php echo $descripcionVideojuego; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fechaLanzamiento" class="form-label">Fecha de lanzamiento:</label>
                        <input type="datetime-local" class="form-control" id="fechaLanzamiento" name="fechaLanzamiento" value="<?php echo str_replace(' ', 'T', $fechaLanzamiento); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="generoId" class="form-label">Género:</label>
                        <select class="form-select" id="generoId" name="generoId" required>
                            <option value="">Seleccionar género</option>
                            <?php
                            if ($resultGeneros && $resultGeneros->num_rows > 0) {
                                while ($rowGenero = $resultGeneros->fetch_assoc()) {
                                    $selected = ($generoId == $rowGenero['Id']) ? 'selected' : '';
                                    echo "<option value='" . $rowGenero['Id'] . "' $selected>" . $rowGenero['Nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="consolaId" class="form-label">Consola:</label>
                        <select class="form-select" id="consolaId" name="consolaId" required>
                            <option value="">Seleccionar consola</option>
                            <?php
                            if ($resultConsolas && $resultConsolas->num_rows > 0) {
                                while ($rowConsola = $resultConsolas->fetch_assoc()) {
                                    $selected = ($consolaId == $rowConsola['Id']) ? 'selected' : '';
                                    echo "<option value='" . $rowConsola['Id'] . "' $selected>" . $rowConsola['Nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <input type="submit" value="<?php echo $id ? 'Guardar Cambios' : 'Aceptar'; ?>" class="btn btn-primary">
                        <input type="button" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='../listas/lista-videojuegos.php'">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../rutas/footer.php'; ?>