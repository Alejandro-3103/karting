
<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
    <h1>Actualizar Tiempo</h1>
        <form action="TiemposController.php?action=save_update" method="POST">
            <input type="hidden" name="id" value="<?php echo $tiempo['id']; ?>">
        <div class="mb-3">
            <label class="form-label">Socio:</label>
            <select name="socio_id" class="form-select" required>
                <?php foreach ($socios as $socio): ?>
                <option value="<?php echo $socio['id']; ?>" <?php echo $socio['id'] == $tiempo['socio_id'] ? 'selected' : ''; ?>>
                    <?php echo $socio['nombre_usuario']; ?>
                </option>
                <?php endforeach; ?>
            </select><br>
        </div>
        <div class="mb-3">            
            <label class="form-label">Pista:</label>
            <select name="pista_id" class="form-select" required>
                <?php foreach ($pistas as $pista): ?>
                <option value="<?php echo $pista['id']; ?>" <?php echo $pista['id'] == $tiempo['pista_id'] ? 'selected' : ''; ?>>
                    <?php echo $pista['nombre']; ?>
                </option>
                <?php endforeach; ?>
            </select><br>
        </div>
        <div class="mb-3">
            <label class="form-label">Tiempo:</label>
            <input type="time" name="tiempo" class="form-control" value="<?php echo $tiempo['tiempo']; ?>" required><br>
        </div>
        <div class="mb-3">            
            <label class="form-label">Fecha:</label>
            <input type="datetime-local" name="fecha" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($tiempo['fecha'])); ?>" required><br>
        </div>            
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
    <?php
        adminFooter();
    ?>