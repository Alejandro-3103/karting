
<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
        <h2>Actualizar Precio</h2>
        <form action="PreciosController.php?action=save_update" method="POST">
            <input type="hidden" name="id" value="<?php echo $precio['id']; ?>">

            <!-- Pista ID como select -->
            <div class="mb-3">
                <label for="pista_id" class="form-label">Seleccionar Pista</label>
                <select class="form-select" name="pista_id" required>
                    <?php 
                    // Obtenemos todas las pistas
                    $pistas = (new modelo_precios())->obtener_pistas();
                    foreach ($pistas as $pista): 
                    ?>
                        <option value="<?php echo $pista['id']; ?>" 
                            <?php echo $pista['id'] == $precio['pista_id'] ? 'selected' : ''; ?>>
                            <?php echo $pista['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración</label>
                <input type="text" class="form-control" name="duracion" value="<?php echo $precio['duracion_minutos']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" name="precio" value="<?php echo $precio['precio']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
    <?php
        adminFooter();
    ?>

