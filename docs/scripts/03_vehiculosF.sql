use ecommerce

CREATE TABLE Estados(
    id_estado INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50)
);


CREATE TABLE VehiculosF 
(
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    anio INT NOT NULL,
    kilometraje DECIMAL(10,2) NOT NULL,
    id_estado INT NOT NULL,
    asignado  VARCHAR(60) NOT NULL,
    KEY `fk_VehiculosF_Estados_idx` (`id_estado`),
 CONSTRAINT `fk_VehiculosF_Estados` FOREIGN KEY (`id_estado`) REFERENCES `Estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO Estados (id_estado, estado)
VALUES (1, 'Buen estado'),
       (2, 'Necesita reparaciones'),
       (3, 'Necesita mantenimiento'),
       (4, 'En reparación'),
       (5, 'Otro');


-- INSERTAR DATOS EN LA TABLA Vehiculos de flota
INSERT INTO VehiculosF (id_vehiculo, marca, modelo, anio, kilometraje, id_estado, asignado)
VALUES
 (1,'Toyota', 'Corolla', 2019, 35000, 1, 'Juan Pérez'),
 (2,'Ford', 'Focus', 2018, 42000, 2, 'María García'),
(3,'Hyundai','Elantra', 2021, 12000, 1, 'Luis Gutiérrez'),
(4,'Toyota', 'Corolla', 2019, 35000, 1, 'Juan Pérez');

SELECT * FROM VehiculosF;