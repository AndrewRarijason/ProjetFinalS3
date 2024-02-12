CREATE DATABASE the;
use the;

-- Table admin
CREATE TABLE Admin(
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR (50),
    mdp VARCHAR (20) 
 );

 --Table utilisateur
 CREATE TABLE Utilisateur(
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR (50),
    mdp VARCHAR (20) 
 );

-- Table cueilleurs
CREATE TABLE Cueilleurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    genre VARCHAR(10),
    date_naissance DATE
);

-- Table variétés de thé
CREATE TABLE Varietes_The (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    occupation FLOAT NOT NULL,
    rendement FLOAT NOT NULL
);

-- Table parcelles (de thé)
CREATE TABLE Parcelles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_parcelle VARCHAR(50),
    surface FLOAT,
    id_the INT,
    FOREIGN KEY (id_the) REFERENCES Varietes_The(id)
);

-- Table dépenses
CREATE TABLE Depenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    montant FLOAT,
    date_depense DATE
);

-- Table salaires des cueilleurs
CREATE TABLE Salaires_cueilleurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cueilleur INT,
    montant DECIMAL(8,2) NOT NULL,
    FOREIGN KEY (id_cueilleur) REFERENCES cueilleurs(id)
);

-- Table pour les cueillettes
CREATE TABLE Cueillettes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_cueillette DATE NOT NULL,
    id_cueilleur INT,
    id_parcelle INT,
    poids_cueilli DECIMAL(8,2) NOT NULL,
    FOREIGN KEY (id_cueilleur) REFERENCES Cueilleurs(id),
    FOREIGN KEY (id_parcelle) REFERENCES Parcelles(id)
);

CREATE VIEW affichage AS
SELECT Varietes_The.id AS id_variete, Parcelles.id AS id_parcelle, Parcelles.surface
FROM Varietes_The
JOIN Parcelles ON Parcelles.id_the = Varietes_The.id;