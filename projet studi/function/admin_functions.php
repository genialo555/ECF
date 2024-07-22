<?php
function createUser($email, $password, $userType) {
    global $pdo;
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (email, password, user_type) VALUES (?, ?, ?)");
    $stmt->execute([$email, $hashedPassword, $userType]);
    
    // Envoi de l'email à l'utilisateur
    $subject = "Votre compte Zoo Arcadia";
    $message = "Votre compte a été créé. Votre nom d'utilisateur est : $email";
    mail($email, $subject, $message);
    
    return $pdo->lastInsertId();
}

function getVeterinaryReports($animalFilter = null, $dateFilter = null) {
    global $pdo;
    
    $query = "SELECT * FROM veterinary_reports WHERE 1=1";
    $params = [];
    
    if ($animalFilter) {
        $query .= " AND animal_id = ?";
        $params[] = $animalFilter;
    }
    
    if ($dateFilter) {
        $query .= " AND date = ?";
        $params[] = $dateFilter;
    }
    
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function isAdmin($userId) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT user_type FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $userType = $stmt->fetchColumn();
    
    return $userType === 'admin';
}
// Créer un nouveau service
function createService($name, $description) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO services (name, description) VALUES (?, ?)");
    return $stmt->execute([$name, $description]);
}

// Récupérer tous les services
function getAllServices() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM services ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer un service par son ID
function getServiceById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mettre à jour un service
function updateService($id, $name, $description) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE services SET name = ?, description = ? WHERE id = ?");
    return $stmt->execute([$name, $description, $id]);
}

// Supprimer un service
function deleteService($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    return $stmt->execute([$id]);
}
// Créer un nouvel habitat
function createHabitat($name, $description, $imageUrl) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO habitats (name, description, image_url) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $description, $imageUrl]);
}

// Récupérer tous les habitats
function getAllHabitats() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM habitats ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer un habitat par son ID
function getHabitatById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mettre à jour un habitat
function updateHabitat($id, $name, $description, $imageUrl) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE habitats SET name = ?, description = ?, image_url = ? WHERE id = ?");
    return $stmt->execute([$name, $description, $imageUrl, $id]);
}

// Supprimer un habitat
function deleteHabitat($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM habitats WHERE id = ?");
    return $stmt->execute([$id]);
}
// Créer un nouvel animal
function createAnimal($name, $species, $habitatId, $imageUrl) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO animals (name, species, habitat_id, image_url) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $species, $habitatId, $imageUrl]);
}

// Récupérer tous les animaux
function getAllAnimals() {
    global $pdo;
    $stmt = $pdo->query("SELECT a.*, h.name as habitat_name FROM animals a LEFT JOIN habitats h ON a.habitat_id = h.id ORDER BY a.name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer un animal par son ID
function getAnimalById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM animals WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mettre à jour un animal
function updateAnimal($id, $name, $species, $habitatId, $imageUrl) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE animals SET name = ?, species = ?, habitat_id = ?, image_url = ? WHERE id = ?");
    return $stmt->execute([$name, $species, $habitatId, $imageUrl, $id]);
}

// Supprimer un animal
function deleteAnimal($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM animals WHERE id = ?");
    return $stmt->execute([$id]);
}
// Récupérer tous les comptes rendus vétérinaires
function getAllVeterinaryReports($animalFilter = null, $dateFilter = null) {
    global $pdo;
    
    $query = "SELECT vr.*, a.name as animal_name, u.email as vet_email 
              FROM veterinary_reports vr 
              JOIN animals a ON vr.animal_id = a.id 
              JOIN users u ON vr.veterinarian_id = u.id 
              WHERE 1=1";
    $params = [];
    
    if ($animalFilter) {
        $query .= " AND vr.animal_id = ?";
        $params[] = $animalFilter;
    }
    
    if ($dateFilter) {
        $query .= " AND vr.report_date = ?";
        $params[] = $dateFilter;
    }
    
    $query .= " ORDER BY vr.report_date DESC";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Fonction pour se connecter à MongoDB
function connectToMongo() {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    return $client->selectDatabase('zoo_arcadia');
}

// Fonction pour obtenir les statistiques de consultation
function getAnimalViewStats() {
    $db = connectToMongo();
    $collection = $db->animal_views;
    
    $stats = $collection->find([], ['sort' => ['views' => -1]]);
    return $stats;
}
function getDashboardContent() {
    $content = "<h2>Tableau de bord</h2>";

    $content .= "<h3>Statistiques de consultation des animaux</h3>";
    
    $stats = getAnimalViewStats();
    
    if (count($stats) > 0) {
        $content .= "<table>
            <tr>
                <th>Animal</th>
                <th>Nombre de consultations</th>
            </tr>";
        foreach ($stats as $stat) {
            $animal = getAnimalById($stat['animal_id']);
            $content .= "<tr>
                <td>{$animal['name']}</td>
                <td>{$stat['views']}</td>
            </tr>";
        }
        $content .= "</table>";
    } else {
        $content .= "<p>Aucune statistique de consultation disponible.</p>";
    }

    return $content;
}