<?php
use MongoDB\Client;
session_start();
require_once 'functions/auth_functions.php';
requireLogin();

// Vérification du type d'utilisateur
if ($_SESSION['user_type'] !== 'admin') { // Changez 'admin' selon le fichier
    header('Location: login.php');
    exit();
}

require_once 'config/database.php';
require_once 'functions/admin_functions.php';

// Vérification de l'authentification de l'administrateur
if (!isset($_SESSION['user_id']) || !isAdmin($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Initialisation des variables
$content = '';
$successMessage = '';
$errorMessage = '';

// Traitement des actions de l'administrateur
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create_user':
            if (isset($_POST['create_user'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $userType = $_POST['user_type'];

                if (createUser($email, $password, $userType)) {
                    $successMessage = "Utilisateur créé avec succès. Un email a été envoyé à $email.";
                } else {
                    $errorMessage = "Erreur lors de la création de l'utilisateur.";
                }
            }
            $content = getCreateUserForm();
            break;
        case 'manage_services':
            $content = getManageServicesContent();
            break;
        case 'manage_habitats':
            $content = getManageHabitatsContent();
            break;
        case 'manage_animals':
            $content = getManageAnimalsContent();
            break;
        case 'view_reports':
            $content = getViewReportsContent();
            break;
        case 'dashboard':
            $content = getDashboardContent();
            break;
        default:
            $content = "<p>Action non reconnue.</p>";
    }
} else {
    $content = "<h2>Bienvenue dans l'espace administrateur</h2>
                <p>Veuillez sélectionner une action dans le menu.</p>";
}

// Fonction pour obtenir le contenu du formulaire de création d'utilisateur
function getCreateUserForm() {
    return '<h2>Créer un nouvel utilisateur</h2>
            <form action="admin.php?action=create_user" method="post">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <label for="user_type">Type d\'utilisateur :</label>
                <select id="user_type" name="user_type" required>
                    <option value="employee">Employé</option>
                    <option value="veterinarian">Vétérinaire</option>
                </select>

                <button type="submit" name="create_user">Créer l\'utilisateur</button>
            </form>';
}

// Fonctions pour obtenir le contenu des autres sections (à implémenter)
function getManageServicesContent() {
    $content = "<h2>Gestion des services</h2>";

    // Traitement des actions (création, mise à jour, suppression)
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                if (createService($_POST['name'], $_POST['description'])) {
                    $content .= "<p class='success'>Service créé avec succès.</p>";
                } else {
                    $content .= "<p class='error'>Erreur lors de la création du service.</p>";
                }
                break;
            case 'update':
                if (updateService($_POST['id'], $_POST['name'], $_POST['description'])) {
                    $content .= "<p class='success'>Service mis à jour avec succès.</p>";
                } else {
                    $content .= "<p class='error'>Erreur lors de la mise à jour du service.</p>";
                }
                break;
            case 'delete':
                if (deleteService($_POST['id'])) {
                    $content .= "<p class='success'>Service supprimé avec succès.</p>";
                } else {
                    $content .= "<p class='error'>Erreur lors de la suppression du service.</p>";
                }
                break;
        }
    }

    // Formulaire de création de service
    $content .= "
    <h3>Ajouter un nouveau service</h3>
    <form action='admin.php?action=manage_services' method='post'>
        <input type='hidden' name='action' value='create'>
        <label for='name'>Nom du service :</label>
        <input type='text' id='name' name='name' required>
        <label for='description'>Description :</label>
        <textarea id='description' name='description' required></textarea>
        <button type='submit'>Ajouter le service</button>
    </form>";

    // Liste des services existants
    $services = getAllServices();
    $content .= "<h3>Liste des services</h3>";
    if (count($services) > 0) {
        $content .= "<table>
            <tr><th>Nom</th><th>Description</th><th>Actions</th></tr>";
        foreach ($services as $service) {
            $content .= "<tr>
                <td>{$service['name']}</td>
                <td>{$service['description']}</td>
                <td>
                    <a href='admin.php?action=manage_services&edit={$service['id']}'>Modifier</a>
                    <form action='admin.php?action=manage_services' method='post' style='display:inline;'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='{$service['id']}'>
                        <button type='submit' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce service ?\");'>Supprimer</button>
                    </form>
                </td>
            </tr>";
        }
        $content .= "</table>";
    } else {
        $content .= "<p>Aucun service n'a été ajouté pour le moment.</p>";
    }

    // Formulaire de modification (affiché si un ID est passé en GET)
    if (isset($_GET['edit'])) {
        $serviceToEdit = getServiceById($_GET['edit']);
        if ($serviceToEdit) {
            $content .= "
            <h3>Modifier le service</h3>
            <form action='admin.php?action=manage_services' method='post'>
                <input type='hidden' name='action' value='update'>
                <input type='hidden' name='id' value='{$serviceToEdit['id']}'>
                <label for='name'>Nom du service :</label>
                <input type='text' id='name' name='name' value='{$serviceToEdit['name']}' required>
                <label for='description'>Description :</label>
                <textarea id='description' name='description' required>{$serviceToEdit['description']}</textarea>
                <button type='submit'>Mettre à jour le service</button>
            </form>";
        }
    }

    return $content;
}

