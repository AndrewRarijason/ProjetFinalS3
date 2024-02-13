--  create table regeneration(id int AUTO_INCREMENT  primary key, mois int);
--  insert into regeneration(mois) values(1);
--  create table payement_cueilleurs
--  (
--     id int AUTO_INCREMENT  primary key,
--     poids_min decimal,
--     id_cueilleur int,
--     bonus float,
--     mallus float,
--     FOREIGN KEY (id_cueilleur) REFERENCES Cueilleurs(id)
--  );
--  insert into payement_cueilleurs(poids_min, id_cueilleur, bonus, mallus) values(5, 1, 3, 2);

--  create table prix_variete
--  (
--     id int AUTO_INCREMENT  primary key, 
--     montant decimal, 
--     id_variete int, 
--     FOREIGN KEY (id_variete) REFERENCES Varietes_The(id)
--  );
--  insert into prix_variete(montant, id_variete) values (400, 1);

-- CREATE OR REPLACE VIEW v_montant AS
-- SELECT C.date_cueillette as date_cueillette, 
--        Cr.nom as nom, 
--        C.poids_cueilli as poids, 
--        P.bonus as bonus, 
--        P.mallus as mallus, 
--        P.poids_min as poids_min
-- FROM Cueillettes C
-- JOIN Cueilleurs Cr ON C.id_cueilleur = Cr.id 
-- JOIN payement_cueilleurs P on P.id_cueilleur=Cr.id;

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

