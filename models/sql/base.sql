CREATE TABLE res {
    idres INT PRIMARY KEY NOT NULL,
    desc VARCHAR(100),
    categorie VARCHAR(25),
    localisation VARCHAR(25), -- (batiment,etage,salle)
    idutil INT,
    CONSTRAINT FK_idutilres FOREIGN KEY (idutil)
    REFERENCES utilisateurs(idutil)
};

-- TABLE UTILISATEURS : ADMIN A L'ID 0

CREATE TABLE utilisateurs {
    idutil PRIMARY KEY NOT NULL,
    nom VARCHAR(25),
    prénom VARCHAR(25)
};

CREATE TABLE anomalies {
    idres INT,
    descprobl VARCHAR(25)
    PRIMARY KEY(idres, descprobl),
    CONSTRAINT FK_idresanomalies FOREIGN KEY (idres)
    REFERENCES res(idres)
};


CREATE OR REPLACE VIEW tickets
AS SELECT idres, descprobl, categorie, idutil FROM anomalies, res WHERE anomalies.idres = res.idres;