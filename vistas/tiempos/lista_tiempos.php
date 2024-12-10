    <?php
        require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

        adminHeader();  // Mostrar el header del admin
    ?>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Tiempos</h1>
        <a href="TiemposController.php?action=create" class="btn btn-primary mb-3">Añadir Tiempo</a>
        <form action="TiemposController.php?action=search" method="POST" class="mb-4">
            <div class="input-group w-50">
                <input type="text" name="nombre_socio" class="form-control" placeholder="Buscar por Nombre de Socio">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        <?php if (count($tiempos) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Socio</th>
                            <th>Pista</th>
                            <th>Tiempo</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?php foreach ($tiempos as $tiempo): ?>
                        <tr>
                            <td><?php echo $tiempo['nombre_socio']; ?></td>
                            <td><?php echo $tiempo['nombre_pista']; ?></td>
                            <td><?php echo $tiempo['tiempo']; ?></td>
                            <td><?php echo $tiempo['fecha']; ?></td>
                            <td>
                                <a href="TiemposController.php?action=update&id=<?php echo $tiempo['id']; ?>" class="btn btn-warning btn-sm">Actualizar</a>
                                <form action="TiemposController.php?action=delete&id=<?php echo $tiempo['id']; ?>" method="POST" style="display:inline;">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este tiempo?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No se encontraron tiempos.</p>
        <?php endif; ?>
    </div>   
    <?php
        adminFooter();
    ?>

