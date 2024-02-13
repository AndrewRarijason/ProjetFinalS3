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

 create table regeneration(id int AUTO_INCREMENT  primary key, mois int);
 create table payement_cueilleurs
 (
    id int AUTO_INCREMENT  primary key,
    poids_min decimal,
    id_cueilleur int,
    bonus float,
    mallus float,
    FOREIGN KEY (id_cueilleur) REFERENCES Cueilleurs(id)
 );

 create table prix_variete
 (
    id int AUTO_INCREMENT  primary key, 
    montant decimal, 
    id_variete int, 
    FOREIGN KEY (id_variete) REFERENCES Varietes_The(id)
 );

CREATE OR REPLACE VIEW v_montant AS
SELECT C.date_cueillette as date_cueillette, 
       Cr.nom as nom, 
       C.poids_cueilli as poids, 
       P.bonus as bonus, 
       P.mallus as mallus, 
       P.poids_min as poids_min
FROM Cueillettes C
JOIN Cueilleurs Cr ON C.id_cueilleur = Cr.id 
JOIN payement_cueilleurs P on P.id_cueilleur=Cr.id;

CREATE VIEW affichage AS
SELECT Varietes_The.id AS id_variete, Parcelles.id AS id_parcelle, Parcelles.surface
FROM Varietes_The
JOIN Parcelles ON Parcelles.id_the = Varietes_The.id;