function getManageHabitatsContent() {
    $content = "<h2>Gestion des habitats</h2>";

    // Traitement des actions (création, mise à jour, suppression)
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $imageUrl = handleImageUpload($_FILES['image']);
                if (createHabitat($_POST['name'], $_POST['description'], $imageUrl)) {
                    $content .= "<p class='success'>Habitat créé avec succès.</p>";
                } else {
                    $content .= "<p class='error'>Erreur lors de la création de l'habitat.</p>";
                }
                break;
            case 'update':
                $imageUrl = $_POST['current_image'];
                if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                    $imageUrl = handleImageUpload($_FILES['image']);
                }
                if (updateHabitat($_POST['id'], $_POST['name'], $_POST['description'], $imageUrl)) {
                    $content .= "<p class='success'>Habitat mis à jour avec succès.</p>";
                } else {
                    $content .= "<p class='error'>Erreur lors de la mise à jour de l'habitat.</p>";
                }
                break;
            case 'delete':
                if (deleteHabitat($_POST['id'])) {
                    $content .= "<p class='success'>Habitat supprimé avec succès.</p>";
                } else {
                    $content .= "<p class='error'>Erreur lors de la suppression de l'habitat.</p>";
                }
                break;
        }
    }

    // Formulaire de création d'habitat
    $content .= "
    <h3>Ajouter un nouvel habitat</h3>
    <form action='admin.php?action=manage_habitats' method='post' enctype='multipart/form-data'>
        <input type='hidden' name='action' value='create'>
        <label for='name'>Nom de l'habitat :</label>
        <input type='text' id='name' name='name' required>
        <label for='description'>Description :</label>
        <textarea id='description' name='description' required></textarea>
        <label for='image'>Image :</label>
        <input type='file' id='image' name='image' accept='image/*' required>
        <button type='submit'>Ajouter l'habitat</button>
    </form>";

    // Liste des habitats existants
    $habitats = getAllHabitats();
    $content .= "<h3>Liste des habitats</h3>";
    if (count($habitats) > 0) {
        $content .= "<table>
            <tr><th>Nom</th><th>Description</th><th>Image</th><th>Actions</th></tr>";
        foreach ($habitats as $habitat) {
            $content .= "<tr>
                <td>{$habitat['name']}</td>
                <td>{$habitat['description']}</td>
                <td><img src='{$habitat['image_url']}' alt='{$habitat['name']}' style='width:100px;'></td>
                <td>
                    <a href='admin.php?action=manage_habitats&edit={$habitat['id']}'>Modifier</a>
                    <form action='admin.php?action=manage_habitats' method='post' style='display:inline;'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='{$habitat['id']}'>
                        <button type='submit' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet habitat ?\");'>Supprimer</button>
                    </form>
                </td>
            </tr>";
        }
        $content .= "</table>";
    } else {
        $content .= "<p>Aucun habitat n'a été ajouté pour le moment.</p>";
    }

    // Formulaire de modification (affiché si un ID est passé en GET)
    if (isset($_GET['edit'])) {
        $habitatToEdit = getHabitatById($_GET['edit']);
        if ($habitatToEdit) {
            $content .= "
            <h3>Modifier l'habitat</h3>
            <form action='admin.php?action=manage_habitats' method='post' enctype='multipart/form-data'>
                <input type='hidden' name='action' value='update'>
                <input type='hidden' name='id' value='{$habitatToEdit['id']}'>
                <input type='hidden' name='current_image' value='{$habitatToEdit['image_url']}'>
                <label for='name'>Nom de l'habitat :</label>
                <input type='text' id='name' name='name' value='{$habitatToEdit['name']}' required>
                <label for='description'>Description :</label>
                <textarea id='description' name='description' required>{$habitatToEdit['description']}</textarea>
                <label for='image'>Image (laisser vide pour conserver l'image actuelle) :</label>
                <input type='file' id='image' name='image' accept='image/*'>
                <img src='{$habitatToEdit['image_url']}' alt='Image actuelle' style='width:100px;'>
                <button type='submit'>Mettre à jour l'habitat</button>
            </form>";
        }
    }

    return $content;
}

