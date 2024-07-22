<?php

class HabitatController {

    public function index() {
        $habitats = Habitat::getAllHabitats();
        include '../views/admin/habitats/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission for creating a new habitat
            $data = [
                'id' => uniqid(),
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'location' => $_POST['location']
            ];
            $newHabitat = new Habitat($data);
            // Save $newHabitat to the database (or a data source)
            // Redirect to the habitat list
        } else {
            include '../views/admin/habitats/create.php';
        }
    }

    public function edit($id) {
        $habitat = Habitat::getHabitatById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission for editing an existing habitat
            $habitat->name = $_POST['name'];
            $habitat->type = $_POST['type'];
            $habitat->location = $_POST['location'];
            // Update the habitat in the database (or a data source)
            // Redirect to the habitat list
        } else {
            include '../views/admin/habitats/edit.php';
        }
    }

    public function delete($id) {
        $habitat = Habitat::getHabitatById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission for deleting the habitat
            // Delete the habitat from the database (or a data source)
            // Redirect to the habitat list
        } else {
            include '../views/admin/habitats/delete.php';
        }
    }
}<?php
require_once '../models/Habitat.php';


?>
