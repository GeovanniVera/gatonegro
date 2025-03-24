-- Crea la base de datos gamehub si no existe
CREATE DATABASE IF NOT EXISTS lacalledelgatonegro;

-- Crea el usuario gamehub con la contraseña gamehub123
CREATE USER 'lacalledelgatonegro'@'%' IDENTIFIED BY 'lacalledelgatonegro123';

-- Otorga todos los privilegios al usuario gamehub sobre la base de datos gamehub
GRANT ALL PRIVILEGES ON lacalledelgatonegro.* TO 'lacalledelgatonegro'@'%';

-- Actualiza los privilegios
FLUSH PRIVILEGES;

-- usa la base de datos
USE lacalledelgatonegro;

-- Tabla de Usuarios
CREATE TABLE Usuarios (
    Id INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(60) NOT NULL,
    Correo_Electronico VARCHAR(30) NOT NULL,
    Contraseña VARCHAR(20) NOT NULL,
    PRIMARY KEY (Id)
);

-- Tabla de Géneros
CREATE TABLE Generos (
    Id INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(60) NOT NULL,
    Descripcion TEXT(255) NOT NULL,
    PRIMARY KEY (Id)
);

-- Tabla de Consolas
CREATE TABLE Consolas (
    Id INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Descripcion TEXT(255) NOT NULL,
    Modelo VARCHAR(50) NOT NULL,
    Fecha_Creacion DATETIME NOT NULL,
    PRIMARY KEY (Id)
);

-- Tabla de Videojuegos
CREATE TABLE Videojuegos (
    Id INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(60) NOT NULL,
    Descripcion TEXT(255) NOT NULL,
    Genero INT NOT NULL,
    Consola INT NOT NULL,
    Fecha_Lanzamiento DATETIME NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (Genero) REFERENCES Generos(Id),
    FOREIGN KEY (Consola) REFERENCES Consolas(Id)
);