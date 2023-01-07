-- DROP TABLE Client;
-- DROP TABLE Commande;
-- DROP TABLE Item;
-- DROP TABLE Statut_commande;
-- DROP TABLE Point;
-- DROP TABLE Colis;
-- DROP TABLE Adresse;
-- DROP TABLE Facture;
-- DROP TABLE Promotion;
-- DROP TABLE Mode_paiement;
-- DROP TABLE Utilisation_points;
-- DROP TABLE Historique;
-- DROP TABLE Regles_points;
-- DROP TABLE Stock;
-- DROP TABLE Paiement;
-- DROP TABLE relation_commande;
-- DROP TABLE renseigne;
-- DROP TABLE Decrit;
-- DROP TABLE promotion_item;
-- DROP TABLE compose;
-- DROP TABLE contient;
-- DROP TABLE comporte;
-- DROP TABLE definie_par;

CREATE TABLE Client(
   id_client INT AUTO_INCREMENT,
   name VARCHAR(50) ,
   code VARCHAR(50) ,
   adresse_postale VARCHAR(50) ,
   fb VARCHAR(50) ,
   ig VARCHAR(50) ,
   email VARCHAR(50) ,
   phone_number VARCHAR(50) ,
   points VARCHAR(50) ,
   est_platine BOOLEAN,
   PRIMARY KEY(id_client)
);

