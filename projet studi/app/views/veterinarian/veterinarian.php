<?php
session_start();
require_once 'functions/auth_functions.php';
requireLogin();

// Vérification du type d'utilisateur
if ($_SESSION['user_type'] !== 'admin') { // Changez 'admin' selon le fichier
    header('Location: login.php');
    exit();
}
require_once 'config/database.php';
require_once 'functions/veterinarian_functions.php';

// Vérification de l'authentification du vétérinaire
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'veterinarian') {
    header('Location: login.php');
    exit();
}

// Traitement des actions du vétérinaire
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'animal_report':
            $content = createAnimalReport($pdo);
            break;
        case 'habitat_comment':
            $content = addHabitatComment($pdo);
            break;
        case 'feeding_history':
            $content = viewFeedingHistory($pdo);
            break;
        default:
            $content = "<p>Action non reconnue.</p>";
    }
} else {
    $content = "<h2>Bienvenue dans l'espace vétérinaire</h2>
                <p>Veuillez sélectionner une action dans le menu.</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Vétérinaire - Zoo Arcadia</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Espace Vétérinaire - Zoo Arcadia</h1>
        <nav>
            <ul>
                <li><a href="veterinarian.php?action=animal_report">Créer un compte rendu</a></li>
                <li><a href="veterinarian.php?action=habitat_comment">Commenter un habitat</a></li>
                <li><a href="veterinarian.php?action=feeding_history">Historique d'alimentation</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <?php echo $content; ?>
    </main>

    <footer>
    <a href="logout.php">Déconnexion</a>
        <p>&copy; 2024 Zoo Arcadia - Espace Vétérinaire</p>
    </footer>
</body>
</html>