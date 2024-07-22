<?php
class User {
    private $id;
    private $email;
    private $password;
    private $role;

    public function __construct($data) {
        $this->id = $data['_id'] ?? null;
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->role = $data['role'];
    }

    // Getters et setters

    public static function getCollection() {
        global $database;
        return $database->selectCollection("users");
    }

    public static function findByEmail($email) {
        $user = self::getCollection()->findOne(['email' => $email]);
        return $user ? new User($user) : null;
    }

    public function save() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        self::getCollection()->insertOne([
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role
        ]);
    }
}