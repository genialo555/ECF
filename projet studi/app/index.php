<?php
require_once '../config/database.php';
require_once '../controllers/AnimalController.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
  case 'animal_list':
    (new AnimalController)->liste();
    break;
  case 'animal_detail':
    (new AnimalController)->detail($_GET['id']);
    break;
  default:
    include '../views/home.php';
}