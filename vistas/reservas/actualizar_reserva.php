<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <form action="ReservasController.php?action=update" method="POST">
        <h2>Actualizar Reserva</h2>

        <input type="hidden" name="id" value="<?= $reserva['id'] ?>">

        <label for="socio_id">Socio:</label>
        <select name="socio_id" required>
            <?php foreach ($socios as $socio): ?>
                <option value="<?= $socio['id'] ?>" <?= $socio['id'] == $reserva['socio_id'] ? 'selected' : '' ?>>
                    <?= $socio['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="pista_id">Pista:</label>
        <select name="pista_id" required>
            <?php foreach ($pistas as $pista): ?>
                <option value="<?= $pista['id'] ?>" <?= $pista['id'] == $reserva['pista_id'] ? 'selected' : '' ?>>
                    <?= $pista['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="fecha_hora">Fecha y Hora:</label>
        <input type="datetime-local" name="fecha_hora" value="<?= date('Y-m-d\TH:i', strtotime($reserva['fecha_hora'])) ?>" required><br>

        <label for="duracion">Duración:</label>
        <select name="duracion" required>
            <option value="1" <?= $reserva['duracion'] == 1 ? 'selected' : '' ?>>1 Hora</option>
            <option value="2" <?= $reserva['duracion'] == 2 ? 'selected' : '' ?>>2 Horas</option>
            <option value="3" <?= $reserva['duracion'] == 3 ? 'selected' : '' ?>>3 Horas</option>
        </select><br>

        <label for="numero_participantes">Número de Participantes:</label>
        <input type="number" name="numero_participantes" min="1" value="<?= $reserva['numero_participantes'] ?>" required><br>

        <label for="estado">Estado:</label>
        <select name="estado" required>
            <option value="Confirmada" <?= $reserva['estado'] == 'Confirmada' ? 'selected' : '' ?>>Confirmada</option>
            <option value="Pendiente" <?= $reserva['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="Cancelada" <?= $reserva['estado'] == 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
        </select><br>

        <button type="submit">Actualizar Reserva</button>
    </form>
    <?php
        adminFooter();
    ?>
