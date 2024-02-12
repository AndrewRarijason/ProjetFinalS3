CREATE DATABASE the;
use the;

CREATE TABLE admin(
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR (50),
    mdp VARCHAR (20) 
 );

 CREATE TABLE the (
    id_the INT AUTO_INCREMENT PRIMARY KEY,
    nom_the VARCHAR (50),
    occupation FLOAT,
    rendement FLOAT
 );

 CREATE TABLE parcelle (
    id_parcelle INT AUTO_INCREMENT PRIMARY KEY,
    surface FLOAT,   
    FOREIGN KEY (id_the) REFERENCES the(id_the)
 );

 CREATE TABLE cueilleur (
    id_cueilleur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR (50),
    genre VARCHAR (10),
    dateNaissance DATE
 );

 CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    categorie VARCHAR (50)
 );

 CREATE TABLE depense (
    id_depense INT AUTO_INCREMENT PRIMARY KEY,
    id_categorie INT,
    montant FLOAT,
    FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie)
 );

 CREATE TABLE salaire (
    id_salaire INT AUTO_INCREMENT PRIMARY KEY,
    id_cueilleur INT,
    montant FLOAT, --salaire /cueillette/cueilleur
    FOREIGN KEY (id_cueilleur) REFERENCES cueilleur (id_cueilleur)
 );

CREATE TABLE cueillette (
    id_cueillette INT AUTO_INCREMENT PRIMARY KEY,
    id_cueilleur INT,
    id_parcelle INT,
    poids FLOAT,
    FOREIGN KEY (id_cueilleur) REFERENCES cueilleur(id_cueilleur),
    FOREIGN KEY (id_parcelle) REFERENCES parcelle (id_parcelle)
);


CREATE TABLE plantation (
   id_plantation INT AUTO_INCREMENT PRIMARY KEY,
   id_parcelle INT,
   id_the INT,
   date_plantation DATE,
   FOREIGN KEY (id_parcelle) REFERENCES parcelle (id_parcelle),
   FOREIGN KEY (id_the) REFERENCES the (id_the)
);