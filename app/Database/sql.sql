-- Table Produit
CREATE TABLE produit (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    designation TEXT NOT NULL,
    prix REAL NOT NULL,
    quantite_stock INTEGER NOT NULL
);

-- Table Caisse
CREATE TABLE caisse (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    numero TEXT NOT NULL,
    montant REAL DEFAULT 0
);

-- Table Achat
CREATE TABLE achat (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    produit_id INTEGER NOT NULL,
    caisse_id INTEGER NOT NULL,
    quantite INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (produit_id) REFERENCES produit(id),
    FOREIGN KEY (caisse_id) REFERENCES caisse(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE mouvement_stock (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    produit_id INTEGER NOT NULL,
    type_mouvement TEXT NOT NULL, -- ENTREE ou SORTIE
    quantite INTEGER NOT NULL,
    date_mouvement DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (produit_id) REFERENCES produit(id)
);

CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);