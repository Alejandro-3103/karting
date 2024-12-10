<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
        <h1>Lista de Reservas</h1>
        <a href="ReservasController.php?action=create" class="btn btn-primary mb-3">Crear Nueva Reserva</a>
        <form method="POST" action="ReservasController.php?action=search" class="mb-3">
            <div class="input-group w-50">
                <input type="text" name="search_query" class="form-control" placeholder="Buscar por nombre de socio o pista" />
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Socio</th>
                        <th>Pista</th>
                        <th>Fecha y hora</th>
                        <th>Duración</th>
                        <th>Participantes</th>
                        <th>Precio Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td><?php echo $reserva['nombre_socio']; ?></td>
                        <td><?php echo $reserva['nombre_pista']; ?></td>
                        <td><?php echo $reserva['fecha_hora']; ?></td>
                        <td><?php echo $reserva['duracion_minutos']; ?> minutos</td>
                        <td><?php echo $reserva['numero_participantes']; ?></td>
                        <td><?php echo $reserva['precio_total']; ?> €</td>
                        <td><?php echo $reserva['estado']; ?></td>
                        <td>
                            <form action="ReservasController.php?action=delete&id=<?php echo $reserva['id']; ?>" method="POST">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta reserva?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <div class="table-responsive">
    </div>
    <?php
        adminFooter();
    ?>

