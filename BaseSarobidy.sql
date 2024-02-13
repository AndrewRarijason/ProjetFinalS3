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