CREATE TABLE Commande(
   id_order INT AUTO_INCREMENT,
   date_order DATETIME,
   payment_bank DECIMAL(15,2)  ,
   pb_date DATETIME,
   payment_cash DECIMAL(15,2)  ,
   pc_date DATETIME,
   order_status VARCHAR(50) ,
   dispatched_date DATETIME,
   note VARCHAR(50) ,
   frais_service DECIMAL(15,2)  ,
   frais_livraison DECIMAL(15,2)  ,
   id_client INT NOT NULL,
   PRIMARY KEY(id_order),
   FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

CREATE TABLE Item(
   id_item INT AUTO_INCREMENT,
   name_item VARCHAR(50) ,
   description TEXT,
   photo TEXT,
   prix_d_achat DECIMAL(15,2)  ,
   prix_de_vente DECIMAL(15,2),
   PRIMARY KEY(id_item)
);

CREATE TABLE Statut_commande(
   id_status INT AUTO_INCREMENT,
   name_status VARCHAR(50) ,
   PRIMARY KEY(id_status)
);

CREATE TABLE Point(
   id_point INT AUTO_INCREMENT,
   expiration_date DATETIME,
   quantite INT,
   id_client INT NOT NULL,
   PRIMARY KEY(id_point),
   FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

CREATE TABLE Colis(
   id_colis INT AUTO_INCREMENT,
   statut VARCHAR(50) ,
   depart_date DATETIME,
   arrival_date DATETIME,
   PRIMARY KEY(id_colis)
);

CREATE TABLE Adresse(
   id_adresse INT AUTO_INCREMENT,
   numero INT NOT NULL,
   voie VARCHAR(50) ,
   ville VARCHAR(50) ,
   cp VARCHAR(50) ,
   pays VARCHAR(50) ,
   etat VARCHAR(50) ,
   complement TEXT,
   PRIMARY KEY(id_adresse)
);

CREATE TABLE Facture(
   id_facture INT AUTO_INCREMENT,
   date_facture DATE,
   date_maj DATE,
   PRIMARY KEY(id_facture)
);

CREATE TABLE Promotion(
   id_promotion INT AUTO_INCREMENT,
   valeur_promotion INT,
   raison_promotion VARCHAR(50) ,
   date_expiration DATETIME,
   PRIMARY KEY(id_promotion)
);

CREATE TABLE Mode_paiement(
   id_mode_paiement INT AUTO_INCREMENT,
   nom_mode VARCHAR(50) ,
   PRIMARY KEY(id_mode_paiement)
);

CREATE TABLE Utilisation_points(
   id_utilisation INT AUTO_INCREMENT,
   motif_utilisation VARCHAR(50) ,
   quantite_utilisee INT,
   id_point INT NOT NULL,
   PRIMARY KEY(id_utilisation),
   FOREIGN KEY(id_point) REFERENCES Point(id_point)
);

CREATE TABLE Historique(
   id_hist INT AUTO_INCREMENT,
   id_client INT NOT NULL,
   PRIMARY KEY(id_hist),
   UNIQUE(id_client),
   FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

CREATE TABLE Regles_points(
   id_regle INT AUTO_INCREMENT,
   intitule_regle VARCHAR(50) ,
   PRIMARY KEY(id_regle)
);

CREATE TABLE Stock(
   id_stock INT AUTO_INCREMENT ,
   quantite_stock INT,
   type_stock INT,
   id_item INT NOT NULL,
   PRIMARY KEY(id_stock),
   FOREIGN KEY(id_item) REFERENCES Item(id_item)
);

CREATE TABLE Paiement(
   id_paiement INT AUTO_INCREMENT,
   montant DECIMAL(15,2)  ,
   id_mode_paiement INT NOT NULL,
   id_order INT NOT NULL,
   PRIMARY KEY(id_paiement),
   FOREIGN KEY(id_mode_paiement) REFERENCES Mode_paiement(id_mode_paiement),
   FOREIGN KEY(id_order) REFERENCES Commande(id_order)
);

CREATE TABLE relation_commande(
   id_order INT AUTO_INCREMENT,
   id_status INT,
   PRIMARY KEY(id_order, id_status),
   FOREIGN KEY(id_order) REFERENCES Commande(id_order),
   FOREIGN KEY(id_status) REFERENCES Statut_commande(id_status)
);

CREATE TABLE renseigne(
   id_client INT,
   id_adresse INT,
   est_livraison BOOLEAN,
   est_facturation BOOLEAN,
   PRIMARY KEY(id_client, id_adresse),
   FOREIGN KEY(id_client) REFERENCES Client(id_client),
   FOREIGN KEY(id_adresse) REFERENCES Adresse(id_adresse)
);

CREATE TABLE Decrit(
   id_order INT AUTO_INCREMENT,
   id_facture INT,
   PRIMARY KEY(id_order, id_facture),
   FOREIGN KEY(id_order) REFERENCES Commande(id_order),
   FOREIGN KEY(id_facture) REFERENCES Facture(id_facture)
);

CREATE TABLE promotion_item(
   id_item INT AUTO_INCREMENT,
   id_promotion INT,
   PRIMARY KEY(id_item, id_promotion),
   FOREIGN KEY(id_item) REFERENCES Item(id_item),
   FOREIGN KEY(id_promotion) REFERENCES Promotion(id_promotion)
);

CREATE TABLE compose(
   id_item INT,
   id_colis INT,
   quantite INT,
   PRIMARY KEY(id_item, id_colis),
   FOREIGN KEY(id_item) REFERENCES Item(id_item),
   FOREIGN KEY(id_colis) REFERENCES Colis(id_colis)
);

CREATE TABLE contient(
   id_order INT AUTO_INCREMENT,
   id_item INT,
   prix_effectif DECIMAL(15,2)  ,
   quantite INT,
   PRIMARY KEY(id_order, id_item),
   FOREIGN KEY(id_order) REFERENCES Commande(id_order),
   FOREIGN KEY(id_item) REFERENCES Item(id_item)
);

CREATE TABLE comporte(
   id_utilisation INT,
   id_hist INT,
   PRIMARY KEY(id_utilisation, id_hist),
   FOREIGN KEY(id_utilisation) REFERENCES Utilisation_points(id_utilisation),
   FOREIGN KEY(id_hist) REFERENCES Historique(id_hist)
);

CREATE TABLE definie_par(
   id_utilisation INT,
   id_regle INT,
   PRIMARY KEY(id_utilisation, id_regle),
   FOREIGN KEY(id_utilisation) REFERENCES Utilisation_points(id_utilisation),
   FOREIGN KEY(id_regle) REFERENCES Regles_points(id_regle)
);
