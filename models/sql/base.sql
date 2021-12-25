DROP TABLE IF EXISTS anomalie;
DROP TABLE IF EXISTS res;
DROP TABLE IF EXISTS users;
DROP VIEW IF EXISTS tickets;

-- TABLE UTILISATEURS : ADMIN A L'ID 0

CREATE TABLE users (
    iduser INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
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
    REFERENCES users(iduser)
    ON DELETE CASCADE
);

-- TABLE ANOMALIES

CREATE TABLE anomalie (
    idres INT,
    descprobl VARCHAR(25),
    PRIMARY KEY(idres, descprobl),
    CONSTRAINT FK_idresanomalie FOREIGN KEY (idres)
    REFERENCES res(idres)
    ON DELETE CASCADE
);

-- VUE TICKETS

CREATE OR REPLACE VIEW tickets
AS SELECT res.idres, descprobl, categorie, iduser FROM anomalie, res WHERE anomalie.idres = res.idres;

-- INSERTIONS DES UTILISATEURS 

INSERT INTO `users` (`iduser`, `username`, `mdp`) VALUES
(NULL, 'admin', 'password'),
(NULL, 'Kevin Kennedy', 'password'),
(NULL, 'Lucy Lavie', 'password'),
(NULL, 'Michel Marie', 'password'),
(NULL, 'Jean Jean', 'password'),
(NULL, 'Dominique Dubois', 'password');

-- INSERTIONS DES RESSOURCES

INSERT INTO `res` (`idres`, `description`, `categorie`, `localisation`, `iduser`) VALUES
(1, 'Savon', 'Savon', 'salle U2.2.2', 1),
(2, 'Toilettes', 'Toilettes', '2e étage', 2),
(3, 'Ordinateur portable', 'Ordinateur', 'salle U1.1.43', 3),
(4, 'Lampe de bureau, style ancien', 'Lampe', 'Bureau du directeur', 5),
(5, 'Table', 'Table', 'salle U1.1.43', 3);

-- INSERTIONS DES ANOMALIES

INSERT INTO `anomalie` (`idres`, `descprobl`) VALUES
(1, 'Ressource vide'),
(2, 'Bouché'),
(3, 'Problème de batterie'),
(4, 'Ampoule défectueuse'),
(5, 'Chewing gum collé');