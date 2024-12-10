<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
        <h1>Lista de Precios</h1>
        <a href="PreciosController.php?action=create" class="btn btn-primary mb-3">Crear Nuevo Precio</a>
        <form action="PreciosController.php?action=search" method="POST" class="mb-3">
            <div class="input-group w-50"> 
                <input type="text" name="pista_nombre" class="form-control" placeholder="Buscar por nombre de pista" required>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Pista</th>
                        <th>Duración</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($precios)): ?>
                        <?php foreach ($precios as $precio): ?>
                            <tr>
                                <td><?php echo $precio['nombre_pista']; ?></td>
                                <td><?php echo $precio['duracion_minutos']; ?> minutos</td>
                                <td><?php echo $precio['precio']; ?> €</td>
                                <td>
                                    <a href="PreciosController.php?action=update&id=<?php echo $precio['id']; ?>" class="btn btn-warning btn-sm">Actualizar</a>
                                    <a href="PreciosController.php?action=delete&id=<?php echo $precio['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No se encontraron precios para esta pista.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        adminFooter();
    ?>

