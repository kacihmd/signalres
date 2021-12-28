ALTER TABLE IF EXISTS anomalie DROP CONSTRAINT FK_idticketanoamalie;
DROP TABLE IF EXISTS tickets;
DROP TABLE IF EXISTS anomalie;
DROP TABLE IF EXISTS res;
DROP TABLE IF EXISTS users;

-- TABLE UTILISATEURS : ADMIN A L'ID 0

CREATE TABLE users (
    iduser INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(50),
    mdp VARCHAR(100)
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

-- Si c'est une anomalie crée par un utilisateur
-- On enregistre l'id du ticket à laquelle elle appartient
-- Ajout d'une contraite permettant la supression d'une anomalie relié à un
-- ticket supprimé

ALTER TABLE anomalie ADD CONSTRAINT FK_idticketanoamalie FOREIGN KEY (idticket) 
    REFERENCES tickets(idtickets) ON DELETE CASCADE;

-- INSERTIONS DES UTILISATEURS 

INSERT INTO `users` (`iduser`, `username`, `mdp`) VALUES
-- password
(NULL, 'admin', '$2y$10$bQucALiqBKXPjDpkP4o5XukA4KMKmo2IpzwnjhnlEqW7X5RlOPKga'),
-- kevinpass
(NULL, 'KevinKennedy', '$2y$10$pj1vR7NBm8yyzEH3mZcr.u4P0rg7x0/zdwo3U1yiwowlY06CSH4Hy'),
-- lucypass
(NULL, 'LucyLavie', '$2y$10$ZWks3qUTiJHnk3lcS7iNBemttLaRypdTb5UVsCSN8s8Iu9u3DSQVC'),
-- michelpass
(NULL, 'MichelMarie', '$2y$10$h3yWF4zGJpqAsvEZOUYLXuxcy/PgUul/67CZPvPN2dcjLn/WCtamy'),
-- jeanpass
(NULL, 'JeanJean', '$2y$10$hIoJhd8ySuUyL5L5x78VM.NAdA5.K6ffUKwFxzdEeaiRwBtICmjSG'),
-- dominiquepass
(NULL, 'DominiqueDubois', '$2y$10$stZWLcAIMoRNts9/19bvEeRTHbXYWgkBAk.WcaX1HMrB/VyD4p/62');

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