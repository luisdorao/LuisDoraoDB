DROP DATABASE IF EXISTS LUISDORAO_APELLIDOS;
CREATE DATABASE LUISDORAO_APELLIDOS;
USE LUISDORAO_APELLIDOS;
DROP USER IF EXISTS 'secretaria'@'localhost';
CREATE USER 'secretaria'@'localhost' IDENTIFIED BY 'secretariapass';
GRANT SELECT ON LUISDORAO_APELLIDOS.* TO 'secretaria'@'localhost';
CREATE TABLE Cursos (
    id varchar(3) NOT NULL,
    curso_txt varchar(25),
    gasto_material SMALLINT UNSIGNED,
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB;
CREATE TABLE Hermanos (
    id int(5) not null auto_increment,
    apellido1 varchar(30),
    apellido2 varchar(30),
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB;
CREATE TABLE Alumnos (
    id int(5) not null auto_increment,
    nombre varchar(20),
    apellido1 varchar(30),
    apellido2 varchar(30),
    email varchar(40),
    id_curso varchar(3),
    letra varchar(1),
    beca float,
    PRIMARY KEY (id),
    CONSTRAINT FK_id_curso FOREIGN KEY (id_curso) REFERENCES Cursos(id)
    )
    ENGINE=InnoDB;
INSERT INTO Cursos (id, curso_txt, gasto_material) VALUES
    ("HH2", "Haur Hezkuntza 2 Urte", 30),
    ("HH3", "Haur Hezkuntza 3 Urte", 35),
    ("HH4", "Haur Hezkuntza 4 Urte", 40),
    ("HH5", "Haur Hezkuntza 5 Urte", 45),
    ("LH1", "Lehen Hezkuntza 1", 50),
    ("LH2", "Lehen Hezkuntza 2", 60),
    ("LH3", "Lehen Hezkuntza 3", 70),
    ("LH4", "Lehen Hezkuntza 4", 80),
    ("LH5", "Lehen Hezkuntza 5", 90),
    ("LH6", "Lehen Hezkuntza 6", 100)
    ;
/*INSERT INTO Hermanos (apellido1, apellido2, email) VALUES
    (),
    (),
    (),
    (),
    (),
    (),
    ()
    ;*/
INSERT INTO Alumnos (nombre, apellido1, apellido2, email, id_curso, letra, beca) VALUES
    ("Alberto", "Alonso", "Albar", "alonso.albar@mail.com", "LH1", "A", 50),
    ("Belen", "Balenciaga", "Burgo", "balenciaga.burgo@mail.com", "HH3", "A", 0),
    ("Carlos", "Cortes", "Calatrava", "cortes.calatrava@mail.com", "LH3", "B",0 ),
    ("David", "Davila", "Duran", "davila.duran@mail.com", "HH2", "A", 0),
    ("Elena", "Estevez", "Estebaez", "estevez.estebanez@telefonica.net", "LH6", "B", 0),
    ("Florentino", "Fernandez", "Flores", "fernandez.flores@terra.com", "LH4", "A", 0),
    ("Gema", "Garcia", "Gonzalez", "garcia.gonzalez@euskaltel.eus", "HH5", "B", 0)
    ;
