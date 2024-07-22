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
require_once 'functions/employee_functions.php';

// Vérification de l'authentification de l'employé
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'employee') {
    header('Location: login.php');
    exit();
}

$content = '';

// Traitement des actions de l'employé
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'validate_reviews':
            $content = handleValidateReviews();
            break;
        case 'manage_services':
            $content = handleManageServices();
            break;
        case 'record_feeding':
            $content = handleRecordFeeding();
            break;
        default:
            $content = "<p>Action non reconnue.</p>";
    }
} else {
    $content = "<h2>Bienvenue dans l'espace employé</h2>
                <p>Veuillez sélectionner une action dans le menu.</p>";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Employé - Zoo Arcadia</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Espace Employé - Zoo Arcadia</h1>
        <nav>
            <ul>
                <li><a href="employee.php?action=validate_reviews">Valider les avis</a></li>
                <li><a href="employee.php?action=manage_services">Gérer les services</a></li>
                <li><a href="employee.php?action=record_feeding">Enregistrer l'alimentation</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <?php echo $content; ?>
    </main>

    <footer>
    <a href="logout.php">Déconnexion</a>
        <p>&copy; 2024 Zoo Arcadia - Espace Employé</p>
    </footer>
</body>
</html>