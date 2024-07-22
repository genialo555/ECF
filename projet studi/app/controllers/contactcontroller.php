<?php
require_once '../models/Contact.php';

class ContactController {
    public function afficher() {
        include '../views/contact/formulaire.php';
    }

    public function soumettre() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = new Contact($_POST);
            if ($contact->envoyer()) {
                include '../views/contact/succes.php';
            } else {
                include '../views/contact/erreur.php';
            }
        } else {
            header('Location: index.php?page=contact');
            exit();
        }
    }
}