<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Css/usuario.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">Karting Emoción</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#pistas">Pistas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#precios">Precios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tiempos">Tiempos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#reservas">Reservas</a></li>
                        <li class="nav-item"><a href="../vistas/logout.php" class="btn btn-danger">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
    </nav>
    <main>
        <div class="container mt-5">        
           <!-- Sección de Pistas -->
           <section id="pistas">
            <div class="mt-5 pt-4">
                <h2 class="text-center display-5 fw-bold text-primary">🏁 Pistas Disponibles 🏁</h2>
                <p class="text-center text-muted fs-5 mb-5">Descubre nuestras emocionantes pistas y elige tu favorita para vivir una experiencia inolvidable.</p>
                <div class="row justify-content-center g-4">
                    <?php foreach (array_chunk($pistas, 2) as $pista_row): ?>
                    <div class="row justify-content-center">
                        <?php foreach ($pista_row as $pista): ?>
                        <div class="col-md-5 mx-2">
                            <div class="card pista-card border-primary shadow-sm h-100">
                                <div class="card-header bg-primary text-white text-center">
                                    <h5 class="card-title m-0 fs-4"><?php echo $pista['nombre']; ?></h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-secondary fs-5">
                                        <strong>Descripción:</strong> <?php echo $pista['descripcion']; ?>
                                    </p>
                                </div>
                                <div class="card-footer bg-light text-center">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section> 
        <!-- Sección de Precios -->
        <section id="precios">
            <div class="mt-5 pt-4">
                <h2 class="text-center display-5 fw-bold text-success">💰 Precios por Duración 💰</h2>
                <p class="text-center text-muted fs-5 mb-4">Elige una opción que se adapte a tu tiempo y presupuesto. ¡Precios inmejorables!</p>
                <div class="row g-4">
                    <?php foreach ($precios as $precio): ?>
                    <div class="col-md-4">
                        <div class="card precio-card border-success shadow-sm h-100">
                            <div class="card-header bg-success text-white text-center">
                                <h5 class="card-title m-0 fs-4"><?php echo $precio['nombre_pista']; ?></h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-secondary fs-5">
                                    <strong>Duración:</strong> <?php echo $precio['duracion_minutos']; ?> minutos
                                </p>
                                <p class="card-text text-secondary fs-5">
                                    <strong>Precio:</strong> <?php echo $precio['precio']; ?> € por persona
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>                
        <!-- Sección de Tiempos -->
        <section id="tiempos">
            <div class="mt-5 pt-4">
                <h2 class="text-center display-5 fw-bold text-warning">⏱️ Tiempos Registrados ⏱️</h2>
                <p class="text-center text-muted fs-5 mb-4">Consulta los mejores tiempos de cada pista y compite para superarlos.</p>

                <?php 
                // Agrupar los tiempos por pista
                $tiemposPorPista = [];
                foreach ($tiempos as $tiempo) {
                    $tiemposPorPista[$tiempo['nombre_pista']][] = $tiempo;
                }

                // Usuario logueado
                $usuarioLogueado = $_SESSION['nombre_usuario']; 
                ?>

                <?php foreach ($tiemposPorPista as $nombrePista => $tiemposPista): ?>
                <div class="mt-4">
                    <h3 class="text-primary text-center"><?php echo $nombrePista; ?></h3>
                    <table class="table table-striped table-hover">
                        <thead class="table-warning">
                            <tr>
                                <th class="text-center">⏲️ Tiempo (minutos)</th>
                                <th class="text-center">👤 Socio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tiemposPista as $tiempo): ?>
                            <tr <?php if ($tiempo['nombre_socio'] === $usuarioLogueado) echo 'style="background-color: #d1f7d6; font-weight: bold;"'; ?>>
                                <td class="text-center"><?php echo $tiempo['tiempo']; ?></td>
                                <td class="text-center">
                                    <?php echo $tiempo['nombre_socio']; ?>
                                    <?php if ($tiempo['nombre_socio'] === $usuarioLogueado): ?>
                                        <span class="badge bg-success ms-2">¡Tú!</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- Sección de Reservas -->
        <section id="reservas">
            <div class="mt-5 pt-4">
                <h2 class="text-center display-5 fw-bold text-warning">📅 Mis Reservas 📅</h2>
                <p class="text-center text-muted fs-5 mb-4">Consulta el estado de tus reservas y gestiona tus próximas experiencias en nuestras pistas.</p>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-warning">
                            <tr class="text-center">
                                <th>Pista</th>
                                <th>Fecha y Hora</th>
                                <th>Duración</th>
                                <th>Participantes</th>
                                <th>Precio Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mis_reservas as $reserva): ?>
                            <tr class="text-center">
                                <td><?php echo $reserva['nombre_pista']; ?></td>
                                <td><?php echo date('d-m-Y H:i', strtotime($reserva['fecha_hora'])); ?></td>
                                <td><?php echo $reserva['duracion_minutos']; ?> minutos</td>
                                <td><?php echo $reserva['numero_participantes']; ?></td>
                                <td><?php echo number_format($reserva['precio_total'], 2); ?> €</td>
                                <td>
                                    <?php if ($reserva['estado'] === 'pendiente'): ?>
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    <?php elseif ($reserva['estado'] === 'confirmada'): ?>
                                        <span class="badge bg-success">Confirmada</span>
                                    <?php elseif ($reserva['estado'] === 'cancelada'): ?>
                                        <span class="badge bg-danger">Cancelada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($reserva['estado'] === 'pendiente'): ?>
                                        <!-- Botones para confirmar o cancelar -->
                                        <form action="UsuarioController.php?action=update_estado&id=<?php echo $reserva['id']; ?>&estado=confirmar" method="POST" class="d-inline">
                                            <button type="submit" class="btn btn-success btn-sm">Confirmar</button>
                                        </form>
                                        <form action="UsuarioController.php?action=update_estado&id=<?php echo $reserva['id']; ?>&estado=cancelar" method="POST" class="d-inline">
                                            <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($mis_reservas)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">No tienes reservas registradas. ¡Haz tu primera reserva ahora!</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Formulario para Realizar Reservas -->
            <div class="mt-5 pt-4 pb-4">
                <h2 class="text-center display-5 fw-bold text-info">📋 Realizar Nueva Reserva 📋</h2>
                <p class="text-center text-muted fs-5 mb-4">Selecciona tu pista favorita, elige el horario y disfruta de la mejor experiencia.</p>

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form action="UsuarioController.php?action=insert_reserva" method="POST" class="p-4 shadow-lg rounded bg-light">
                            <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                            <div class="mb-3">
                                <label for="pista_id" class="form-label fs-5">Seleccionar Pista</label>
                                <select id="pista_id" name="pista_id" class="form-select" required>
                                    <option value="" disabled selected>Selecciona una pista</option>
                                    <?php foreach ($pistas as $pista): ?>
                                    <option value="<?php echo $pista['id']; ?>"><?php echo $pista['nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_hora" class="form-label fs-5">Fecha y Hora</label>
                                <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="duracion_minutos" class="form-label fs-5">Duración (en minutos)</label>
                                <select id="duracion_minutos" name="duracion_minutos" class="form-select" required>
                                    <option value="" disabled selected>Selecciona la duración</option>
                                    <option value="10">10 minutos</option>
                                    <option value="20">20 minutos</option>
                                    <option value="30">30 minutos</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="numero_participantes" class="form-label fs-5">Número de Participantes</label>
                                <input type="number" id="numero_participantes" name="numero_participantes" class="form-control" min="1" max="10" required>
                                <small class="text-muted">El número de participantes no puede ser superior a 10.</small>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Reservar Ahora</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer id="contacto" class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h3>Karting Emoción</h3>
                        <p>La mejor experiencia de karting en la ciudad.</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h3>Contacto</h3>
                        <p><i class="fas fa-map-marker-alt"></i> Calle Principal 123, Ciudad</p>
                        <p><i class="fas fa-phone"></i> +34 123 456 789</p>
                        <p><i class="fas fa-envelope"></i> info@kartingemocion.com</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h3>Síguenos</h3>
                        <a href="#" class="text-light me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
