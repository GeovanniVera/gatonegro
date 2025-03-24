<?php include '../rutas/header__servicios.php'; ?>

<div class="page-container">
    <div class="contenedor__lista contenedor">
        <h2>Consolas</h2>
        <a href="../formularios/Form-Consolas.php" class="btn btn-primary">Agregar</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Modelo</th>
                    <th>Fecha de Creación</th>
                    <th colspan="2">Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta a la base de datos
                $sql = "SELECT * FROM Consolas";
                $result = $conn->query($sql);

                if ($result) { // Verificar si la consulta se ejecutó correctamente
                    if ($result->num_rows > 0) {
                        // Mostrar los datos
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Id"] . "</td>";
                            echo "<td>" . $row["Nombre"] . "</td>";
                            echo "<td>" . $row["Descripcion"] . "</td>";
                            echo "<td>" . $row["Modelo"] . "</td>";
                            echo "<td>" . $row["Fecha_Creacion"] . "</td>";
                            echo "<td><a href='../formularios/Form-Consolas.php?id=" . $row["Id"] . "'><i class='fa-solid fa-pencil pencil'></i></a></td>";
                            echo "<td><a href='../eliminar/Eliminar-consola.php?id=" . $row["Id"] . "'><i class='fa-solid fa-trash trash'></i></a>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>0 resultados</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Error en la consulta: " . $conn->error . "</td></tr>";
                }

                // Cerrar la conexión cuando hayas terminado
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../rutas/footer.php'; ?>