-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS agendafa;
USE agendafa;

-- Crear la tabla t_contactos
CREATE TABLE t_contactos (
    id_contacto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    paterno VARCHAR(255),
    materno VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(255),
    fechaInsert DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Información adicional:
-- VARCHAR(255) se utiliza para representar cadenas de caracteres.
-- VARCHAR(20) se ha utilizado para el teléfono, asumiendo que no superará los 20 caracteres.
-- DATETIME para fechaInsert con un valor por defecto de CURRENT_TIMESTAMP para registrar la fecha y hora de inserción.
