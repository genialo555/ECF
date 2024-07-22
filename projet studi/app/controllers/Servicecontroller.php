<?php
require_once '../models/Service.php';

class ServiceController {
    public function liste() {
        $services = Service::findAll();
        include '../views/services/list.php';
    }
}