// Fonction pour gérer l'upload d'images
function handleImageUpload($file) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Vérifier si le fichier est une image réelle
    $check = getimagesize($file["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Vérifier la taille du fichier
    if ($file["size"] > 500000) {
        $uploadOk = 0;
    }

    // Autoriser certains formats de fichier
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }

    // Uploader le fichier
    if ($uploadOk == 1) {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        }
    }

    return false;
}

function getManageAnimalsContent() {
    $content = "<h2>Gestion des animaux</h2>";

    // Traitement des actions (création, mise à jour, suppression)
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $imageUrl = handleImageUpload($_FILES['image']);
                if (createAnimal($_POST['name'], $_POST['species'], $_POST['habitat_id'], $imageUrl)) {
                    $content .= "<p class='success'>Animal créé avec succès.</p>";
                } else {
                    $content .= "<p class='error'>Erreur lors de la création de l'animal.</p>";
                }
                break;
            case 'update':
                $imageUrl = $_POST['current_image'];
                if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                    $imageUrl = handleImageUpload($_FILES['image']);
                }
                if (updateAnimal($_POST['id'], $_POST['name'], $_POST['species'], $_POST['habitat_id'], $imageUrl)) {
                    $content .= "<p class='success'>Animal mis à jour avec succès.</p>";
                } else {
                    $content .= "<p class='error'>Erreur lors de la mise à jour de l'animal.</p>";
                }
                break;
            case 'delete':
                if (deleteAnimal($_POST['id'])) {
                    $content .= "<p class='success'>Animal supprimé avec succès.</p>";
                } else {
                    $content .= "<p class='error'>Erreur lors de la suppression de l'animal.</p>";
                }
                break;
        }
    }

    // Récupérer tous les habitats pour le formulaire
    $habitats = getAllHabitats();

    // Formulaire de création d'animal
    $content .= "
    <h3>Ajouter un nouvel animal</h3>
    <form action='admin.php?action=manage_animals' method='post' enctype='multipart/form-data'>
        <input type='hidden' name='action' value='create'>
        <label for='name'>Nom de l'animal :</label>
        <input type='text' id='name' name='name' required>
        <label for='species'>Espèce :</label>
        <input type='text' id='species' name='species' required>
        <label for='habitat_id'>Habitat :</label>
        <select id='habitat_id' name='habitat_id' required>
            <option value=''>Sélectionnez un habitat</option>";
    foreach ($habitats as $habitat) {
        $content .= "<option value='{$habitat['id']}'>{$habitat['name']}</option>";
    }
    $content .= "
        </select>
        <label for='image'>Image :</label>
        <input type='file' id='image' name='image' accept='image/*' required>
        <button type='submit'>Ajouter l'animal</button>
    </form>";

    // Liste des animaux existants
    $animals = getAllAnimals();
    $content .= "<h3>Liste des animaux</h3>";
    if (count($animals) > 0) {
        $content .= "<table>
            <tr><th>Nom</th><th>Espèce</th><th>Habitat</th><th>Image</th><th>Actions</th></tr>";
        foreach ($animals as $animal) {
            $content .= "<tr>
                <td>{$animal['name']}</td>
                <td>{$animal['species']}</td>
                <td>{$animal['habitat_name']}</td>
                <td><img src='{$animal['image_url']}' alt='{$animal['name']}' style='width:100px;'></td>
                <td>
                    <a href='admin.php?action=manage_animals&edit={$animal['id']}'>Modifier</a>
                    <form action='admin.php?action=manage_animals' method='post' style='display:inline;'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='{$animal['id']}'>
                        <button type='submit' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet animal ?\");'>Supprimer</button>
                    </form>
                </td>
            </tr>";
        }
        $content .= "</table>";
    } else {
        $content .= "<p>Aucun animal n'a été ajouté pour le moment.</p>";
    }

    // Formulaire de modification (affiché si un ID est passé en GET)
    if (isset($_GET['edit'])) {
        $animalToEdit = getAnimalById($_GET['edit']);
        if ($animalToEdit) {
            $content .= "
            <h3>Modifier l'animal</h3>
            <form action='admin.php?action=manage_animals' method='post' enctype='multipart/form-data'>
                <input type='hidden' name='action' value='update'>
                <input type='hidden' name='id' value='{$animalToEdit['id']}'>
                <input type='hidden' name='current_image' value='{$animalToEdit['image_url']}'>
                <label for='name'>Nom de l'animal :</label>
                <input type='text' id='name' name='name' value='{$animalToEdit['name']}' required>
                <label for='species'>Espèce :</label>
                <input type='text' id='species' name='species' value='{$animalToEdit['species']}' required>
                <label for='habitat_id'>Habitat :</label>
                <select id='habitat_id' name='habitat_id' required>
                    <option value=''>Sélectionnez un habitat</option>";
            foreach ($habitats as $habitat) {
                $selected = ($habitat['id'] == $animalToEdit['habitat_id']) ? 'selected' : '';
                $content .= "<option value='{$habitat['id']}' $selected>{$habitat['name']}</option>";
            }
            $content .= "
                </select>
                <label for='image'>Image (laisser vide pour conserver l'image actuelle) :</label>
                <input type='file' id='image' name='image' accept='image/*'>
                <img src='{$animalToEdit['image_url']}' alt='Image actuelle' style='width:100px;'>
                <button type='submit'>Mettre à jour l'animal</button>
            </form>";
        }
    }

    return $content;
}

