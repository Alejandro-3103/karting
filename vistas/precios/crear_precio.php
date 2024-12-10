<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
        <h2>Crear Nuevo Precio</h2>
        <form action="PreciosController.php?action=insert" method="POST">
            <div class="mb-3">
                <label for="pista_id" class="form-label">Seleccionar Pista</label>
                <select class="form-select" name="pista_id" required>
                    <option value="">Selecciona una pista</option>
                    <?php 
                    $pistas = (new modelo_precios())->obtener_pistas();
                    foreach ($pistas as $pista): 
                    ?>
                        <option value="<?php echo $pista['id']; ?>"><?php echo $pista['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración</label>
                <input type="text" class="form-control" name="duracion" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" name="precio" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <?php
        adminFooter();
    ?>


