DROP DATABASE IF EXISTS LUISDORAO;
CREATE DATABASE LUISDORAO;
USE LUISDORAO;
DROP USER IF EXISTS 'secretaria'@'localhost';
CREATE USER 'secretaria'@'localhost' IDENTIFIED BY 'secretariapass';
GRANT SELECT ON luisdorao.* TO 'secretaria'@'localhost';
CREATE TABLE Cursos (
    id varchar(3) NOT NULL,
    curso_txt varchar(25),
    gasto_material SMALLINT UNSIGNED,
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB;
CREATE TABLE Familias (
    id int(5) not null auto_increment,
    apellido1 varchar(30),
    apellido2 varchar(30),
    email varchar(40),
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB;
CREATE TABLE Alumnos (
    id int(5) not null auto_increment,
    nombre varchar(20),
    id_familia int(5),
    id_curso varchar(3),
    letra varchar(1),
    beca float,
    PRIMARY KEY (id),
    CONSTRAINT FK_id_familia FOREIGN KEY (id_familia) REFERENCES Familias(id),
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
INSERT INTO Familias (apellido1, apellido2, email) VALUES
    ("Alonso", "Albar","alonso.albar@mail.com"),
    ("Balenciaga", "Burgo", "balenciaga.burgo@mail.com"),
    ("Cortes", "Calatrava", "cortes.calatrava@mail.com"),
    ("Davila", "Duran", "davila.duran@mail.com"),
    ("Estevez", "Estebaez", "estevez.estebanez@telefonica.net"),
    ("Fernandez", "Flores", "fernandez.flores@terra.com"),
    ("Garcia", "Gonzalez", "garcia.gonzalez@euskaltel.eus")
    ;
INSERT INTO Alumnos (nombre, id_familia, id_curso, letra) VALUES
    ("Alberto", 1, "LH1", "A"),
    ("Belen", 2, "HH3", "A"),
    ("Carlos", 3, "LH3", "B"),
    ("David", 4, "HH2", "A"),
    ("Elena", 5, "LH6", "B"),
    ("Florentino", 6, "LH4", "A"),
    ("Gema", 7, "HH5", "B")
    ;
