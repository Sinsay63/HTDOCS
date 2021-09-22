DROP DATABASE IF EXISTS Serieacteur;
CREATE DATABASE Serieacteur;
USE Serieacteur;

SET names utf8mb4;

CREATE TABLE Serie(
    idSerie int AUTO_INCREMENT,
    nomSerie VARCHAR(50),
    nbSerie int,
    PRIMARY KEY(idSerie)
);

CREATE TABLE Acteur(
    idActeur int AUTO_INCREMENT,
    prenomActeur VARCHAR(50),
    nomActeur VARCHAR(50),
    PRIMARY KEY (idActeur)
);

CREATE TABLE Serie_Acteur (
    idActeur int,
    idSerie int,
    PRIMARY KEY(idActeur,idSerie),
    FOREIGN KEY (idActeur) REFERENCES Acteur(idActeur),
    FOREIGN KEY (idSerie) REFERENCES Serie(idSerie)
); 
