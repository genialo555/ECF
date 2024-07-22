<?php

function handleValidateReviews() {
    global $pdo;
    $content = "<h2>Validation des avis</h2>";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reviewId = $_POST['review_id'];
        $action = $_POST['action'];

        $stmt = $pdo->prepare("UPDATE visitor_reviews SET is_approved = ? WHERE id = ?");
        $approved = ($action === 'approve') ? 1 : 0;
        if ($stmt->execute([$approved, $reviewId])) {
            $content .= "<p>Avis " . ($approved ? "approuvé" : "rejeté") . " avec succès.</p>";
        } else {
            $content .= "<p>Erreur lors de la mise à jour de l'avis.</p>";
        }
    }

    // Afficher les avis en attente de validation
    $stmt = $pdo->query("SELECT * FROM visitor_reviews WHERE is_approved IS NULL ORDER BY created_at DESC");
    $reviews = $stmt->fetchAll();

    if (count($reviews) > 0) {
        $content .= "<table>
            <tr><th>Pseudo</th><th>Commentaire</th><th>Date</th><th>Actions</th></tr>";
        foreach ($reviews as $review) {
            $content .= "<tr>
                <td>{$review['pseudo']}</td>
                <td>{$review['comment']}</td>
                <td>{$review['created_at']}</td>
                <td>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='review_id' value='{$review['id']}'>
                        <button type='submit' name='action' value='approve'>Approuver</button>
                        <button type='submit' name='action' value='reject'>Rejeter</button>
                    </form>
                </td>
            </tr>";
        }
        $content .= "</table>";
    } else {
        $content .= "<p>Aucun avis en attente de validation.</p>";
    }

    return $content;
}

function handleManageServices() {
    global $pdo;
    $content = "<h2>Gestion des services</h2>";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $serviceId = $_POST['service_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $stmt = $pdo->prepare("UPDATE services SET name = ?, description = ? WHERE id = ?");
        if ($stmt->execute([$name, $description, $serviceId])) {
            $content .= "<p>Service mis à jour avec succès.</p>";
        } else {
            $content .= "<p>Erreur lors de la mise à jour du service.</p>";
        }
    }

    // Afficher les services existants
    $stmt = $pdo->query("SELECT * FROM services ORDER BY name");
    $services = $stmt->fetchAll();

    foreach ($services as $service) {
        $content .= "
        <form method='post'>
            <input type='hidden' name='service_id' value='{$service['id']}'>
            <label for='name_{$service['id']}'>Nom :</label>
            <input type='text' id='name_{$service['id']}' name='name' value='{$service['name']}' required>
            <label for='description_{$service['id']}'>Description :</label>
            <textarea id='description_{$service['id']}' name='description' required>{$service['description']}</textarea>
            <button type='submit'>Mettre à jour</button>
        </form>";
    }

    return $content;
}

function handleRecordFeeding() {
    global $pdo;
    $content = "<h2>Enregistrement de l'alimentation</h2>";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $animalId = $_POST['animal_id'];
        $foodType = $_POST['food_type'];
        $foodQuantity = $_POST['food_quantity'];
        $feedingDate = $_POST['feeding_date'];
        $feedingTime = $_POST['feeding_time'];

        $stmt = $pdo->prepare("INSERT INTO feedings (animal_id, food_type, food_quantity, feeding_datetime) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$animalId, $foodType, $foodQuantity, $feedingDate . ' ' . $feedingTime])) {
            $content .= "<p>Alimentation enregistrée avec succès.</p>";
        } else {
            $content .= "<p>Erreur lors de l'enregistrement de l'alimentation.</p>";
        }
    }

    // Formulaire pour enregistrer l'alimentation
    $animals = getAllAnimals();
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
        <label for='food_type'>Type de nourriture :</label>
        <input type='text' name='food_type' required>
        <label for='food_quantity'>Quantité :</label>
        <input type='number' name='food_quantity' step='0.1' required>
        <label for='feeding_date'>Date :</label>
        <input type='date' name='feeding_date' required>
        <label for='feeding_time'>Heure :</label>
        <input type='time' name='feeding_time' required>
        <button type='submit'>Enregistrer</button>
    </form>";

    return $content;
}

function getAllAnimals() {
    global $pdo;
    return $pdo->query("SELECT * FROM animals ORDER BY name")->fetchAll();
}