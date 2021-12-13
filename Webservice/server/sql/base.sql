SET NAMES utf8mb4;

DROP DATABASE IF EXISTS cartesgraphiques;
CREATE DATABASE cartesgraphiques;
USE cartesgraphiques;

CREATE TABLE Marque (
	idMarque INT NOT NULL AUTO_INCREMENT,
	nomMarque VARCHAR(64),
	PRIMARY KEY(idMarque)
);

CREATE TABLE Carte (
	idCarte INT NOT NULL AUTO_INCREMENT,
	nomCarte VARCHAR(64), 
	prix FLOAT,
	idMarque INT,
	PRIMARY KEY(idCarte),
	FOREIGN KEY(idMarque) REFERENCES Marque(idMarque) ON DELETE CASCADE
);

INSERT INTO Marque (idMarque, nomMarque) VALUES
(1, "Nvidia"),
(2, "AMD");

INSERT INTO Carte (idCarte, nomCarte, prix, idMarque) VALUES
(1, "RTX 3070", 500, 1),
(2, "RTX 3060", 410, 1),
(3, "RTX 3080", 720, 1),
(4, "RX6900XT", 1000, 2),
(5, "RX6800XT", 650, 2),
(6, "RX6800", 570, 2);
