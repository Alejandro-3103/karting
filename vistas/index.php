<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Karting Emoción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Css/index.css">
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
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#caracteristicas">Características</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                    <li class="nav-item"><a href="../vistas/socio/login.php" class="btn btn-outline-light">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="hero-section" id="inicio">
        <div>
            <h1>¡Bienvenidos a Karting Emoción!</h1>
            <p>Vive la adrenalina en cada curva</p>
            <a href="../vistas/socio/login.php" class="btn">¡Únete ahora!</a>
        </div>
    </section>
<main>
    <section id="servicios">
    <div class="container">
        <h2 class="text-center section-title mb-5">Nuestros Servicios</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-box bg-white">
                    <i class="fas fa-flag-checkered fa-3x mb-3 icon-carrera"></i> <!-- Clase personalizada -->
                    <h3>Carreras Individuales</h3>
                    <p>Compite contra el reloj y mejora tus tiempos personales.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box bg-white">
                    <i class="fas fa-users fa-3x mb-3 icon-evento"></i> <!-- Clase personalizada -->
                    <h3>Eventos Grupales</h3>
                    <p>Organiza competiciones con amigos, familia o compañeros de trabajo.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box bg-white">
                    <i class="fas fa-graduation-cap fa-3x mb-3 icon-escuela"></i> <!-- Clase personalizada -->
                    <h3>Escuela de Karting</h3>
                    <p>Aprende técnicas avanzadas con nuestros instructores profesionales.</p>
                </div>
            </div>
        </div>
    </div>
    </section>

    <h2 class="text-center section-title mt-5">Nuestras Pistas</h2>

    <!-- Primera sección: Carrusel a la izquierda y descripción a la derecha -->
    <section class="section-carrusel-info mt-5">
        <div class="carousel-container">
            <div id="carouselExample1" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../img/kartingcopo03.png" class="d-block w-100" alt="Karting 1">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/kartingcopo04.png" class="d-block w-100" alt="Karting 2">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/kartingcopo06.png" class="d-block w-100" alt="Karting 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample1" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample1" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="description-container">
            <h2>900 metros de adrenalina</h2>
            <p>Nuestro Karting Copo es un kartódromo fundado en el año 2004 que dispone de 20.000 m2 de superficie en sus instalaciones. La pista tiene un recorrido de casi un kilómetro, con un ancho de pista muy amplio que va desde los 10 a los 12 metros. Su recta más larga supera los 100 metros. Cuenta además con un circuito de educación vial infantil de 2.500 m2.</p>
        </div>
    </section>

    <!-- Segunda sección: Carrusel a la derecha y descripción a la izquierda -->
    <section class="section-carrusel-reversed">
        <div class="description-container">
            <h2>¡Únete a la diversión!</h2>
            <p>El Karting Roquetas de Mar es un kartódromo fundado en el año 1991 que cuenta con 18.000 m2 de superficie en sus instalaciones. La pista tiene un recorrido de 860 metros con un ancho de pista de entre 8 y 10 metros, amplio y suficiente para disfrutar de adelantamientos. La recta más larga del circuito mide aproximadamente 100 metros.</p>
        </div>

        <div class="carousel-container">
            <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../img/karting-roquetas-01.jpg" class="d-block w-100" alt="Karting 4">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/karting-roquetas-02.jpg" class="d-block w-100" alt="Karting 5">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/karting-roquetas-03.jpg" class="d-block w-100" alt="Karting 6">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section id="caracteristicas" class="py-5 mt-5">
        <div class="container">
            <h2 class="text-center section-title">¿Por qué elegirnos?</h2>
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-tachometer-alt feature-icon"></i>
                    <h3>Karts de última generación</h3>
                    <p>Disfruta de nuestros karts eléctricos de alto rendimiento y bajo impacto ambiental.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h3>Seguridad garantizada</h3>
                    <p>Nuestras pistas cuentan con las últimas medidas de seguridad para tu tranquilidad.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-trophy feature-icon"></i>
                    <h3>Competiciones emocionantes</h3>
                    <p>Participa en nuestros torneos mensuales y demuestra que eres el mejor piloto.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="precios" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Nuestros Precios</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Sesión Individual</h3>
                            <h4 class="card-subtitle mb-2 text-muted">20€</h4>
                            <p class="card-text">30 minutos de diversión en cualquiera de nuestras pistas.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Equipo de seguridad incluido</li>
                                <li><i class="fas fa-check text-success"></i> Briefing de seguridad</li>
                                <li><i class="fas fa-check text-success"></i> Tiempo de práctica</li>
                            </ul>
                            <a href="../vistas/socio/login.php" class="btn btn-primary">Reservar ahora</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Pack Familiar</h3>
                            <h4 class="card-subtitle mb-2 text-muted">60€</h4>
                            <p class="card-text">4 sesiones de 20 minutos para toda la familia, con toda la pista a su disposición.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Ideal para 2 adultos y 2 niños</li>
                                <li><i class="fas fa-check text-success"></i> Karts adaptados para niños</li>
                                <li><i class="fas fa-check text-success"></i> Foto de recuerdo incluida</li>
                            </ul>
                            <a href="../vistas/socio/login.php" class="btn btn-primary">Reservar ahora</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Bono 10 Sesiones</h3>
                            <h4 class="card-subtitle mb-2 text-muted">150€</h4>
                            <p class="card-text">Ahorra con nuestro bono de 10 sesiones de 30 minutos.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> 25% de descuento</li>
                                <li><i class="fas fa-check text-success"></i> Válido por 6 meses</li>
                                <li><i class="fas fa-check text-success"></i> Transferible</li>
                            </ul>
                            <a href="../vistas/socio/login.php" class="btn btn-primary">Comprar bono</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="reserva" class="cta-section">
        <div class="container text-center">
            <h2>¿Listo para la acción?</h2>
            <p class="lead">Reserva tu sesión ahora y prepárate para la adrenalina</p>
            <a href="../vistas/socio/login.php" class="btn btn-light btn-lg">Hacer reserva</a>
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
        <!-- Bootstrap JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>




