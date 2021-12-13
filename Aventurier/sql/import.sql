SET NAMES utf8mb4;

DROP DATABASE IF EXISTS aventuriers;
CREATE DATABASE aventuriers;
USE aventuriers;

CREATE TABLE Competence (
	idCompetence INT(11) NOT NULL,
	libelle VARCHAR(64),
	PRIMARY KEY (idCompetence)
);

CREATE TABLE Aventurier (
	idAventurier INT(11) NOT NULL,
	nomAventurier VARCHAR(64),
	prenomAventurier VARCHAR(64),
	dateNaissance DATE,
	PRIMARY KEY (idAventurier)
);

CREATE TABLE Capacite (
	idAventurier INT(11) NOT NULL,
	idCompetence INT(11) NOT NULL,
	niveau INT DEFAULT 0,
	PRIMARY KEY (idAventurier, idCompetence),
	FOREIGN KEY (idAventurier) REFERENCES Aventurier (idAventurier),
	FOREIGN KEY (idCompetence) REFERENCES Competence (idCompetence)
);

INSERT INTO Competence VALUES
(1, "agilité"),
(2, "intelligence"),
(3, "force");

INSERT INTO Aventurier (idAventurier, nomAventurier, prenomAventurier, dateNaissance) VALUES
(1, 'JAUNE', 'Indiana', '1965-02-14'),
(2, 'LOFT', 'Lara', '1985-05-24'),
(3, 'KOMOR', 'Sarah', '1978-07-17'),
(4, 'MARIANNE', 'Bob', '1972-10-21'),
(5, 'PAULO', 'Marco', '1873-05-24');

INSERT INTO Capacite VALUES
(1, 1, 5),
(1, 2, 2),
(1, 3, 6),

(2, 1, 1),
(2, 2, 5),
(2, 3, 3),

(3, 1, 4),
(3, 2, 3),
(3, 3, 1),

(4, 1, 4),
(4, 2, 9),
(4, 3, 8),

(5, 1, 7),
(5, 2, 5),
(5, 3, 2);
