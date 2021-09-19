DROP DATABASE IF EXISTS les_robots;
CREATE DATABASE les_robots;
USE les_robots;

SET NAMES utf8mb4;

CREATE TABLE Entreprise (
    idEntreprise INT AUTO_INCREMENT,
    nom VARCHAR(50),
    dateCreation DATE,
    chiffreAffaires FLOAT,
    PRIMARY KEY(idEntreprise)
);

CREATE TABLE Robot(
    idRobot INT AUTO_INCREMENT,
    libelle VARCHAR(50),
    dateLancement DATE,
    prix FLOAT,
    idFabricant INT,
    PRIMARY KEY(idRobot),
    CONSTRAINT idFabricantFK FOREIGN KEY (idFabricant) REFERENCES Entreprise(idEntreprise) ON DELETE CASCADE
);

INSERT INTO Entreprise(idEntreprise,nom,dateCreation,chiffreAffaires) VALUES
(1,"Robnarok","2040-02-08",2580000000),
(2,"GGL","1998-09-04",5580000000),
(3,"US Robots","2045-01-01",8580000000);

INSERT INTO Robot(idRobot,libelle,dateLancement,prix,idFabricant) VALUES
(1,"BNDR-502","2046-01-08",15000,2),
(2,"RE-D2","2045-02-11",7999.99,3),
(3,"HL-9000","2045-05-28",9450,1);

ALTER TABLE Robot
ADD COLUMN capaciteBatterie FLOAT;

ALTER TABLE Entreprise
MODIFY COLUMN chiffreAffaires DOUBLE;

UPDATE Robot SET capaciteBatterie = 5000 WHERE libelle = "BNDR-502";
UPDATE Robot SET capaciteBatterie = 6050 WHERE libelle = "RE-D2"; 
UPDATE Robot SET capaciteBatterie = 7000 WHERE libelle = "HL-9000";

DELETE FROM Entreprise WHERE nom = "GGL";

ALTER TABLE Robot
DROP FOREIGN KEY idFabricantFK,
DROP COLUMN idFabricant;


CREATE TABLE Entreprise_Robot (
    idEntreprise INT,
    idRobot INT,
    PRIMARY KEY(idEntreprise,idRobot),
    CONSTRAINT idEntrepriseFK FOREIGN KEY (idEntreprise) REFERENCES Entreprise(idEntreprise),
    CONSTRAINT idRobotFK FOREIGN KEY (idRobot) REFERENCES Robot(idRobot)
);