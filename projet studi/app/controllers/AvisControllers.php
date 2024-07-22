<?php
require_once '../models/Avis.php';

class AvisController {
  public function liste() {
    $avis = Avis::findAll();
    include '../views/avis/list.php';
  }

  public function ajouter() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $avis = new Avis($_POST);
      $avis->save();
      header('Location: index.php?page=avis_liste');
      exit();
    } else {
      include '../views/avis/ajouter.php';
    }
  }

  public function valider($id) {
    $avis = Avis::findById($id);
    $avis->setValide(true);
    $avis->update();
    header('Location: index.php?page=avis_liste');
    exit();
  }

  public function supprimer($id) {
    $avis = Avis::findById($id);
    $avis->delete();
    header('Location: index.php?page=avis_liste');
    exit();
  }
}