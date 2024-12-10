CREATE TABLE socios (
    id BIGINT PRIMARY KEY NOT NULL,
    nombre_usuario TEXT NOT NULL,
    contrasena TEXT NOT NULL,
    email TEXT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pistas (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nombre TEXT NOT NULL,
    descripcion TEXT
);

CREATE TABLE reservas (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    socio_id BIGINT NOT NULL,
    pista_id BIGINT NOT NULL,
    fecha_hora TIMESTAMP NOT NULL,
    duracion_minutos INT NOT NULL CHECK (duracion_minutos IN (10, 20, 30)),
    numero_participantes INT NOT NULL CHECK (numero_participantes >= 1 AND numero_participantes <= 10),
    precio_total DECIMAL(10, 2) NOT NULL,
    estado TEXT NOT NULL,
    FOREIGN KEY (socio_id) REFERENCES socios(id),
    FOREIGN KEY (pista_id) REFERENCES pistas(id)
);

CREATE TABLE tiempos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    socio_id BIGINT,
    pista_id BIGINT,
    tiempo TIME NOT NULL,
    fecha TIMESTAMP NOT NULL,
    FOREIGN KEY (socio_id) REFERENCES socios(id),
    FOREIGN KEY (pista_id) REFERENCES pistas(id)
);

CREATE TABLE precios (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    pista_id BIGINT NOT NULL,
    duracion_minutos INT NOT NULL CHECK (duracion_minutos IN (10, 20, 30)),
    precio DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pista_id) REFERENCES pistas(id)
);

INSERT INTO `socios` (`id`, `nombre_usuario`, `contrasena`, `email`, `fecha_registro`) VALUES
(0, 'admin', 'admin', 'admin@karting.com', CURRENT_TIMESTAMP);

-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE socios MODIFY id BIGINT NOT NULL AUTO_INCREMENT;

-- Si necesitas, puedes resetear el valor de AUTO_INCREMENT (opcional)
ALTER TABLE socios AUTO_INCREMENT = 1;

--