<?php
require_once '../middleware/auth.php';
require_once '../models/Animal.php';

class VeterinarianController {
    public function dashboard() {
        requireAuth('veterinarian');
        $searchTerm = $_GET['search'] ?? '';
        $page = $_GET['p'] ?? 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;
        $sortBy = $_GET['sort'] ?? 'name';
        $sortOrder = $_GET['order'] ?? 'asc';
        $animals = Animal::search($searchTerm, $perPage, $offset, $sortBy, $sortOrder);
        $totalAnimals = Animal::countAnimals($searchTerm);
        $totalPages = ceil($totalAnimals / $perPage);
        include '../views/veterinarian/dashboard.php';
    }

    public function examineAnimal($animalId) {
        requireAuth('veterinarian');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $animal = Animal::findById($animalId);
            $examination = $_POST['examination'];
            $animal->addExamination($examination);
            header('Location: index.php?page=veterinarian_dashboard');
            exit();
        } else {
            $animal = Animal::findById($animalId);
            include '../views/veterinarian/examine_animal.php';
        }
    }
}