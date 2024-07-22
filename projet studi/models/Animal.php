<?php
class Animal {
  private $_id;
  private $prenom;
  private $race;
  private $images;
  private $habitat;

  public function __construct($data) {
    $this->_id = $data['_id'] ?? null;
    $this->prenom = $data['prenom'];
    $this->race = $data['race'];
    $this->images = $data['images'];
    $this->habitat = $data['habitat'];
  }
  public static function search($searchTerm) {
    return self::getCollection()->find(['name' => ['$regex' => $searchTerm, '$options' => 'i']]);
}

  public function getId() {
    return $this->_id;
  }

  public function getPrenom() {
    return $this->prenom;
  }

  public function getRace() {
    return $this->race;
  }

  public function getImages() {
    return $this->images;
  }

  public function getHabitat() {
    return $this->habitat;
  }

  public static function getCollection() {
    global $database;
    return $database->animal;
  }

  public static function findAll() {
    return self::getCollection()->find();
  }

  public static function findById($id) {
    return self::getCollection()->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
  }

  public function save() {
    if ($this->_id === null) {
      $result = self::getCollection()->insertOne([
        'prenom' => $this->prenom,
        'race' => $this->race,
        'images' => $this->images,
        'habitat' => $this->habitat
      ]);
      $this->_id = $result->getInsertedId();
    } else {
      $this->update();
    }
  }

  public function update() {
    self::getCollection()->updateOne(
      ['_id' => new MongoDB\BSON\ObjectId($this->_id)],
      ['$set' => [
        'prenom' => $this->prenom,
        'race' => $this->race,
        'images' => $this->images,
        'habitat' => $this->habitat
      ]]
    );
  }

