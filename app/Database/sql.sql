PRAGMA foreign_keys = ON;


CREATE TABLE operateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE
);

CREATE TABLE prefixe (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_operateur INTEGER NOT NULL,
    code TEXT NOT NULL UNIQUE,
    FOREIGN KEY (id_operateur) REFERENCES operateur(id)
);

CREATE TABLE client (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    telephone TEXT NOT NULL UNIQUE
);

CREATE TABLE type_operation (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE
);
CREATE TABLE bareme_frais (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_type_operation INTEGER NOT NULL,
    montant_min INTEGER NOT NULL,
    montant_max INTEGER NOT NULL,
    frais INTEGER NOT NULL,
    FOREIGN KEY (id_type_operation) REFERENCES type_operation(id)
);

CREATE TABLE commission_operateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    operateur_source INTEGER NOT NULL,
    operateur_destination INTEGER NOT NULL,
    commission REAL NOT NULL,

    FOREIGN KEY (operateur_source) REFERENCES operateur(id),
    FOREIGN KEY (operateur_destination) REFERENCES operateur(id)
);

CREATE TABLE operation (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_type_operation INTEGER NOT NULL,
    client_source INTEGER,
    client_destination INTEGER,
    montant INTEGER NOT NULL,
    frais INTEGER NOT NULL DEFAULT 0,
    date_operation DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_type_operation) REFERENCES type_operation(id),
    FOREIGN KEY (client_source) REFERENCES client(id),
    FOREIGN KEY (client_destination) REFERENCES client(id)
);


CREATE TABLE type_mouvement (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE
);


CREATE TABLE mouvement (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_operation INTEGER NOT NULL,
    id_type_mouvement INTEGER NOT NULL,
    montant INTEGER NOT NULL,
    date_mouvement DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_operation) REFERENCES operation(id),
    FOREIGN KEY (id_type_mouvement) REFERENCES type_mouvement(id)
);


INSERT INTO operateur(nom) VALUES
('Orange Money'),
('MVola'),
('Airtel Money');


INSERT INTO prefixe(id_operateur, code) VALUES
(1, '032'),
(1, '037'),
(2, '034'),
(2, '038'),
(3, '033');


INSERT INTO type_operation(nom) VALUES
('Depot'),
('Retrait'),
('Transfert');


INSERT INTO type_mouvement(nom) VALUES
('Debit'),
('Credit');

-- Dépôt (gratuit)
INSERT INTO bareme_frais(id_type_operation, montant_min, montant_max, frais) VALUES
(1, 100, 999999999, 0);

-- Retrait (moins cher)
INSERT INTO bareme_frais(id_type_operation, montant_min, montant_max, frais) VALUES
(2, 100, 1000, 25),
(2, 1001, 5000, 50),
(2, 5001, 10000, 75),
(2, 10001, 25000, 150),
(2, 25001, 50000, 300),
(2, 50001, 100000, 600),
(2, 100001, 250000, 1000),
(2, 250001, 500000, 1200),
(2, 500001, 1000000, 1800),
(2, 1000001, 2000000, 2500);

-- Transfert (plus cher)
INSERT INTO bareme_frais(id_type_operation, montant_min, montant_max, frais) VALUES
(3, 100, 1000, 50),
(3, 1001, 5000, 50),
(3, 5001, 10000, 100),
(3, 10001, 25000, 200),
(3, 25001, 50000, 400),
(3, 50001, 100000, 800),
(3, 100001, 250000, 1500),
(3, 250001, 500000, 1500),
(3, 500001, 1000000, 2500),
(3, 1000001, 2000000, 3000);


-- Total des crédits reçus par client
CREATE VIEW v_credit_client AS
SELECT
    o.client_destination AS id_client,
    SUM(m.montant)        AS total_credit
FROM mouvement m
JOIN operation o       ON o.id = m.id_operation
JOIN type_mouvement tm ON tm.id = m.id_type_mouvement
WHERE tm.nom = 'Credit'
GROUP BY o.client_destination;

-- Total des débits effectués par client
CREATE VIEW v_debit_client AS
SELECT
    o.client_source AS id_client,
    SUM(m.montant)   AS total_debit
FROM mouvement m
JOIN operation o       ON o.id = m.id_operation
JOIN type_mouvement tm ON tm.id = m.id_type_mouvement
WHERE tm.nom = 'Debit'
GROUP BY o.client_source;

-- Solde de chaque client = crédits - débits
CREATE VIEW v_solde_client AS
SELECT
    c.id                                          AS id_client,
    c.nom,
    c.telephone,
    COALESCE(vc.total_credit, 0)
        - COALESCE(vd.total_debit, 0)             AS solde
FROM client c
LEFT JOIN v_credit_client vc ON vc.id_client = c.id
LEFT JOIN v_debit_client  vd ON vd.id_client = c.id;


ALTER TABLE mouvement
ADD COLUMN id_client INTEGER REFERENCES client(id);
INSERT INTO client (nom, telephone) VALUES
('Jean Rakoto', '0321234567'),
('Mamy Andria', '0349876543'),
('Fara Randria', '0331122334'),
('Tiana Rabe', '0375566778'),
('Hery Solo', '0389988776');

ALTER TABLE operation 
ADD telephone_destination VARCHAR(20);

INSERT INTO commission_operateur
(operateur_source, operateur_destination, commission)
VALUES

-- MVola
(2,2,0),
(2,1,2),
(2,3,2),

-- Orange
(1,1,0),
(1,2,2),
(1,3,2),

-- Airtel
(3,3,0),
(3,1,2),
(3,2,2);