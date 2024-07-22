<?php
$host = 'localhost';
$db   = 'zoo_arcadia';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connexion à la base de données réussie.\n";

    // Création de la table animal_views si elle n'existe pas
    $sql = "CREATE TABLE IF NOT EXISTS animal_views (
        animal_id INT PRIMARY KEY,
        views INT DEFAULT 0,
        FOREIGN KEY (animal_id) REFERENCES animals(id)
    )";
    $pdo->exec($sql);
    echo "Table animal_views créée ou déjà existante.\n";

} catch (PDOException $e) {
    echo "Erreur de connexion ou de création de table : " . $e->getMessage() . "\n";
    die();
}

// Fonctions pour gérer les vues des animaux
function incrementAnimalViews($animalId) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO animal_views (animal_id, views)
                           VALUES (:animal_id, 1)
                           ON DUPLICATE KEY UPDATE views = views + 1");
    $stmt->execute(['animal_id' => $animalId]);
}

function getAnimalViewStats() {
    global $pdo;
    $stmt = $pdo->query("SELECT animal_id, views FROM animal_views ORDER BY views DESC");
    return $stmt->fetchAll();
}
$animaux = [
    [
        'id' => 1,
        'name' => "Lion d'Afrique",
        'firstName' => "Léo",
        'species' => "Panthera leo",
        'image' => "https://en.wikipedia.org/wiki/Lion#/media/File:Okonjima_Lioness.jpg",
        'habitat' => "Savane africaine",
        'diet' => "carnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Viande de boeuf",
        'grammageNourriture' => 6000,
        'datePassage' => "2024-07-21",
        'detailEtat' => "Léo est en bonne santé. Son pelage est brillant et il est actif."
    ],
    [
        'id' => 2,
        'name' => "Gorille des plaines",
        'firstName' => "Georges",
        'species' => "Gorilla gorilla",
        'image' => "https://en.wikipedia.org/wiki/Gorilla#/media/File:Gorille_des_plaines_de_l'ouest_%C3%A0_l'Espace_Zoologique.jpg",
        'habitat' => "Forêt tropicale",
        'diet' => "herbivore",
        'etat' => "Moyen",
        'nourritureProposee' => "Fruits et légumes",
        'grammageNourriture' => 15000,
        'datePassage' => "2024-07-22",
        'detailEtat' => "Georges montre des signes de stress léger."
    ],
    [
        'id' => 3,
        'name' => "Ours polaire",
        'firstName' => "Boris",
        'species' => "Ursus maritimus",
        'image' => "https://en.wiktionary.org/wiki/ours_polaire#/media/File:Polar_Bear_AdF.jpg",
        'habitat' => "Banquise arctique",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Poisson frais",
        'grammageNourriture' => 10000,
        'datePassage' => "2024-07-23",
        'detailEtat' => "Boris est en excellente condition physique."
    ],
    [
        'id' => 4,
        'name' => "Éléphant d'Afrique",
        'firstName' => "Dumbo",
        'species' => "Loxodonta africana",
        'image' => "https://en.wiktionary.org/wiki/elephant#/media/File:Elephant_near_ndutu.jpg",
        'habitat' => "Savane africaine",
        'diet' => "herbivore",
        'etat' => "Bon",
        'nourritureProposee' => "Foin et fruits",
        'grammageNourriture' => 150000,
        'datePassage' => "2024-07-24",
        'detailEtat' => "Dumbo est en bonne santé. Ses défenses sont en bon état."
    ],
    [
        'id' => 5,
        'name' => "Pingouin empereur",
        'firstName' => "Pipo",
        'species' => "Aptenodytes forsteri",
        'image' => "https://en.wiktionary.org/wiki/ping%C3%BCino#/media/File:Adelie_Penguin.jpg",
        'habitat' => "Banquise arctique",
        'diet' => "carnivore",
        'etat' => "Moyen",
        'nourritureProposee' => "Poisson et krill",
        'grammageNourriture' => 1000,
        'datePassage' => "2024-07-25",
        'detailEtat' => "Pipo a une légère blessure à la nageoire."
    ],
    [
        'id' => 6,
        'name' => "Toucan toco",
        'firstName' => "Toco",
        'species' => "Ramphastos toco",
        'image' => "https://en.wiktionary.org/wiki/toco_toucan#/media/File:Tucano_01.jpg",
        'habitat' => "Forêt tropicale",
        'diet' => "omnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Fruits et insectes",
        'grammageNourriture' => 200,
        'datePassage' => "2024-07-26",
        'detailEtat' => "Toco est en bonne santé. Son bec est en excellent état."
    ],
    [
        'id' => 7,
        'name' => "Phoque annelé",
        'firstName' => "Flipper",
        'species' => "Pusa hispida",
        'image' => "https://en.wiktionary.org/wiki/Histriophoca_fasciata#/media/File:Male_Ribbon_Sea_Ozernoy_Gulf_Russia.jpg",
        'habitat' => "Banquise arctique",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Poisson frais",
        'grammageNourriture' => 3000,
        'datePassage' => "2024-07-27",
        'detailEtat' => "Flipper est très actif et en excellente santé."
    ],
    [
        'id' => 8,
        'name' => "Cerf élaphe",
        'firstName' => "Bambi",
        'species' => "Cervus elaphus",
        'image' => "https://en.wiktionary.org/wiki/red_deer#/media/File:Cervus_elaphus_Luc_Viatour_5.jpg",
        'habitat' => "Forêt tempérée",
        'diet' => "herbivore",
        'etat' => "Bon",
        'nourritureProposee' => "Herbe et feuilles",
        'grammageNourriture' => 5000,
        'datePassage' => "2024-07-28",
        'detailEtat' => "Bambi est en bonne santé. Ses bois sont bien développés."
    ],
    [
        'id' => 9,
        'name' => "Renard roux",
        'firstName' => "Roxy",
        'species' => "Vulpes vulpes",
        'image' => "https://en.wiktionary.org/wiki/red_fox#/media/File:Red_Fox_2012.jpg",
        'habitat' => "Forêt tempérée",
        'diet' => "omnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Viande et fruits",
        'grammageNourriture' => 500,
        'datePassage' => "2024-07-29",
        'detailEtat' => "Roxy est en bonne santé. Son pelage est brillant."
    ],
    [
        'id' => 10,
        'name' => "Girafe",
        'firstName' => "Melman",
        'species' => "Giraffa camelopardalis",
        'image' => "https://en.wiktionary.org/wiki/giraffe#/media/File:Giraffe_standing.jpg",
        'habitat' => "Savane africaine",
        'diet' => "herbivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Feuilles d'acacia",
        'grammageNourriture' => 30000,
        'datePassage' => "2024-07-30",
        'detailEtat' => "Melman est en excellente santé. Sa hauteur est dans la moyenne."
    ],
    [
        'id' => 11,
        'name' => "Guépard",
        'firstName' => "Flash",
        'species' => "Acinonyx jubatus",
        'image' => "https://images.pexels.com/photos/257540/pexels-photo-257540.jpeg",
        'habitat' => "Savane africaine",
        'diet' => "carnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Viande fraîche",
        'grammageNourriture' => 2000,
        'datePassage' => "2024-07-31",
        'detailEtat' => "Flash est en bonne forme physique."
    ],
    [
        'id' => 12,
        'name' => "Jaguar",
        'firstName' => "Bagheera",
        'species' => "Panthera onca",
        'image' => "https://images.pexels.com/photos/45911/jaguar-predator-animal-royal-45911.jpeg",
        'habitat' => "Forêt tropicale",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Viande de porc",
        'grammageNourriture' => 3000,
        'datePassage' => "2024-08-01",
        'detailEtat' => "Bagheera est en excellente santé. Son pelage est luisant."
    ],
    [
        'id' => 13,
        'name' => "Orang-outan",
        'firstName' => "King Louie",
        'species' => "Pongo abelii",
        'image' => "https://images.pexels.com/photos/357366/pexels-photo-357366.jpeg",
        'habitat' => "Forêt tropicale",
        'diet' => "omnivore",
        'etat' => "Moyen",
        'nourritureProposee' => "Fruits et légumes",
        'grammageNourriture' => 4000,
        'datePassage' => "2024-08-02",
        'detailEtat' => "King Louie montre des signes de vieillissement."
    ],
    [
        'id' => 14,
        'name' => "Morse",
        'firstName' => "Wally",
        'species' => "Odobenus rosmarus",
        'image' => "https://images.pexels.com/photos/209968/pexels-photo-209968.jpeg",
        'habitat' => "Banquise arctique",
        'diet' => "carnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Mollusques et poissons",
        'grammageNourriture' => 20000,
        'datePassage' => "2024-08-03",
        'detailEtat' => "Wally est en bonne santé. Ses défenses sont en bon état."
    ],
    [
        'id' => 15,
        'name' => "Lynx",
        'firstName' => "Félix",
        'species' => "Lynx lynx",
        'image' => "https://images.pexels.com/photos/1201214/pexels-photo-1201214.jpeg",
        'habitat' => "Forêt tempérée",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Viande de lapin",
        'grammageNourriture' => 1000,
        'datePassage' => "2024-08-04",
        'detailEtat' => "Félix est très actif et en excellente condition."
    ],
    [
        'id' => 16,
        'name' => "Dromadaire",
        'firstName' => "Chameau",
        'species' => "Camelus dromedarius",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Désert",
        'diet' => "herbivore",
        'etat' => "Bon",
        'nourritureProposee' => "Foin et grains",
        'grammageNourriture' => 12000,
        'datePassage' => "2024-08-05",
        'detailEtat' => "Chameau est en bonne santé. Sa bosse est bien formée."
    ],
    [
        'id' => 17,
        'name' => "Fennec",
        'firstName' => "Fenouil",
        'species' => "Vulpes zerda",
        'image' => "https://images.pexels.com/photos/1117131/pexels-photo-1117131.jpeg",
        'habitat' => "Désert",
        'diet' => "omnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Insectes et fruits",
        'grammageNourriture' => 200,
        'datePassage' => "2024-08-06",
        'detailEtat' => "Fenouil est très actif, surtout la nuit."
    ],
    [
        'id' => 18,
        'name' => "Poisson-clown",
        'firstName' => "Nemo",
        'species' => "Amphiprion ocellaris",
        'image' => "https://images.pexels.com/photos/128756/pexels-photo-128756.jpeg",
        'habitat' => "Récif corallien",
        'diet' => "omnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Plancton et algues",
        'grammageNourriture' => 5,
        'datePassage' => "2024-08-07",
        'detailEtat' => "Nemo nage activement dans son aquarium."
    ],
    [
        'id' => 19,
        'name' => "Requin à pointes noires",
        'firstName' => "Bruce",
        'species' => "Carcharhinus melanopterus",
        'image' => "https://images.pexels.com/photos/128756/pexels-photo-128756.jpeg",
        'habitat' => "Récif corallien",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Poisson frais",
        'grammageNourriture' => 2000,
        'datePassage' => "2024-08-08",
        'detailEtat' => "Bruce est en excellente santé. Ses nageoires sont intactes."
    ],
    [
        'id' => 20,
        'name' => "Panda géant",
        'firstName' => "Po",
        'species' => "Ailuropoda melanoleuca",
        'image' => "https://images.pexels.com/photos/357366/pexels-photo-357366.jpeg",
        'habitat' => "Forêt tempérée",
        'diet' => "herbivore",
        'etat' => "Bon",
        'nourritureProposee' => "Bambou frais",
        'grammageNourriture' => 20000,
        'datePassage' => "2024-08-09",
        'detailEtat' => "Po mange bien et est en bonne santé."
    ],
    [
        'id' => 21,
        'name' => "Koala",
        'firstName' => "Buster",
        'species' => "Phascolarctos cinereus",
        'image' => "https://images.pexels.com/photos/72270/pexels-photo-72270.jpeg",
        'habitat' => "Forêt tempérée",
        'diet' => "herbivore",
        'etat' => "Moyen",
        'nourritureProposee' => "Feuilles d'eucalyptus",
        'grammageNourriture' => 500,
        'datePassage' => "2024-08-10",
        'detailEtat' => "Buster montre des signes de fatigue."
    ],
    [
        'id' => 22,
        'name' => "Tigre du Bengale",
        'firstName' => "Shere Khan",
        'species' => "Panthera tigris tigris",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Forêt tropicale",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Viande de boeuf",
        'grammageNourriture' => 7000,
        'datePassage' => "2024-08-11",
        'detailEtat' => "Shere Khan est en excellente forme physique."
    ],
    [
        'id' => 23,
        'name' => "Kangourou roux",
        'firstName' => "Joey",
        'species' => "Macropus rufus",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Désert",
        'diet' => "herbivore",
        'etat' => "Bon",
        'nourritureProposee' => "Herbe et feuilles",
        'grammageNourriture' => 3000,
        'datePassage' => "2024-08-12",
        'detailEtat' => "Joey est très actif et en bonne santé."
    ],
    [
        'id' => 24,
        'name' => "Paon",
        'firstName' => "Plumeau",
        'species' => "Pavo cristatus",
        'image' => "https://images.pexels.com/photos/46242/pexels-photo-46242.jpeg",
        'habitat' => "Forêt tropicale",
        'diet' => "omnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Graines et insectes",
        'grammageNourriture' => 300,
        'datePassage' => "2024-08-13",
        'detailEtat' => "Plumeau a un plumage magnifique."
    ],
    [
        'id' => 25,
        'name' => "Flamant rose",
        'firstName' => "Pinky",
        'species' => "Phoenicopterus roseus",
        'image' => "https://images.pexels.com/photos/357366/pexels-photo-357366.jpeg",
        'habitat' => "Récif corallien",
        'diet' => "omnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Algues et crustacés",
        'grammageNourriture' => 400,
        'datePassage' => "2024-08-14",
        'detailEtat' => "Pinky a une belle couleur rose vif."
    ],
    [
        'id' => 26,
        'name' => "Rhinocéros blanc",
        'firstName' => "Rocky",
        'species' => "Ceratotherium simum",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Savane africaine",
        'diet' => "herbivore",
        'etat' => "Moyen",
        'nourritureProposee' => "Herbe et feuilles",
        'grammageNourriture' => 60000,
        'datePassage' => "2024-08-15",
        'detailEtat' => "Rocky a besoin d'un traitement pour sa peau."
    ],
    [
        'id' => 27,
        'name' => "Bison d'Amérique",
        'firstName' => "Buffalo Bill",
        'species' => "Bison bison",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Prairie",
        'diet' => "herbivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Herbe et foin",
        'grammageNourriture' => 30000,
        'datePassage' => "2024-08-16",
        'detailEtat' => "Buffalo Bill est robuste et en excellente santé."
    ],
    [
        'id' => 28,
        'name' => "Puma",
        'firstName' => "Baggy",
        'species' => "Puma concolor",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Montagne",
        'diet' => "carnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Viande de cerf",
        'grammageNourriture' => 3000,
        'datePassage' => "2024-08-16",
        'detailEtat' => "Baggy est en bonne forme physique."
    ],
    [
        'id' => 29,
        'name' => "Paresseux à trois doigts",
        'firstName' => "Flash",
        'species' => "Bradypus tridactylus",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Forêt tropicale",
        'diet' => "herbivore",
        'etat' => "Bon",
        'nourritureProposee' => "Feuilles de cecropia",
        'grammageNourriture' => 300,
        'datePassage' => "2024-08-17",
        'detailEtat' => "Flash est lent mais en bonne santé."
    ],
    [
        'id' => 30,
        'name' => "Loup gris",
        'firstName' => "Alpha",
        'species' => "Canis lupus",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Forêt tempérée",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Viande de mouton",
        'grammageNourriture' => 2000,
        'datePassage' => "2024-08-18",
        'detailEtat' => "Alpha est le chef de la meute et en excellente condition."
    ],
    [
        'id' => 31,
        'name' => "Émeu",
        'firstName' => "Drou",
        'species' => "Dromaius novaehollandiae",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Désert",
        'diet' => "omnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Graines et insectes",
        'grammageNourriture' => 1000,
        'datePassage' => "2024-08-19",
        'detailEtat' => "Drou a un bon plumage et est actif."
    ],
    [
        'id' => 32,
        'name' => "Aigle royal",
        'firstName' => "Aquila",
        'species' => "Aquila chrysaetos",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Montagne",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Viande de lapin",
        'grammageNourriture' => 500,
        'datePassage' => "2024-08-20",
        'detailEtat' => "Aquila a des ailes puissantes et est en excellente santé."
    ],
    [
        'id' => 33,
        'name' => "Iguane vert",
        'firstName' => "Iggy",
        'species' => "Iguana iguana",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Forêt tropicale",
        'diet' => "herbivore",
        'etat' => "Bon",
        'nourritureProposee' => "Feuilles et fruits",
        'grammageNourriture' => 200,
        'datePassage' => "2024-08-21",
        'detailEtat' => "Iggy a une belle couleur verte et est en bonne santé."
    ],
    [
        'id' => 34,
        'name' => "Manchot royal",
        'firstName' => "Skipper",
        'species' => "Aptenodytes patagonicus",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Banquise arctique",
        'diet' => "carnivore",
        'etat' => "Bon",
        'nourritureProposee' => "Poisson et calmars",
        'grammageNourriture' => 1000,
        'datePassage' => "2024-08-22",
        'detailEtat' => "Skipper nage bien et est en bonne condition."
    ],
    [
        'id' => 35,
        'name' => "Anaconda vert",
        'firstName' => "Kaa",
        'species' => "Eunectes murinus",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Forêt tropicale",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Rats",
        'grammageNourriture' => 2000,
        'datePassage' => "2024-08-23",
        'detailEtat' => "Kaa a récemment mué et est en excellente santé."
    ],
    [
        'id' => 36,
        'name' => "Lama",
        'firstName' => "Kuzco",
        'species' => "Lama glama",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Montagne",
        'diet' => "herbivore",
        'etat' => "Bon",
        'nourritureProposee' => "Foin et grains",
        'grammageNourriture' => 2000,
        'datePassage' => "2024-08-24",
        'detailEtat' => "Kuzco a une laine épaisse et est en bonne santé."
    ],
    [
        'id' => 37,
        'name' => "Chameau de Bactriane",
        'firstName' => "Humphrey",
        'species' => "Camelus bactrianus",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Désert",
        'diet' => "herbivore",
        'etat' => "Bon",
        'nourritureProposee' => "Foin et végétaux",
        'grammageNourriture' => 15000,
        'datePassage' => "2024-08-25",
        'detailEtat' => "Humphrey a des bosses bien remplies et est en bonne santé."
    ],
    [
        'id' => 38,
        'name' => "Tapir",
        'firstName' => "Tap-Tap",
        'species' => "Tapirus terrestris",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Forêt tropicale",
        'diet' => "herbivore",
        'etat' => "Moyen",
        'nourritureProposee' => "Fruits et feuilles",
        'grammageNourriture' => 5000,
        'datePassage' => "2024-08-26",
        'detailEtat' => "Tap-Tap montre des signes de stress léger."
    ],
    [
        'id' => 39,
        'name' => "Zèbre de Grévy",
        'firstName' => "Marty",
        'species' => "Equus grevyi",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Savane africaine",
        'diet' => "herbivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Herbe et foin",
        'grammageNourriture' => 10000,
        'datePassage' => "2024-08-27",
        'detailEtat' => "Marty a un pelage rayé brillant et est en excellente forme."
    ],
    [
        'id' => 40,
        'name' => "Chauve-souris frugivore",
        'firstName' => "Batty",
        'species' => "Pteropus vampyrus",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Forêt tropicale",
        'diet' => "frugivore",
        'etat' => "Bon",
        'nourritureProposee' => "Fruits mûrs",
        'grammageNourriture' => 300,
        'datePassage' => "2024-08-28",
        'detailEtat' => "Batty a des ailes en bon état et est active la nuit."
    ],
    [
        'id' => 41,
        'name' => "Otarie de Californie",
        'firstName' => "Gerry",
        'species' => "Zalophus californianus",
        'image' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
        'habitat' => "Côte pacifique",
        'diet' => "carnivore",
        'etat' => "Excellent",
        'nourritureProposee' => "Poisson frais",
        'grammageNourriture' => 6000,
        'datePassage' => "2024-08-29",
        'detailEtat' => "Gerry est très joueur et en excellente condition physique."
    ]
];
?>
