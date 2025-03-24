<?php
include '../rutas/header__servicios.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$nombreUsuario = '';
$correoUsuario = '';
$contrasenaUsuario = '';
$errores = []; // Array para almacenar errores

if ($id) {
    $sql = "SELECT * FROM Usuarios WHERE Id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreUsuario = $row['Nombre'];
        $correoUsuario = $row['Correo_Electronico'];
        $contrasenaUsuario = $row['Contraseña'];
    }
}

// Mostrar errores si existen
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
            <form action="../procesar/procesar_usuarios.php" method="POST">
                <h3><?php echo $id ? 'Editar Usuario' : 'Agregar Usuario'; ?></h3>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="<?php echo $nombreUsuario; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="correoUsuario" class="form-label">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correoUsuario" name="correoUsuario" value="<?php echo $correoUsuario; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contrasenaUsuario" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="contrasenaUsuario" name="contrasenaUsuario" value="<?php echo $contrasenaUsuario; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <input type="submit" value="<?php echo $id ? 'Guardar Cambios' : 'Aceptar'; ?>" class="btn btn-primary">
                        <input type="button" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='../listas/lista-usuarios.php'">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../rutas/footer.php'; ?>