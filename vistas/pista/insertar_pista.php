<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
        <h2>Agregar Nueva Pista</h2>
        <form action="../controladores/PistaController.php" method="POST">
            <input type="hidden" name="action" value="insert">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="../controladores/PistaController.php?action=list" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <?php
        adminFooter();
    ?>