  public function delete() {
    self::getCollection()->deleteOne(['_id' => new MongoDB\BSON\ObjectId($this->_id)]);
  }
}
  
  $animaux = [
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Léo",
          'race' => "Panthera leo",
          'images' => "https://en.wikipedia.org/wiki/Lion#/media/File:Okonjima_Lioness.jpg",
          'habitat' => "Savane africaine"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Georges",
          'race' => "Gorilla gorilla",
          'images' => "https://en.wikipedia.org/wiki/Gorilla#/media/File:Gorille_des_plaines_de_l'ouest_%C3%A0_l'Espace_Zoologique.jpg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Boris",
          'race' => "Ursus maritimus",
          'images' => "https://en.wiktionary.org/wiki/ours_polaire#/media/File:Polar_Bear_AdF.jpg",
          'habitat' => "Banquise arctique"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Dumbo",
          'race' => "Loxodonta africana",
          'images' => "https://en.wiktionary.org/wiki/elephant#/media/File:Elephant_near_ndutu.jpg",
          'habitat' => "Savane africaine"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Pipo",
          'race' => "Aptenodytes forsteri",
          'images' => "https://en.wiktionary.org/wiki/ping%C3%BCino#/media/File:Adelie_Penguin.jpg",
          'habitat' => "Banquise arctique"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Toco",
          'race' => "Ramphastos toco",
          'images' => "https://en.wiktionary.org/wiki/toco_toucan#/media/File:Tucano_01.jpg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Flipper",
          'race' => "Pusa hispida",
          'images' => "https://en.wiktionary.org/wiki/Histriophoca_fasciata#/media/File:Male_Ribbon_Sea_Ozernoy_Gulf_Russia.jpg",
          'habitat' => "Banquise arctique"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Bambi",
          'race' => "Cervus elaphus",
          'images' => "https://en.wiktionary.org/wiki/red_deer#/media/File:Cervus_elaphus_Luc_Viatour_5.jpg",
          'habitat' => "Forêt tempérée"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Roxy",
          'race' => "Vulpes vulpes",
          'images' => "https://en.wiktionary.org/wiki/red_fox#/media/File:Red_Fox_2012.jpg",
          'habitat' => "Forêt tempérée"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Melman",
          'race' => "Giraffa camelopardalis",
          'images' => "https://en.wiktionary.org/wiki/giraffe#/media/File:Giraffe_standing.jpg",
          'habitat' => "Savane africaine"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Flash",
          'race' => "Acinonyx jubatus",
          'images' => "https://images.pexels.com/photos/257540/pexels-photo-257540.jpeg",
          'habitat' => "Savane africaine"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Bagheera",
          'race' => "Panthera onca",
          'images' => "https://images.pexels.com/photos/45911/jaguar-predator-animal-royal-45911.jpeg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "King Louie",
          'race' => "Pongo abelii",
          'images' => "https://images.pexels.com/photos/357366/pexels-photo-357366.jpeg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Wally",
          'race' => "Odobenus rosmarus",
          'images' => "https://images.pexels.com/photos/209968/pexels-photo-209968.jpeg",
          'habitat' => "Banquise arctique"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Félix",
          'race' => "Lynx lynx",
          'images' => "https://images.pexels.com/photos/1201214/pexels-photo-1201214.jpeg",
          'habitat' => "Forêt tempérée"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Chameau",
          'race' => "Camelus dromedarius",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Désert"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Fenouil",
          'race' => "Vulpes zerda",
          'images' => "https://images.pexels.com/photos/1117131/pexels-photo-1117131.jpeg",
          'habitat' => "Désert"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Nemo",
          'race' => "Amphiprion ocellaris",
          'images' => "https://images.pexels.com/photos/128756/pexels-photo-128756.jpeg",
          'habitat' => "Récif corallien"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Bruce",
          'race' => "Carcharhinus melanopterus",
          'images' => "https://images.pexels.com/photos/128756/pexels-photo-128756.jpeg",
          'habitat' => "Récif corallien"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Po",
          'race' => "Ailuropoda melanoleuca",
          'images' => "https://images.pexels.com/photos/357366/pexels-photo-357366.jpeg",
          'habitat' => "Forêt tempérée"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Buster",
          'race' => "Phascolarctos cinereus",
          'images' => "https://images.pexels.com/photos/72270/pexels-photo-72270.jpeg",
          'habitat' => "Forêt tempérée"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Shere Khan",
          'race' => "Panthera tigris tigris",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Joey",
          'race' => "Macropus rufus",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Désert"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Plumeau",
          'race' => "Pavo cristatus",
          'images' => "https://images.pexels.com/photos/46242/pexels-photo-46242.jpeg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Pinky",
          'race' => "Phoenicopterus roseus",
          'images' => "https://images.pexels.com/photos/357366/pexels-photo-357366.jpeg",
          'habitat' => "Récif corallien"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Rocky",
          'race' => "Ceratotherium simum",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Savane africaine"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Buffalo Bill",
          'race' => "Bison bison",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Prairie"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Baggy",
          'race' => "Puma concolor",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Montagne"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Flash",
          'race' => "Bradypus tridactylus",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Alpha",
          'race' => "Canis lupus",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Forêt tempérée"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Drou",
          'race' => "Dromaius novaehollandiae",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Désert"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Aquila",
          'race' => "Aquila chrysaetos",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Montagne"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Iggy",
          'race' => "Iguana iguana",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Skipper",
          'race' => "Aptenodytes patagonicus",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Banquise arctique"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Kaa",
          'race' => "Eunectes murinus",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Kuzco",
          'race' => "Lama glama",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Montagne"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Humphrey",
          'race' => "Camelus bactrianus",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Désert"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Tap-Tap",
          'race' => "Tapirus terrestris",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Marty",
          'race' => "Equus grevyi",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Savane africaine"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Batty",
          'race' => "Pteropus vampyrus",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Forêt tropicale"
      ],
      [
          '_id' => new MongoDB\BSON\ObjectId(),
          'prenom' => "Gerry",
          'race' => "Zalophus californianus",
          'images' => "https://images.pexels.com/photos/145939/pexels-photo-145939.jpeg",
          'habitat' => "Côte pacifique"
      ]
  ];
  ?>
  