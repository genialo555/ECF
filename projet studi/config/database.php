<?php
require 'vendor/autoload.php';

class Database
{
    private static $mongoConnection;
    private static $mysqlConnection;

    public static function getMongoConnection()
    {
        if (!self::$mongoConnection) {
            $client = new MongoDB\Client("mongodb://localhost:27017");
            self::$mongoConnection = $client->selectDatabase('zoo');
        }
        return self::$mongoConnection;
    }

    public static function getMysqlConnection()
    {
        if (!self::$mysqlConnection) {
            $host = 'localhost';
            $dbname = 'zoo_arcadia';
            $username = 'votre_nom_utilisateur';
            $password = 'votre_mot_de_passe';

            try {
                self::$mysqlConnection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
                self::$mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données MySQL : " . $e->getMessage());
            }
        }
        return self::$mysqlConnection;
    }
}

// Exemple d'utilisation des connexions
$mongoDatabase = Database::getMongoConnection();
$mysqlConnection = Database::getMysqlConnection();