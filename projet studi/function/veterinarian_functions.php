<?php

function createAnimalReport($pdo) {
    $content = "<h2>Créer un compte rendu pour un animal</h2>";

    if (isset($_POST['submit_report'])) {
        $animalId = $_POST['animal_id'];
        $healthStatus = $_POST['health_status'];
        $foodType = $_POST['food_type'];
        $foodQuantity = $_POST['food_quantity'];
        $details = $_POST['details'];
        $veterinarianId = $_SESSION['user_id'];

        $stmt = $pdo->prepare("INSERT INTO veterinary_reports (animal_id, veterinarian_id, health_status, food_type, food_quantity, report_date, details) VALUES (?, ?, ?, ?, ?, CURRENT_DATE, ?)");
        if ($stmt->execute([$animalId, $veterinarianId, $healthStatus, $foodType, $foodQuantity, $details])) {
            $content .= "<p>Compte rendu créé avec succès.</p>";
        } else {
            $content .= "<p>Erreur lors de la création du compte rendu.</p>";
        }
    }

    $animals = $pdo->query("SELECT id, name FROM animals")->fetchAll();

    $content .= "
    <form method='post'>
        <label for='animal_id'>Animal :</label>
        <select name='animal_id' required>
            <option value=''>Sélectionnez un animal</option>";
    foreach ($animals as $animal) {
        $content .= "<option value='{$animal['id']}'>{$animal['name']}</option>";
    }
    $content .= "
        </select>
        <label for='health_status'>État de santé :</label>
        <input type='text' name='health_status' required>
        <label for='food_type'>Type de nourriture :</label>
        <input type='text' name='food_type' required>
        <label for='food_quantity'>Quantité de nourriture :</label>
        <input type='number' name='food_quantity' step='0.1' required>
        <label for='details'>Détails :</label>
        <textarea name='details'></textarea>
        <button type='submit' name='submit_report'>Créer le compte rendu</button>
    </form>";

    return $content;
}

function addHabitatComment($pdo) {
    $content = "<h2>Commenter un habitat</h2>";

    if (isset($_POST['submit_comment'])) {
        $habitatId = $_POST['habitat_id'];
        $comment = $_POST['comment'];
        $veterinarianId = $_SESSION['user_id'];

        $stmt = $pdo->prepare("INSERT INTO habitat_comments (habitat_id, veterinarian_id, comment, comment_date) VALUES (?, ?, ?, CURRENT_DATE)");
        if ($stmt->execute([$habitatId, $veterinarianId, $comment])) {
            $content .= "<p>Commentaire ajouté avec succès.</p>";
        } else {
            $content .= "<p>Erreur lors de l'ajout du commentaire.</p>";
        }
    }

    $habitats = $pdo->query("SELECT id, name FROM habitats")->fetchAll();

    $content .= "
    <form method='post'>
        <label for='habitat_id'>Habitat :</label>
        <select name='habitat_id' required>
            <option value=''>Sélectionnez un habitat</option>";
    foreach ($habitats as $habitat) {
        $content .= "<option value='{$habitat['id']}'>{$habitat['name']}</option>";
    }
    $content .= "
        </select>
        <label for='comment'>Commentaire :</label>
        <textarea name='comment' required></textarea>
        <button type='submit' name='submit_comment'>Ajouter le commentaire</button>
    </form>";

    return $content;
}

function viewFeedingHistory($pdo) {
    $content = "<h2>Historique d'alimentation des animaux</h2>";

    $animals = $pdo->query("SELECT id, name FROM animals")->fetchAll();

    if (isset($_POST['view_history'])) {
        $animalId = $_POST['animal_id'];
        $stmt = $pdo->prepare("SELECT f.*, a.name as animal_name FROM feedings f JOIN animals a ON f.animal_id = a.id WHERE f.animal_id = ? ORDER BY f.feeding_datetime DESC");
        $stmt->execute([$animalId]);
        $feedings = $stmt->fetchAll();

        if (count($feedings) > 0) {
            $content .= "<h3>Historique d'alimentation pour {$feedings[0]['animal_name']}</h3>";
            $content .= "<table>
                <tr>
                    <th>Date et heure</th>
                    <th>Type de nourriture</th>
                    <th>Quantité</th>
                </tr>";
            foreach ($feedings as $feeding) {
                $content .= "<tr>
                    <td>{$feeding['feeding_datetime']}</td>
                    <td>{$feeding['food_type']}</td>
                    <td>{$feeding['food_quantity']}</td>
                </tr>";
            }
            $content .= "</table>";
        } else {
            $content .= "<p>Aucun historique d'alimentation trouvé pour cet animal.</p>";
        }
    }

    $content .= "
    <form method='post'>
        <label for='animal_id'>Sélectionnez un animal :</label>
        <select name='animal_id' required>
            <option value=''>Choisir un animal</option>";
    foreach ($animals as $animal) {
        $content .= "<option value='{$animal['id']}'>{$animal['name']}</option>";
    }
    $content .= "
        </select>
        <button type='submit' name='view_history'>Voir l'historique</button>
    </form>";

    return $content;
}
function getAllAnimals() {
    global $pdo;
    return $pdo->query("SELECT * FROM animals ORDER BY name")->fetchAll();
}

function getAllHabitats() {
    global $pdo;
    return $pdo->query("SELECT * FROM habitats ORDER BY name")->fetchAll();
}