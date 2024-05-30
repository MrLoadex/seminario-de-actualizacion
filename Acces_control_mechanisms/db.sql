-- Eliminar la base de datos si existe
DROP DATABASE IF EXISTS acces_control_mechanisms_db;

-- Crear la base de datos
CREATE DATABASE acces_control_mechanisms_db;

-- Usar la base de datos
USE acces_control_mechanisms_db;

-- Crear la tabla de usuarios
CREATE TABLE user (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Crear la tabla de equipos (grupos de usuarios)
CREATE TABLE team (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Crear la tabla intermedia para la relación usuario-equipo
CREATE TABLE user_team (
    ID_user INT,
    ID_team INT,
    PRIMARY KEY (ID_user, ID_team),
    FOREIGN KEY (ID_user) REFERENCES user(ID),
    FOREIGN KEY (ID_team) REFERENCES team(ID)
);

-- Crear la tabla de acciones
CREATE TABLE action (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Crear la tabla de relaciones equipo-acción
CREATE TABLE team_action (
    ID_team INT,
    ID_action INT,
    PRIMARY KEY (ID_team, ID_action),
    FOREIGN KEY (ID_team) REFERENCES team(ID),
    FOREIGN KEY (ID_action) REFERENCES action(ID)
);

-- Insertar datos de ejemplo en la tabla de equipos
INSERT INTO team (name) VALUES ('vendedor'), ('cliente');

-- Insertar datos de ejemplo en la tabla de acciones
INSERT INTO action (name) VALUES ('agregarProducto'), ('retirarProducto'), ('pesarProducto'), ('emitirFactura'), ('pedirProductos'), ('pagarFactura');

-- Insertar datos de ejemplo en la tabla de relaciones equipo-acción
INSERT INTO team_action (ID_team, ID_action) VALUES
((SELECT ID FROM team WHERE name = 'vendedor'), (SELECT ID FROM action WHERE name = 'agregarProducto')),
((SELECT ID FROM team WHERE name = 'vendedor'), (SELECT ID FROM action WHERE name = 'retirarProducto')),
((SELECT ID FROM team WHERE name = 'vendedor'), (SELECT ID FROM action WHERE name = 'pesarProducto')),
((SELECT ID FROM team WHERE name = 'vendedor'), (SELECT ID FROM action WHERE name = 'emitirFactura')),
((SELECT ID FROM team WHERE name = 'cliente'), (SELECT ID FROM action WHERE name = 'pedirProductos')),
((SELECT ID FROM team WHERE name = 'cliente'), (SELECT ID FROM action WHERE name = 'pagarFactura'));

-- Insertar datos de ejemplo en la tabla de usuarios
INSERT INTO user (name) VALUES ('Juan Perez'), ('Ana Gomez');

-- Insertar datos de ejemplo en la tabla intermedia usuario-equipo
INSERT INTO user_team (ID_user, ID_team) VALUES
((SELECT ID FROM user WHERE name = 'Juan Perez'), (SELECT ID FROM team WHERE name = 'vendedor')),
((SELECT ID FROM user WHERE name = 'Ana Gomez'), (SELECT ID FROM team WHERE name = 'cliente'));
