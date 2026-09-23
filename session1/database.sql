CREATE DATABASE automotive_marketplace;
USE automotive_marketplace;

CREATE TABLE dealer (
    id_dealer INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    email VARCHAR(150) NOT NULL
);

CREATE TABLE vehicle_type (
    id_vehicle_type INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL
);

CREATE TABLE vehicle (
    id_vehicle INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    modele VARCHAR(100) NOT NULL,
    est_diesel BOOLEAN NOT NULL,
    id_dealer INT NOT NULL,
    id_vehicle_type INT NOT NULL,

    FOREIGN KEY (id_dealer)
        REFERENCES dealer(id_dealer),

    FOREIGN KEY (id_vehicle_type)
        REFERENCES vehicle_type(id_vehicle_type)
);


INSERT INTO vehicle_type (libelle)
VALUES
('Berline'),
('SUV'),
('Citadine'),
('Coupé'),
('Utilitaire');



INSERT INTO dealer (nom, adresse, ville, telephone, email)
VALUES
('Auto Maroc', '10 Avenue Mohammed V', 'Tanger', '0612345678', 'contact@automaroc.ma'),
('Luxury Cars', '25 Route de Rabat', 'Tanger', '0623456789', 'contact@luxurycars.ma'),
('Cars Center', '15 Rue Ibn Sina', 'Casablanca', '0634567890', 'contact@carscenter.ma');
