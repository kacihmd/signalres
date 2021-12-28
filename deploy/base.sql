ALTER TABLE anomalie DROP CONSTRAINT FK_idticketanoamalie;

DROP TABLE IF EXISTS tickets;
DROP TABLE IF EXISTS anomalie;
DROP TABLE IF EXISTS res;
DROP TABLE IF EXISTS users;

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
    iduser INT DEFAULT 1,
    CONSTRAINT FK_iduserres FOREIGN KEY (iduser) REFERENCES users(iduser)
    ON UPDATE CASCADE ON DELETE SET NULL
);

-- TABLE ANOMALIES

-- Si c'est une anomalie crée par un utilisateur
-- On enregistre l'id du ticket à laquelle elle appartient

CREATE TABLE anomalie (
    idanomalie INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    categorie VARCHAR(25),
    descprobl VARCHAR(100),
    idticket INT
);

-- CREATE TABLE anomalie (
--     idanomalie INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
--     idres INT,
--     descprobl VARCHAR(25),
--     CONSTRAINT FK_idresanomalie FOREIGN KEY (idres) REFERENCES res(idres)
--     ON DELETE CASCADE
-- );

-- VUE TICKETS

CREATE TABLE tickets (
    idtickets INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    idres INT NOT NULL,
    idanomalie INT NOT NULL,
    iduser INT NOT NULL DEFAULT 1,
    signaldate DATETIME,
    CONSTRAINT FK_idresticket FOREIGN KEY (idres) REFERENCES res(idres) 
    ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_idanomalieticket FOREIGN KEY (idanomalie) REFERENCES anomalie(idanomalie) 
    ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_iduserticket FOREIGN KEY (iduser) REFERENCES users(iduser)
    ON DELETE SET DEFAULT ON UPDATE CASCADE
);

-- CREATE OR REPLACE VIEW tickets
-- AS SELECT res.idres, descprobl, categorie, iduser 
-- FROM anomalie, res 
-- WHERE anomalie.idres = res.idres;

-- Si c'est une anomalie crée par un utilisateur
-- On enregistre l'id du ticket à laquelle elle appartient
-- Ajout d'une contraite permettant la supression d'une anomalie relié à un
-- ticket supprimé

ALTER TABLE anomalie ADD CONSTRAINT FK_idticketanoamalie FOREIGN KEY (idticket) 
    REFERENCES tickets(idtickets) ON DELETE CASCADE;

-- INSERTIONS DES UTILISATEURS 

INSERT INTO `users` (`iduser`, `username`, `mdp`) VALUES
(NULL, 'admin', 'password'),
(NULL, 'KevinKennedy', 'password'),
(NULL, 'LucyLavie', 'password'),
(NULL, 'MichelMarie', 'password'),
(NULL, 'JeanJean', 'password'),
(NULL, 'DominiqueDubois', 'password');

-- INSERTIONS DES RESSOURCES

INSERT INTO `res` (`idres`, `description`, `categorie`, `localisation`, `iduser`) VALUES
(NULL, 'Savon Liquide désinfectant', 'Hygiène', 'U2.2.2', 1),
(NULL, 'Papier toilette triple épaisseur', 'Hygiène', 'Salle des professeurs', 2),
(NULL, 'Papier toilette basse qualité', 'Hygiène', 'Bureau des élèves', 5),
(NULL, 'Lampe de bureau noir', 'Lumière', 'Bureau du directeur', 5),
(NULL, 'Set de Feutres 4 couleur tableau blanc', 'Fourniture', 'U1.1.43', 3),
(NULL, 'Set de Craies tableau classique', 'Fourniture', 'U1.1.45', 3);

-- INSERTIONS DES ANOMALIES

INSERT INTO `anomalie` (`idanomalie`, `categorie`, `descprobl`, `idticket`) VALUES
(NULL, 'Hygiène', "Produit d'hygiène en rupture", NULL),
(NULL, 'Hygiène', "Produit d'hygiène périmé", NULL),
(NULL, 'Toilettes', 'Toilettes Bouchées', NULL),
(NULL, 'Toilettes', "Besoin d'un nettoyage", NULL),
(NULL, 'Lumière', 'Ampoule grillée', NULL),
(NULL, 'Fourniture', 'Fourniture en rupture de stock', NULL);