--Données test pour insertion
INSERT INTO admin (nom, mdp) VALUES
('Rakoto', 'rakoto');

INSERT INTO the (nom_the, occupation, rendement) VALUES
('Matcha', 1.8, 10);

INSERT INTO parcelle (surface) VALUES
(120);

INSERT INTO cueilleur (nom, genre, dateNaissance) VALUES
('Rasoa', 'feminin', '1997/02/12');

INSERT INTO categorie (categorie) VALUES
('Engrais'),
('Carburant'),
('Logistique');

INSERT INTO depense (id_categorie, montant) VALUES
(1, 25000),
(2, 80000),
(3, 15000);

INSERT INTO salaire (id_cueilleur, montant) VALUES
(1, 50000);

INSERT INTO cueillette (id_cueilleur, id_parcelle, poids) VALUES
(1, 1, 10);

INSERT INTO poids (id_parcelle, poids) VALUES 
(1, 15);

INSERT INTO plantation (id_parcelle, id_the, date_plantation) VALUES
(1, 1, 1, '2024/01/13');