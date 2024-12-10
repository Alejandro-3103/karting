Karting Web 
Karting Emocion es una aplicación web diseñada para gestionar un circuito de karting de forma moderna y eficiente. Ofrece funcionalidades para socios y administradores, mejorando la experiencia del usuario al facilitar la reserva de pistas y el acceso a información clave.

Características Principales
Para Socios:
Registro y acceso a una cuenta personal.
Reserva de pistas indicando fecha, hora, duración y participantes.
Consulta y comparación de tiempos en un entorno competitivo.

Para Administradores:
Gestión completa de socios, reservas, pistas, tiempos y precios desde un panel visual.
Para Usuarios no registrados:
Acceso a información general del circuito.

Tecnologías Utilizadas
Lenguaje: PHP
Base de datos: MySQL
Frameworks: Bootstrap para diseño responsive

Este proyecto está diseñado para ofrecer comodidad y eficiencia tanto a los usuarios como al personal administrativo del circuito de karting.


//IMPORTANTE!!!!!
Una vez que tengas el proyecto en tu carpeta htdocs esta es la ruta para acceder a la landing page principal para usuarios no logueados:   http://localhost/karting/vistas/index.php
Si quieres entrar al panel del administrador, en el login, tienes que introducir de nombre de usuario admin y de contraseña también admin.  
Si quieres acceder al paner de socios logeados, tendrás que registrar un usuario en la pagina del login en el apartado registrarse, volver al login y logearte con las credenciales con las que te acabas de registrar.               


//Script sql de inserción de datos para probar la aplicación(OPCIONAL): 

-- Insertar datos en la tabla socios
INSERT INTO socios (id, nombre_usuario, contrasena, email, fecha_registro) VALUES
(1, 'usuario1', 'pass123', 'usuario1@example.com', DEFAULT),
(2, 'usuario2', 'pass456', 'usuario2@example.com', DEFAULT),
(3, 'usuario3', 'pass789', 'usuario3@example.com', DEFAULT),
(4, 'usuario4', 'pass101', 'usuario4@example.com', DEFAULT),
(5, 'usuario5', 'pass202', 'usuario5@example.com', DEFAULT);

-- Insertar datos en la tabla pistas
INSERT INTO pistas (nombre, descripcion) VALUES
('Karting Copo', 'Nuestro Karting Copo es un kartódromo fundado en el año 2004 que dispone de 20.000 m2 de superficie en sus instalaciones. La pista tiene un recorrido de casi un kilómetro, con un ancho de pista muy amplio que va desde los 10 a los 12 metros. Su recta más larga supera los 100 metros. Cuenta además con un circuito de educación vial infantil de 2.500 m2.'),
('Karting Roquetas', 'El Karting Roquetas de Mar es un kartódromo fundado en el año 1991 que cuenta con 18.000 m2 de superficie en sus instalaciones. La pista tiene un recorrido de 860 metros con un ancho de pista de entre 8 y 10 metros, amplio y suficiente para disfrutar de adelantamientos. La recta más larga del circuito mide aproximadamente 100 metros'),

-- Insertar datos en la tabla reservas
INSERT INTO reservas (socio_id, pista_id, fecha_hora, duracion_minutos, numero_participantes, precio_total, estado) VALUES
(1, 1, '2024-12-10 10:00:00', 30, 2, 50.00, 'confirmada'),
(2, 2, '2024-12-11 11:00:00', 20, 4, 40.00, 'pendiente'),
(3, 3, '2024-12-12 12:00:00', 10, 1, 20.00, 'cancelada'),
(4, 4, '2024-12-13 13:00:00', 30, 5, 75.00, 'confirmada'),
(5, 5, '2024-12-14 14:00:00', 20, 3, 60.00, 'pendiente');

-- Insertar datos en la tabla tiempos
INSERT INTO tiempos (socio_id, pista_id, tiempo, fecha) VALUES
(1, 1, '00:02:30', '2024-12-10 10:00:00'),
(2, 2, '00:03:15', '2024-12-11 11:00:00'),
(3, 3, '00:04:10', '2024-12-12 12:00:00'),
(4, 4, '00:01:45', '2024-12-13 13:00:00'),
(5, 5, '00:03:50', '2024-12-14 14:00:00');

-- Insertar datos en la tabla precios
INSERT INTO precios (pista_id, duracion_minutos, precio) VALUES
(1, 10, 15.00),
(1, 20, 25.00),
(1, 30, 35.00),
(2, 10, 12.00),
(2, 20, 22.00),
(2, 30, 35.00);






