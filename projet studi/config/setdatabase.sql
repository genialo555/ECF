-- Création de la base de données
CREATE DATABASE IF NOT EXISTS `zoo_arcadia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zoo_arcadia`;

-- Table des utilisateurs
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee','veterinarian') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des services
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des habitats
CREATE TABLE `habitats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertion des habitats
INSERT INTO `habitats` (`name`) VALUES
('Savane africaine'),
('Forêt tropicale'),
('Banquise arctique'),
('Forêt tempérée'),
('Désert'),
('Récif corallien'),
('Prairie'),
('Montagne'),
('Côte pacifique');

-- Table des animaux
CREATE TABLE `animals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `species` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `habitat` varchar(255) NOT NULL,
  `diet` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `nourritureProposee` varchar(255) NOT NULL,
  `grammageNourriture` int(11) NOT NULL,
  `datePassage` date NOT NULL,
  `detailEtat` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertion des animaux
INSERT INTO `animals` (`name`, `firstName`, `species`, `image`, `habitat`, `diet`, `etat`, `nourritureProposee`, `grammageNourriture`, `datePassage`, `detailEtat`) VALUES
("Lion d'Afrique", "Léo", "Panthera leo", "https://en.wikipedia.org/wiki/Lion#/media/File:Okonjima_Lioness.jpg", "Savane africaine", "carnivore", "Bon", "Viande de boeuf", 6000, "2024-07-21", "Léo est en bonne santé. Son pelage est brillant et il est actif."),
("Gorille des plaines", "Georges", "Gorilla gorilla", "https://en.wikipedia.org/wiki/Gorilla#/media/File:Gorille_des_plaines_de_l'ouest_%C3%A0_l'Espace_Zoologique.jpg", "Forêt tropicale", "herbivore", "Moyen", "Fruits et légumes", 15000, "2024-07-22", "Georges montre des signes de stress léger."),
("Ours polaire", "Boris", "Ursus maritimus", "https://en.wiktionary.org/wiki/ours_polaire#/media/File:Polar_Bear_AdF.jpg", "Banquise arctique", "carnivore", "Excellent", "Poisson frais", 10000, "2024-07-23", "Boris est en excellente condition physique."),
("Éléphant d'Afrique", "Dumbo", "Loxodonta africana", "https://en.wiktionary.org/wiki/elephant#/media/File:Elephant_near_ndutu.jpg", "Savane africaine", "herbivore", "Bon", "Foin et fruits", 150000, "2024-07-24", "Dumbo est en bonne santé. Ses défenses sont en bon état."),
("Pingouin empereur", "Pipo", "Aptenodytes forsteri", "https://en.wiktionary.org/wiki/ping%C3%BCino#/media/File:Adelie_Penguin.jpg", "Banquise arctique", "carnivore", "Moyen", "Poisson et krill", 1000, "2024-07-25", "Pipo a une légère blessure à la nageoire."),
("Toucan toco", "Toco", "Ramphastos toco", "https://en.wiktionary.org/wiki/toco_toucan#/media/File:Tucano_01.jpg", "Forêt tropicale", "omnivore", "Bon", "Fruits et insectes", 200, "2024-07-26", "Toco est en bonne santé. Son bec est en excellent état."),
("Phoque annelé", "Flipper", "Pusa hispida", "https://en.wiktionary.org/wiki/Histriophoca_fasciata#/media/File:Male_Ribbon_Sea_Ozernoy_Gulf_Russia.jpg", "Banquise arctique", "carnivore", "Excellent", "Poisson frais", 3000, "2024-07-27", "Flipper est très actif et en excellente santé."),
("Cerf élaphe", "Bambi", "Cervus elaphus", "https://en.wiktionary.org/wiki/red_deer#/media/File:Cervus_elaphus_Luc_Viatour_5.jpg", "Forêt tempérée", "herbivore", "Bon", "Herbe et feuilles", 5000, "2024-07-28", "Bambi est en bonne santé. Ses bois sont bien développés."),
("Renard roux", "Roxy", "Vulpes vulpes", "https://en.wiktionary.org/wiki/red_fox#/media/File:Red_Fox_2012.jpg", "Forêt tempérée", "omnivore", "Bon", "Viande et fruits", 500, "2024-07-29", "Roxy est en bonne santé. Son pelage est brillant."),
("Girafe", "Melman", "Giraffa camelopardalis", "https://en.wiktionary.org/wiki/giraffe#/media/File:Giraffe_standing.jpg", "Savane africaine", "herbivore", "Excellent", "Feuilles d'acacia", 30000, "2024-07-30", "Melman est en excellente santé. Sa hauteur est dans la moyenne."),
("Guépard", "Flash", "Acinonyx jubatus", "https://images.pexels.com/photos/257540/pexels-photo-257540.jpeg", "Savane africaine", "carnivore", "Bon", "Viande fraîche", 2000, "2024-07-31", "Flash est en bonne forme physique."),
("Jaguar", "Bagheera", "Panthera onca", "https://images.pexels.com/photos/45911/jaguar-predator-animal-royal-45911.jpeg", "Forêt tropicale", "carnivore", "Excellent", "Viande de porc", 3000, "2024-08-01", "Bagheera est en excellente santé. Son pelage est luisant."),
("Orang-outan", "King Louie", "Pongo abelii", "https://images.pexels.com/photos/357366/pexels-photo-357366.jpeg", "Forêt tropicale", "omnivore", "Moyen", "Fruits et légumes", 4000, "2024-08-02", "King Louie montre des signes de vieillissement."),
("Morse", "Wally", "Odobenus rosmarus", "https://images.pexels.com/photos/209968/pexels-photo-209968.jpeg", "Banquise arctique", "carnivore", "Bon", "Mollusques et poissons", 20000, "2024-08-03", "Wally est en bonne santé. Ses défenses sont en bon état."),
("Lynx", "Félix", "Lynx lynx", "https://images.pexels.com/photos/1201214/pexels-photo-1201214.jpeg", "Forêt tempérée", "carnivore", "Excellent", "Viande de lapin", 1000, "2024-08-04", "Félix est très actif et en excellente condition."),
("Dromadaire", "Chameau", "Camelus dromedarius", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Désert", "herbivore", "Bon", "Foin et grains", 12000, "2024-08-05", "Chameau est en bonne santé. Sa bosse est bien formée."),
("Fennec", "Fenouil", "Vulpes zerda", "https://images.pexels.com/photos/1117131/pexels-photo-1117131.jpeg", "Désert", "omnivore", "Excellent", "Insectes et fruits", 200, "2024-08-06", "Fenouil est très actif, surtout la nuit."),
("Poisson-clown", "Nemo", "Amphiprion ocellaris", "https://images.pexels.com/photos/128756/pexels-photo-128756.jpeg", "Récif corallien", "omnivore", "Bon", "Plancton et algues", 5, "2024-08-07", "Nemo nage activement dans son aquarium."),
("Requin à pointes noires", "Bruce", "Carcharhinus melanopterus", "https://images.pexels.com/photos/128756/pexels-photo-128756.jpeg", "Récif corallien", "carnivore", "Excellent", "Poisson frais", 2000, "2024-08-08", "Bruce est en excellente santé. Ses nageoires sont intactes."),
("Panda géant", "Po", "Ailuropoda melanoleuca", "https://images.pexels.com/photos/357366/pexels-photo-357366.jpeg", "Forêt tempérée", "herbivore", "Bon", "Bambou frais", 20000, "2024-08-09", "Po mange bien et est en bonne santé."),
("Koala", "Buster", "Phascolarctos cinereus", "https://images.pexels.com/photos/72270/pexels-photo-72270.jpeg", "Forêt tempérée", "herbivore", "Moyen", "Feuilles d'eucalyptus", 500, "2024-08-10", "Buster montre des signes de fatigue."),
("Tigre du Bengale", "Shere Khan", "Panthera tigris tigris", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Forêt tropicale", "carnivore", "Excellent", "Viande de boeuf", 7000, "2024-08-11", "Shere Khan est en excellente forme physique."),
("Kangourou roux", "Joey", "Macropus rufus", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Désert", "herbivore", "Bon", "Herbe et feuilles", 3000, "2024-08-12", "Joey est très actif et en bonne santé."),
("Paon", "Plumeau", "Pavo cristatus", "https://images.pexels.com/photos/46242/pexels-photo-46242.jpeg", "Forêt tropicale", "omnivore", "Excellent", "Graines et insectes", 300, "2024-08-13", "Plumeau a un plumage magnifique."),
("Flamant rose", "Pinky", "Phoenicopterus roseus", "https://images.pexels.com/photos/357366/pexels-photo-357366.jpeg", "Récif corallien", "omnivore", "Bon", "Algues et crustacés", 400, "2024-08-14", "Pinky a une belle couleur rose vif."),
("Rhinocéros blanc", "Rocky", "Ceratotherium simum", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Savane africaine", "herbivore", "Moyen", "Herbe et feuilles", 60000, "2024-08-15", "Rocky a besoin d'un traitement pour sa peau."),
("Bison d'Amérique", "Buffalo Bill", "Bison bison", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Prairie", "herbivore", "Excellent", "Herbe et foin", 30000, "2024-08-16", "Buffalo Bill est robuste et en excellente santé."),
("Puma", "Baggy", "Puma concolor", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Montagne", "carnivore", "Bon", "Viande de cerf", 3000, "2024-08-16", "Baggy est en bonne forme physique."),
("Paresseux à trois doigts", "Flash", "Bradypus tridactylus", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Forêt tropicale", "herbivore", "Bon", "Feuilles de cecropia", 300, "2024-08-17", "Flash est lent mais en bonne santé."),
("Loup gris", "Alpha", "Canis lupus", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Forêt tempérée", "carnivore", "Excellent", "Viande de mouton", 2000, "2024-08-18", "Alpha est le chef de la meute et en excellente condition."),
("Émeu", "Drou", "Dromaius novaehollandiae", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Désert", "omnivore", "Bon", "Graines et insectes", 1000, "2024-08-19", "Drou a un bon plumage et est actif."),
("Aigle royal", "Aquila", "Aquila chrysaetos", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Montagne", "carnivore", "Excellent", "Viande de lapin", 500, "2024-08-20", "Aquila a des ailes puissantes et est en excellente santé."),
("Iguane vert", "Iggy", "Iguana iguana", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Forêt tropicale", "herbivore", "Bon", "Feuilles et fruits", 200,"2024-08-21", "Iggy a une belle couleur verte et est en bonne santé."),
("Manchot royal", "Skipper", "Aptenodytes patagonicus", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Banquise arctique", "carnivore", "Bon", "Poisson et calmars", 1000, "2024-08-22", "Skipper nage bien et est en bonne condition."),
("Anaconda vert", "Kaa", "Eunectes murinus", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Forêt tropicale", "carnivore", "Excellent", "Rats", 2000, "2024-08-23", "Kaa a récemment mué et est en excellente santé."),
("Lama", "Kuzco", "Lama glama", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Montagne", "herbivore", "Bon", "Foin et grains", 2000, "2024-08-24", "Kuzco a une laine épaisse et est en bonne santé."),
("Chameau de Bactriane", "Humphrey", "Camelus bactrianus", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Désert", "herbivore", "Bon", "Foin et végétaux", 15000, "2024-08-25", "Humphrey a des bosses bien remplies et est en bonne santé."),
("Tapir", "Tap-Tap", "Tapirus terrestris", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Forêt tropicale", "herbivore", "Moyen", "Fruits et feuilles", 5000, "2024-08-26", "Tap-Tap montre des signes de stress léger."),
("Zèbre de Grévy", "Marty", "Equus grevyi", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Savane africaine", "herbivore", "Excellent", "Herbe et foin", 10000, "2024-08-27", "Marty a un pelage rayé brillant et est en excellente forme."),
("Chauve-souris frugivore", "Batty", "Pteropus vampyrus", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Forêt tropicale", "frugivore", "Bon", "Fruits mûrs", 300, "2024-08-28", "Batty a des ailes en bon état et est active la nuit."),
("Otarie de Californie", "Gerry", "Zalophus californianus", "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg", "Côte pacifique", "carnivore", "Excellent", "Poisson frais", 6000, "2024-08-29", "Gerry est très joueur et en excellente condition physique.");
-- Table des avis
CREATE TABLE reviews (
id int(11) NOT NULL AUTO_INCREMENT,
user_name varchar(255) NOT NULL,
content text NOT NULL,
validated tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Table des rapports vétérinaires
CREATE TABLE veterinary_reports (
id int(11) NOT NULL AUTO_INCREMENT,
animal_id int(11) NOT NULL,
veterinarian_id int(11) NOT NULL,
date date NOT NULL,
content text NOT NULL,
PRIMARY KEY (id),
KEY animal_id (animal_id),
KEY veterinarian_id (veterinarian_id),
CONSTRAINT veterinary_reports_ibfk_1 FOREIGN KEY (animal_id) REFERENCES animals (id),
CONSTRAINT veterinary_reports_ibfk_2 FOREIGN KEY (veterinarian_id) REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Table des alimentations des animaux
CREATE TABLE animal_feedings (
id int(11) NOT NULL AUTO_INCREMENT,
animal_id int(11) NOT NULL,
date date NOT NULL,
time time NOT NULL,
food varchar(255) NOT NULL,
quantity int(11) NOT NULL,
PRIMARY KEY (id),
KEY animal_id (animal_id),
CONSTRAINT animal_feedings_ibfk_1 FOREIGN KEY (animal_id) REFERENCES animals (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
