 create table regeneration(id primary key AUTO_INCREMENT, mois int);
 create table payement_cueilleurs
 (
    id primary key AUTO_INCREMENT,
    poids_min decimal,
    id_cueilleur int,
    bonus float,
    mallus float
    FOREIGN KEY (id_cueilleur) REFERENCES Cueilleurs(id)
 );

 create table prix_variete
 (
    id primary key AUTO_INCREMENT, 
    montant decimal, 
    id_variete int 
    FOREIGN KEY (id_variete) REFERENCES Varietes_The(id)
 );