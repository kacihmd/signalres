CREATE TABLE res {
    idres
    desc
    categorie
    localisation (batiment,etage,salle)
    respid
};

-- TABLE UTILISATEURS : ADMIN A L'ID 0

CREATE TABLE utilisateurs {
    idutil INT,
    reuizbeifb
};

CREATE TABLE anomalies {
    idres INT,
    descprobl
};


CREATE OR REPLACE VIEW tickets
AS SELECT idres, descprobl, categorie, idutil FROM anomalies, res WHERE anomalies.idres = res.idres;