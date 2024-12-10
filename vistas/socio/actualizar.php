<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
        <h2>Actualizar Socio</h2>
        <form action="../controladores/SocioController.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id_socio" value="<?php echo $infosocio['id']; ?>">

            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" 
                       value="<?php echo $infosocio['nombre_usuario']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="contraseña" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?php echo $infosocio['email']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="../controladores/SocioController.php?action=list" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <?php
        adminFooter();
    ?>
