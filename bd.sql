-- Crear la base de datos
CREATE DATABASE Tienda;
USE Tienda;

-- Crear la tabla Rol
CREATE TABLE rol (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreRol VARCHAR(50) NOT NULL
);

-- Crear la tabla Usuario
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreUsuario VARCHAR(50) NOT NULL,
    idRol INT NOT NULL,
    FOREIGN KEY (idRol) REFERENCES rol(id)
);

-- Crear la tabla Tipo
CREATE TABLE tipo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreTipo VARCHAR(50) NOT NULL
);

-- Crear la tabla Producto
CREATE TABLE producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    idTipo INT NOT NULL,
    cantidad INT NOT NULL,
    precioUnitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idTipo) REFERENCES tipo(id)
);

-- Crear la tabla Factura
CREATE TABLE factura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    fecha DATETIME NOT NULL,
    descripcion TEXT,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES usuario(id)
);
Inserción de Datos
sql
Copiar código
-- Insertar datos en la tabla Rol
INSERT INTO rol (nombreRol) VALUES 
('Administrador'),
('Vendedor'),
('Cliente');

-- Insertar datos en la tabla Usuario
INSERT INTO usuario (nombreUsuario, idRol) VALUES 
('admin', 1),
('vendedor1', 2),
('vendedor2', 2),
('cliente1', 3),
('cliente2', 3);

-- Insertar datos en la tabla Tipo
INSERT INTO tipo (nombreTipo) VALUES 
('Electrónica'),
('Ropa'),
('Hogar'),
('Alimentos'),
('Juguetes');

-- Insertar datos en la tabla Producto
INSERT INTO producto (nombre, descripcion, idTipo, cantidad, precioUnitario) VALUES 
('Teléfono', 'Teléfono inteligente con pantalla AMOLED', 1, 50, 599.99),
('Camiseta', 'Camiseta de algodón 100%', 2, 100, 19.99),
('Sofá', 'Sofá de 3 plazas, color gris', 3, 10, 299.99),
('Pan', 'Pan fresco horneado diariamente', 4, 200, 1.99),
('Muñeca', 'Muñeca con accesorios y ropa intercambiable', 5, 30, 24.99);

-- Insertar datos en la tabla Factura
INSERT INTO factura (idUsuario, fecha, descripcion, total) VALUES 
(4, '2024-11-01 10:30:00', 'Compra de 1 teléfono', 599.99),
(5, '2024-11-02 14:20:00', 'Compra de 3 camisetas', 59.97),
(4, '2024-11-03 09:00:00', 'Compra de 2 panes', 3.98),
(5, '2024-11-04 16:45:00', 'Compra de 1 sofá', 299.99),
(5, '2024-11-05 18:30:00', 'Compra de 2 muñecas', 49.98);


