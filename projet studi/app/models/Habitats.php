<?php

class Habitat {
    private $id;
    private $name;
    private $type;
    private $location;

    public function __construct($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->location = $data['location'];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function getLocation() {
        return $this->location;
    }

    public static function getAllHabitats() {
        $habitatsData = [
            [
                'id' => '1',
                'name' => 'Savane africaine',
                'type' => 'Savane',
                'location' => 'Zone 1'
            ],
            [
                'id' => '2',
                'name' => 'Forêt tropicale',
                'type' => 'Forêt',
                'location' => 'Zone 2'
            ],
            [
                'id' => '3',
                'name' => 'Banquise arctique',
                'type' => 'Banquise',
                'location' => 'Zone 3'
            ],
            [
                'id' => '4',
                'name' => 'Forêt tempérée',
                'type' => 'Forêt',
                'location' => 'Zone 4'
            ],
            [
                'id' => '5',
                'name' => 'Désert',
                'type' => 'Désert',
                'location' => 'Zone 5'
            ],
            [
                'id' => '6',
                'name' => 'Récif corallien',
                'type' => 'Océan',
                'location' => 'Zone 6'
            ],
            [
                'id' => '7',
                'name' => 'Montagne',
                'type' => 'Montagne',
                'location' => 'Zone 7'
            ],
            [
                'id' => '8',
                'name' => 'Prairie',
                'type' => 'Prairie',
                'location' => 'Zone 8'
            ],
            [
                'id' => '9',
                'name' => 'Côte pacifique',
                'type' => 'Côte',
                'location' => 'Zone 9'
            ]
        ];

        $habitats = [];
        foreach ($habitatsData as $habitatData) {
            $habitats[] = new Habitat($habitatData);
        }

        return $habitats;
    }

    public static function getHabitatById($id) {
        $habitats = self::getAllHabitats();
        foreach ($habitats as $habitat) {
            if ($habitat->getId() == $id) {
                return $habitat;
            }
        }
        return null;
    }
}

// Exemple d'utilisation pour afficher tous les habitats
$habitats = Habitat::getAllHabitats();
foreach ($habitats as $habitat) {
    echo 'Habitat: ' . $habitat->getName() . ', Type: ' . $habitat->getType() . ', Location: ' . $habitat->getLocation() . '<br>';
}

?>
