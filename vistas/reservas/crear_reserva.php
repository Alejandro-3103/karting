<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
        <h1>Crear Reserva</h1>
        <form action="ReservasController.php?action=insert" method="POST">
        <div class="mb-3">
            <label for="socio_id" class="form-label">Usuario:</label>
            <select name="socio_id" id="socio_id" class="form-select" required>
                <option value="">Seleccione un usuario</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre_usuario']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="pista_id" class="form-label">Pista:</label>
            <select name="pista_id" id="pista_id" class="form-select" required>
                <option value="">Seleccione una pista</option>
                <?php foreach ($pistas as $pista): ?>
                    <option value="<?php echo $pista['id']; ?>"><?php echo $pista['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora:</label>
            <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="duracion_minutos" class="form-label">Duración:</label>
            <select name="duracion_minutos" id="duracion_minutos" class="form-select" required>
                <option value="10">10 minutos</option>
                <option value="20">20 minutos</option>
                <option value="30">30 minutos</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="numero_participantes" class="form-label">Número de Participantes:</label>
            <input type="number" name="numero_participantes" id="numero_participantes" min="1" max="10" class="form-control" required>
        </div>
            <button type="submit" class="btn btn-primary">Crear Reserva</button>
        </form>
    </div>
    <?php
        adminFooter();
    ?>

