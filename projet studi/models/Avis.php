<?php
class Avis {
  private $_id;
  private $pseudo;
  private $contenu;
  private $valide;

  public function __construct($data) {
    $this->_id = $data['_id'] ?? null;
    $this->pseudo = $data['pseudo'];
    $this->contenu = $data['contenu'];
    $this->valide = $data['valide'] ?? false;
  }

  public function getId() {
    return $this->_id;
  }

  public function getPseudo() {
    return $this->pseudo;
  }

  public function getContenu() {
    return $this->contenu;
  }

  public function getValide() {
    return $this->valide;
  }

  public function setValide($valide) {
    $this->valide = $valide;
  }

  public static function getCollection() {
    global $database;
    return $database->avis;
  }

  public static function findAll() {
    return self::getCollection()->find();
  }

  public static function findById($id) {
    return self::getCollection()->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
  }

  public static function findAllValides() {
    return self::getCollection()->find(['valide' => true]);
  }

  public function save() {
    if ($this->_id === null) {
      $result = self::getCollection()->insertOne([
        'pseudo' => $this->pseudo,
        'contenu' => $this->contenu,
        'valide' => $this->valide
      ]);
      $this->_id = $result->getInsertedId();
    } else {
      $this->update();
    }
  }

  public function update() {
    self::getCollection()->updateOne(
      ['_id' => new MongoDB\BSON\ObjectId($this->_id)],
      ['$set' => [
        'pseudo' => $this->pseudo,
        'contenu' => $this->contenu,
        'valide' => $this->valide
      ]]
    );
  }

  public function delete() {
    self::getCollection()->deleteOne(['_id' => new MongoDB\BSON\ObjectId($this->_id)]);
  }
}