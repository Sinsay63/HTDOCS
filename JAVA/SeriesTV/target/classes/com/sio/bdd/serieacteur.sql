DROP DATABASE IF EXISTS Serieacteur;
CREATE DATABASE Serieacteur;
USE Serieacteur;

SET names utf8mb4;

CREATE TABLE Serie(
    idSerie int AUTO_INCREMENT,
    nomSerie VARCHAR(50),
    imgCouverture VARCHAR(50),
    dateDiffusion DATE DEFAULT null,
    nbEpisodes int,
    PRIMARY KEY(idSerie)
);

INSERT INTO Serie (idSerie, nomSerie, imgCouverture, dateDiffusion, nbEpisodes) VALUES
    (, 'Lucifer', 'lucifer.jpg', '2016-01-25', 62),
    (, 'Scorpion', 'scorpion.jpg', '2018-04-16', 35);

CREATE TABLE Acteur(
    idActeur int AUTO_INCREMENT,
    prenomActeur VARCHAR(50),
    nomActeur VARCHAR(50),
    PRIMARY KEY (idActeur)
);

INSERT INTO Acteur (idActeur, prenomActeur, nomActeur) VALUES
(1, 'Sébastien', 'Patoche'),
(2, 'Patrick', 'SÃ©bastien');


CREATE TABLE Serie_Acteur (
    idActeur int,
    idSerie int,
    PRIMARY KEY(idActeur,idSerie),
    FOREIGN KEY (idActeur) REFERENCES Acteur(idActeur),
    FOREIGN KEY (idSerie) REFERENCES Serie(idSerie)
); 
