<?php
require '../controladores/admin_header_footer.php';  // Incluir las funciones del header y footer

adminHeader();  // Mostrar el header del admin
?>
    <div class="container mt-5">
        <h2>Lista de Pistas</h2>
        <a href="../controladores/PistaController.php?action=insert" class="btn btn-primary mb-3">Agregar Nueva Pista</a>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pistas as $pista): ?>
                        <tr>
                            <td><?php echo $pista['nombre']; ?></td>
                            <td><?php echo $pista['descripcion']; ?></td>
                            <td>
                                <a href="../controladores/PistaController.php?action=update&id=<?php echo $pista['id']; ?>" 
                                class="btn btn-warning btn-sm">Actualizar</a>
                                <a href="../controladores/PistaController.php?action=delete&id=<?php echo $pista['id']; ?>" 
                                class="btn btn-danger btn-sm" 
                                onclick="return confirm('¿Estás seguro de eliminar esta pista?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        adminFooter();
    ?>
