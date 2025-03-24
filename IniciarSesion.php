<?php include 'rutas/header.php'; ?>

<div class="page-container">
    <div class="pagina-sesion">
        <div class="contenedor__sesion contenedor">
            <div class="sesion__right">
                <form method="post" action="sesion.php">
                    <h3 class="sesion__formulario__titulo"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</h3>
                    <input type="text" name="usuario" placeholder="Correo Electrónico" class="sesion__formulario__input" required>
                    <input type="password" name="contraseña" placeholder="Contraseña" class="sesion__formulario__input" required>
                    <button type="submit" class="sesion__formulario__btn btn btn-primary">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'rutas/footer.php'; ?>