<?php
// Assurez-vous que ce fichier a accès à la connexion PDO
require_once __DIR__ . '/../config/database.php';

// functions/animal_functions.php

require_once __DIR__ . '/../config/mock_database.php';


function getAllAnimals() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM animals ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log l'erreur et retourne un tableau vide
        error_log("Erreur lors de la récupération des animaux : " . $e->getMessage());
        return [];
    }
}

function getAnimalById($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM animals WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération de l'animal : " . $e->getMessage());
        return null;
    }
}

function createAnimal($name, $species, $habitat, $diet, $image_url) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO animals (name, species, habitat, diet, image_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $species, $habitat, $diet, $image_url]);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        error_log("Erreur lors de la création de l'animal : " . $e->getMessage());
        return false;
    }
}

function updateAnimal($id, $name, $species, $habitat, $diet, $image_url) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE animals SET name = ?, species = ?, habitat = ?, diet = ?, image_url = ? WHERE id = ?");
        return $stmt->execute([$name, $species, $habitat, $diet, $image_url, $id]);
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour de l'animal : " . $e->getMessage());
        return false;
    }
}

function deleteAnimal($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM animals WHERE id = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de l'animal : " . $e->getMessage());
        return false;
    }
}