<?php
require_once '../config/database.php';
require_once '../controllers/AnimalController.php';
require_once '../controllers/AvisController.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/AdminController.php';
require_once '../controllers/EmployeeController.php';
require_once '../controllers/VeterinarianController.php';

$veterinarianController = new VeterinarianController();

switch ($page) {
    // ...
    case 'veterinarian_dashboard':
        $veterinarianController->dashboard();
        break;
    case 'veterinarian_examine_animal':
        $veterinarianController->examineAnimal($_GET['id']);
        break;
    // ...
}

$employeeController = new EmployeeController();

switch ($page) {
    // ...
    case 'employee_dashboard':
        $employeeController->dashboard();
        break;
    case 'employee_feed_animal':
        $employeeController->feedAnimal($_GET['id']);
        break;
    // ...
}

$adminController = new AdminController();
$authController = new AuthController();

$page = $_GET['page'] ?? 'home';
$contentView = '';

// First switch handles admin-related pages
switch ($page) {
    case 'admin_dashboard':
        $adminController->dashboard();
        break;
    case 'admin_create_user':
        $adminController->createUser();
        break;
    // Add other admin cases here
}

// Second switch handles all other pages
switch ($page) {
    case 'animal_liste':
        (new AnimalController())->liste();
        $contentView = '../views/animals/list.php';
        break;
    case 'animal_detail':
        (new AnimalController())->detail($_GET['id']);
        $contentView = '../views/animals/detail.php';
        break;
    case 'animal_ajouter':
        (new AnimalController())->ajouter();
        $contentView = '../views/animals/ajouter.php';
        break;
    case 'animal_modifier':
        (new AnimalController())->modifier($_GET['id']);
        $contentView = '../views/animals/modifier.php';
        break;
    case 'animal_supprimer':
        (new AnimalController())->supprimer($_GET['id']);
        break;
    case 'avis_liste':
        (new AvisController())->liste();
        $contentView = '../views/avis/list.php';
        break;
    case 'avis_ajouter':
        (new AvisController())->ajouter();
        $contentView = '../views/avis/ajouter.php';
        break;
    case 'avis_valider':
        (new AvisController())->valider($_GET['id']);
        break;
    case 'avis_supprimer':
        (new AvisController())->supprimer($_GET['id']);
        break;
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;  
    default:
        $contentView = '../views/home.php';
        break;
}

include '../views/layout.php';
?>
