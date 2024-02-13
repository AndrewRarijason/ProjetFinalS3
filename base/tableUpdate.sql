-- Table admin
CREATE TABLE Admin(
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR (50),
    mdp VARCHAR (20) 
 );

 insert into Admin(nom,mdp) values('Rasoa', 'rasoa');
 insert into Admin(nom,mdp) values('Rabe', '');

 --Table utilisateur
 CREATE TABLE Utilisateur(
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR (50),
    mdp VARCHAR (20) 
 );
insert into Utilisateur(nom,mdp) values('Randria', 'randria');
insert into Utilisateur(nom,mdp) values('Ravao', 'ravao');

-- Table cueilleurs
CREATE TABLE Cueilleurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    genre VARCHAR(10),
    date_naissance DATE
);
insert into(nom, genre, date_naissance) values("Koloina", "Feminin", "2024-02-13");


-- Tables variétés de thé
CREATE TABLE Varietes_The (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    occupation FLOAT NOT NULL,
    rendement FLOAT NOT NULL
);

-- Table parcelles (de thé)
CREATE TABLE Parcelles 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
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
    montant DECIMAL(8,2) NOT NULL
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

--Table pour les regenerations par saison
create table regeneration(id int AUTO_INCREMENT  primary key, mois int);

--Table payement_cueilleurs
create table payement_cueilleurs
 (
    id int AUTO_INCREMENT  primary key,
    poids_min decimal,
    id_cueilleur int,
    bonus float,
    mallus float,
    FOREIGN KEY (id_cueilleur) REFERENCES Cueilleurs(id)
 );

--Table pour le prix de vente des varietes de the
 create table prix_variete
 (
    id int AUTO_INCREMENT  primary key, 
    montant decimal, 
    id_variete int, 
    FOREIGN KEY (id_variete) REFERENCES Varietes_The(id)
 );

--Vues
CREATE VIEW affichage AS
SELECT Varietes_The.id AS id_variete, Parcelles.id AS id_parcelle, Parcelles.surface
FROM Varietes_The
JOIN Parcelles ON Parcelles.id_the = Varietes_The.id;

CREATE OR REPLACE VIEW v_Prevision AS
SELECT 
   c.date_cueillette as date_cueillette,
    p.id AS id_parcelle,
    p.surface AS surface_totale_parcelle,
    SUM(c.poids_cueilli) AS poids_total_cueilli,
    (p.surface * 10000 / v.occupation) AS nombre_pieds_total,  -- Calcul du nombre total de pieds dans la parcelle
    ((p.surface * 10000 / v.occupation) - SUM(c.poids_cueilli)) AS nombre_pieds_restants,  -- Calcul du nombre de pieds restants
    (p.surface - (SUM(c.poids_cueilli) / v.rendement)) AS surface_occupee_restante,  -- Calcul de la surface occupée restante
    ((p.surface * 10000 / v.occupation) - SUM(c.poids_cueilli)) * pr.montant AS cout_the_restant  -- Calcul du coût du thé restant
FROM 
    Parcelles p
LEFT JOIN 
    Varietes_The v ON p.id_the = v.id
LEFT JOIN 
     prix_variete pr on p.id_the=pr.id_variete
LEFT JOIN
    Cueillettes c ON p.id = c.id_parcelle 
GROUP BY 
    p.id;

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