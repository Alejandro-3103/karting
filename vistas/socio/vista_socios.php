<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Socios</h2>
        <form action="SocioController.php?action=search" method="POST" class="mb-4">
            <div class="input-group w-50">
                <input type="text" name="nombre_usuario" class="form-control" placeholder="Buscar por Nombre de Usuario">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre de Usuario</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($socios) > 0): ?>
                        <?php foreach ($socios as $socio): ?>
                            <tr>
                                <td><?php echo $socio['nombre_usuario']; ?></td>
                                <td><?php echo $socio['email']; ?></td>
                                <td>
                                    <a href="SocioController.php?action=update&id_socio=<?php echo $socio['id']; ?>" 
                                    class="btn btn-warning btn-sm">Actualizar</a>
                                    <a href="SocioController.php?action=delete&id_socio=<?php echo $socio['id']; ?>" 
                                    class="btn btn-danger btn-sm" 
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este socio?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">No se encontraron socios.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        adminFooter();
    ?>