function getViewReportsContent() {
    $content = "<h2>Comptes rendus vétérinaires</h2>";

    // Formulaire de filtrage
    $content .= "
    <form action='admin.php?action=view_reports' method='get'>
        <input type='hidden' name='action' value='view_reports'>
        <label for='animal_filter'>Filtrer par animal :</label>
        <select name='animal_filter'>
            <option value=''>Tous les animaux</option>";
    $animals = getAllAnimals();
    foreach ($animals as $animal) {
        $selected = (isset($_GET['animal_filter']) && $_GET['animal_filter'] == $animal['id']) ? 'selected' : '';
        $content .= "<option value='{$animal['id']}' $selected>{$animal['name']}</option>";
    }
    $content .= "
        </select>
        <label for='date_filter'>Filtrer par date :</label>
        <input type='date' name='date_filter' value='" . (isset($_GET['date_filter']) ? $_GET['date_filter'] : '') . "'>
        <button type='submit'>Filtrer</button>
    </form>";

    // Récupération des rapports filtrés
    $animalFilter = isset($_GET['animal_filter']) ? $_GET['animal_filter'] : null;
    $dateFilter = isset($_GET['date_filter']) ? $_GET['date_filter'] : null;
    $reports = getAllVeterinaryReports($animalFilter, $dateFilter);

    // Affichage des rapports
    if (count($reports) > 0) {
        $content .= "<table>
            <tr>
                <th>Date</th>
                <th>Animal</th>
                <th>Vétérinaire</th>
                <th>État de santé</th>
                <th>Nourriture</th>
                <th>Quantité</th>
                <th>Détails</th>
            </tr>";
        foreach ($reports as $report) {
            $content .= "<tr>
                <td>{$report['report_date']}</td>
                <td>{$report['animal_name']}</td>
                <td>{$report['vet_email']}</td>
                <td>{$report['health_status']}</td>
                <td>{$report['food_type']}</td>
                <td>{$report['food_quantity']}</td>
                <td>{$report['details']}</td>
            </tr>";
        }
        $content .= "</table>";
    } else {
        $content .= "<p>Aucun rapport vétérinaire trouvé.</p>";
    }

    return $content;
}
function getDashboardContent() {
    return "<h2>Tableau de bord</h2>";
    // Ajoutez ici le code pour afficher le tableau de bord
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur - Zoo Arcadia</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <h1>Espace Administrateur - Zoo Arcadia</h1>
        <nav>
            <ul>
                <li><a href="admin.php?action=create_user">Créer un utilisateur</a></li>
                <li><a href="admin.php?action=manage_services">Gérer les services</a></li>
                <li><a href="admin.php?action=manage_habitats">Gérer les habitats</a></li>
                <li><a href="admin.php?action=manage_animals">Gérer les animaux</a></li>
                <li><a href="admin.php?action=view_reports">Voir les rapports</a></li>
                <li><a href="admin.php?action=dashboard">Tableau de bord</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <?php
        if ($successMessage) {
            echo "<div class='success-message'>$successMessage</div>";
        }
        if ($errorMessage) {
            echo "<div class='error-message'>$errorMessage</div>";
        }
        echo $content;
        ?>
    </main>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Espace Administrateur</p>
    </footer>

    <script src="js/admin.js"></script>
</body>
</html>