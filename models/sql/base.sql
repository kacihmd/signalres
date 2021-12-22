-- TABLE UTILISATEURS : ADMIN A L'ID 0

CREATE TABLE user (
    iduser INT PRIMARY KEY NOT NULL,
    username VARCHAR(50),
    mdp VARCHAR(25)
);

-- TABLE RESSOURCES

CREATE TABLE res (
    idres INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    description VARCHAR(50),
    categorie VARCHAR(10),
    localisation VARCHAR(25), -- (batiment,etage,salle)
    iduser INT,
    CONSTRAINT FK_iduserres FOREIGN KEY (iduser)
    REFERENCES user(iduser)
);

-- TABLE ANOMALIES

CREATE TABLE signal (
    idres INT,
    descprobl VARCHAR(25),
    PRIMARY KEY(idres, descprobl),
    CONSTRAINT FK_idressignal FOREIGN KEY (idres)
    REFERENCES res(idres)
);

-- VUE TICKETS

CREATE OR REPLACE VIEW tickets
AS SELECT res.idres, descprobl, categorie, iduser FROM signal, res WHERE anomalies.idres = res.idres;

-- INSERTIONS DES UTILISATEURS 

INSERT INTO `utilisateurs` (`iduser`, `username`, `mdp`) VALUES
(0, 'admin', 'password'),
(1, 'Kevin Kennedy', 'password'),
(2, 'Lucy Lavie', 'password'),
(3, 'Michel Marie', 'password'),
(4, 'Jean Jean', 'password'),
(5, 'Dominique Dubois', 'password');

-- INSERTIONS DES RESSOURCES

INSERT INTO `res` (`idres`, `description`, `categorie`, `localisation`, `iduser`) VALUES
(1, 'Savon', 'Savon', 'salle U2.2.2', 1),
(2, 'Toilettes', 'Toilettes', '2e étage', 2),
(3, 'Ordinateur portable', 'Ordinateur', 'salle U1.1.43', 3),
(4, 'Lampe de bureau, style ancien', 'Lampe', 'Bureau du directeur', 5),
(5, 'Table', 'Table', 'salle U1.1.43', 3);

-- INSERTIONS DES ANOMALIES

INSERT INTO `signal` (`idres`, `descprobl`) VALUES
(1, 'Ressource vide'),
(2, 'Bouché'),
(3, 'Problème de batterie'),
(4, 'Ampoule défectueuse'),
(5, 'Chewing gum collé');