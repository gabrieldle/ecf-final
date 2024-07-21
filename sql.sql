-- Création de la base de données
CREATE DATABASE ZooArcadia;
USE ZooArcadia;

-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'veterinaire', 'employe') NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des animaux
CREATE TABLE animaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    espece VARCHAR(100) NOT NULL,
    description TEXT,
    date_arrivee DATE,
    habitat VARCHAR(100),
    nombre_vues INT DEFAULT 0
);

-- Table des sections du zoo
CREATE TABLE sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT
);

-- Table des animaux par section
CREATE TABLE animaux_sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT,
    section_id INT,
    FOREIGN KEY (animal_id) REFERENCES animaux(id),
    FOREIGN KEY (section_id) REFERENCES sections(id)
);

-- Table des services
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    section_id INT,
    FOREIGN KEY (section_id) REFERENCES sections(id)
);

-- Table des visites
CREATE TABLE visites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    animal_id INT,
    date_visite TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (animal_id) REFERENCES animaux(id)
);

-- Table des commentaires des visiteurs
CREATE TABLE commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    animal_id INT,
    commentaire TEXT,
    date_commentaire TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (animal_id) REFERENCES animaux(id)
);

-- Table de l'historique des actions des utilisateurs (pour la gestion des accès)
CREATE TABLE historique_actions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    action VARCHAR(255),
    date_action TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- Insertion des données de base

-- Utilisateurs
INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES
('Doe', 'John', 'john.doe@example.com', 'password_hash', 'veterinaire'),
('Smith', 'Anna', 'anna.smith@example.com', 'password_hash', 'employe'),
('Admin', 'Super', 'admin@example.com', 'password_hash', 'admin');

-- Sections du zoo
INSERT INTO sections (nom, description) VALUES
('Savane', 'Section dédiée aux animaux de la savane.'),
('Jungle', 'Section dédiée aux animaux de la jungle.'),
('Marais', 'Section dédiée aux animaux des marais.');

-- Animaux
INSERT INTO animaux (nom, espece, description, date_arrivee, habitat) VALUES
('Simba', 'Lion', 'Le roi de la savane.', '2020-01-15', 'Savane'),
('Baloo', 'Ours', 'Un ours sympathique de la jungle.', '2018-05-20', 'Jungle'),
('Croc', 'Crocodile', 'Un grand crocodile des marais.', '2019-03-22', 'Marais');

-- Services
INSERT INTO services (nom, description, section_id) VALUES
('Petit train', 'Service de transport à travers le zoo.', 1),
('Visite guidée', 'Visite guidée de la jungle.', 2),
('Nourrissage des animaux', 'Participez au nourrissage des animaux des marais.', 3);

-- Assignation des animaux aux sections
INSERT INTO animaux_sections (animal_id, section_id) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Déclencheurs (triggers) pour mise à jour du nombre de vues
DELIMITER $$
CREATE TRIGGER incrementer_nombre_vues
AFTER INSERT ON visites
FOR EACH ROW
BEGIN
    UPDATE animaux SET nombre_vues = nombre_vues + 1 WHERE id = NEW.animal_id;
END$$
DELIMITER ;

-- Vue pour la liste des animaux et leurs sections
CREATE VIEW vue_animaux_sections AS
SELECT a.nom AS animal_nom, a.espece, s.nom AS section_nom
FROM animaux a
JOIN animaux_sections as2 ON a.id = as2.animal_id
JOIN sections s ON as2.section_id = s.id;
