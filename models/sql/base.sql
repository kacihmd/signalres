-- TABLE UTILISATEURS : ADMIN A L'ID 0

CREATE TABLE utilisateurs (
    idutil INT PRIMARY KEY NOT NULL,
    nomutil VARCHAR(10),
    nom VARCHAR(25),
    prénom VARCHAR(25)
);

-- TABLE RESSOURCES

CREATE TABLE res (
    idres INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    description VARCHAR(50),
    categorie VARCHAR(10),
    localisation VARCHAR(25), -- (batiment,etage,salle)
    idutil INT,
    CONSTRAINT FK_idutilres FOREIGN KEY (idutil)
    REFERENCES utilisateurs(idutil)
);

-- TABLE ANOMALIES

CREATE TABLE anomalies (
    idres INT,
    descprobl VARCHAR(25),
    PRIMARY KEY(idres, descprobl),
    CONSTRAINT FK_idresanomalies FOREIGN KEY (idres)
    REFERENCES res(idres)
);

-- VUE TICKETS

CREATE OR REPLACE VIEW tickets
AS SELECT res.idres, descprobl, categorie, idutil FROM anomalies, res WHERE anomalies.idres = res.idres;

-- INSERTIONS DES UTILISATEURS 

INSERT INTO `utilisateurs` (`idutil`, `nomutil`, `nom`, `prénom`) VALUES
(0, 'admin', NULL, NULL),
(1, 'resp1', 'Kevin', 'Kennedy'),
(2, 'resp2', 'Lucy', 'Lavie'),
(3, 'resp3', 'Michel', 'Marie'),
(4, 'resp4', 'Jean', 'Jean'),
(5, 'resp5', 'Dominique', 'Dubois');

-- INSERTIONS DES RESSOURCES

INSERT INTO `res` (`idres`, `description`, `categorie`, `localisation`, `idutil`) VALUES
(1, 'Savon', 'Savon', 'salle U2.2.2', 1),
(2, 'Toilettes', 'Toilettes', '2e étage', 2),
(3, 'Ordinateur portable', 'Ordinateur', 'salle U1.1.43', 3),
(4, 'Lampe de bureau, style ancien', 'Lampe', 'Bureau du directeur', 5),
(5, 'Table', 'Table', 'salle U1.1.43', 3);

-- INSERTIONS DES ANOMALIES

INSERT INTO `anomalies` (`idres`, `descprobl`) VALUES
(1, 'Ressource vide'),
(2, 'Bouché'),
(3, 'Problème de batterie'),
(4, 'Ampoule défectueuse'),
(5, 'Chewing gum collé');