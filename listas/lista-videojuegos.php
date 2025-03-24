<?php include '../rutas/header__servicios.php'; ?>

<div class="page-container">
    <div class="contenedor__lista contenedor">
        <h2>Videojuegos</h2>
        <a href="../formularios/Form-Videojuegos.php" class="btn btn-primary">Agregar</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de Lanzamiento</th>
                    <th>Género</th>
                    <th>Consola</th>
                    <th colspan="2">Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT v.Id, v.Nombre, v.Descripcion, v.Fecha_Lanzamiento, g.Nombre AS Genero, c.Nombre AS Consola FROM Videojuegos v INNER JOIN Generos g ON v.Genero = g.Id INNER JOIN Consolas c ON v.Consola = c.Id";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Id"] . "</td>";
                        echo "<td>" . $row["Nombre"] . "</td>";
                        echo "<td>" . $row["Descripcion"] . "</td>";
                        echo "<td>" . $row["Fecha_Lanzamiento"] . "</td>";
                        echo "<td>" . $row["Genero"] . "</td>";
                        echo "<td>" . $row["Consola"] . "</td>";
                        echo "<td><a href='../formularios/Form-Videojuegos.php?id=" . $row["Id"] . "'><i class='fa-solid fa-pencil pencil'></i></a></td>";
                        echo "<td><a href='../eliminar/Eliminar-videojuegos.php?id=" . $row["Id"] . "'><i class='fa-solid fa-trash trash'></i></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>0 resultados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../rutas/footer.php'; ?>