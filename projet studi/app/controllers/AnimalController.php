<?php
require_once '../models/Animal.php';

class AnimalController {
  public function liste() {
    $animaux = Animal::findAll();
    include '../views/animals/list.php';
  }

  public function detail($id) {
    $animal = Animal::findById($id);
    include '../views/animals/detail.php';
  }

  public function ajouter() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $animal = new Animal($_POST);
      $animal->save();
      header('Location: index.php?page=animal_list');
      exit();
    } else {
      include '../views/animals/ajouter.php';
    }
  }

  public function modifier($id) {
    $animal = Animal::findById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $animal = new Animal(array_merge(['_id' => $id], $_POST));
      $animal->update();
      header('Location: index.php?page=animal_detail&id='.$id);
      exit();
    } else {
      include '../views/animals/modifier.php';
    }
  }

  public function supprimer($id) {
    $animal = Animal::findById($id);
    $animal->delete();
    header('Location: index.php?page=animal_list');
    exit();
  }
}