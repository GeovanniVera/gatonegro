<?php include '../rutas/header__servicios.php'; ?>

<div class="page-container">
    <div class="contenedor__lista contenedor">
        <h2>Usuarios</h2>
        <a href="../formularios/Form-Usuario.php" class="btn btn-primary">Agregar</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th colspan="2">Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM Usuarios";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Id"] . "</td>";
                        echo "<td>" . $row["Nombre"] . "</td>";
                        echo "<td>" . $row["Correo_Electronico"] . "</td>";
                        echo "<td><a href='../formularios/Form-Usuario.php?id=" . $row["Id"] . "'><i class='fa-solid fa-pencil pencil'></i></a></td>";
                        echo "<td><a href='../eliminar/Eliminar-usuario.php?id=" . $row["Id"] . "'><i class='fa-solid fa-trash trash'></i></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>0 resultados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../rutas/footer.php'; ?>