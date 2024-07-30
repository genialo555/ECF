# Gestion du Zoo Arcadia

Ce projet est une application web de gestion pour le zoo Arcadia, développée dans le cadre d'un projet de fin d'études. L'application permet de gérer les animaux, les habitats, les services, les employés, les vétérinaires et les administrateurs du zoo.

## Table des matières

- [Fonctionnalités principales](#fonctionnalités-principales)
- [Technologies utilisées](#technologies-utilisées)
- [Installation en local](#installation-en-local)
- [Déploiement](#déploiement)
- [Structure du projet](#structure-du-projet)
- [Contribuer au projet](#contribuer-au-projet)
- [Auteur](#auteur)
- [Licence](#licence)

## Fonctionnalités principales

### Espace public

- Consulter les informations sur les animaux, les habitats et les services du zoo
- Laisser des avis sur le zoo (modérés par les employés)
- Contacter le zoo via un formulaire

### Espace employé

- Gérer les services du zoo (ajout, modification, suppression)
- Valider ou refuser les avis des visiteurs
- Enregistrer l'alimentation quotidienne des animaux

### Espace vétérinaire

- Remplir des rapports d'examen pour chaque animal
- Consulter l'historique alimentaire des animaux

### Espace administrateur

- Gérer les comptes utilisateurs (employés, vétérinaires)
- Gérer les animaux, les habitats et les services
- Consulter les statistiques sur les consultations des animaux par les visiteurs

### Authentification et autorisations

- Espace dédié pour chaque type d'utilisateur (employé, vétérinaire, administrateur) protégé par authentification
- Autorisations gérées en fonction du rôle de l'utilisateur

## Technologies utilisées

- PHP 7.4 pour le backend
- MongoDB pour la base de données des consultations des animaux
- MySQL pour la base de données relationnelle (animaux, habitats, services, utilisateurs, etc.)
- HTML5, CSS3, JavaScript, Bootstrap 5 pour le frontend
- Architecture MVC (Modèle-Vue-Contrôleur)

## Installation en local

1. Clonez ce dépôt GitHub :2. Importez le fichier `database.sql` dans votre serveur MySQL local

3. Configurez les informations de connexion à la base de données dans le fichier `config/database.php`

4. Démarrez votre serveur local (par exemple avec XAMPP ou WAMP)

5. Accédez à l'application dans votre navigateur : `http://localhost/ecf/public/`

## Déploiement

Pour déployer cette application sur un serveur, suivez ces étapes :

1. Uploadez les fichiers sur votre serveur (via FTP ou SSH)

2. Importez le fichier `database.sql` dans votre base de données MySQL sur le serveur

3. Configurez les informations de connexion à la base de données dans le fichier `config/database.php`

4. Assurez-vous que le serveur web (Apache) et PHP sont correctement configurés

5. Accédez à l'application via l'URL de votre site

## Structure du projet

- `config/` : Fichiers de configuration (par exemple, connexion à la base de données)
- `controllers/` : Contrôleurs de l'application
- `models/` : Modèles de l'application
- `public/` : Fichiers accessibles publiquement (point d'entrée de l'application, assets)
- `views/` : Vues de l'application
- `database.sql` : Fichier SQL pour créer la base de données
- `README.md` : Ce fichier
- `LICENSE.md` : Fichier de licence

## Contribuer au projet

Les contributions sont les bienvenues ! Si vous souhaitez contribuer à ce projet, veuillez suivre les étapes suivantes :

1. Forkez le projet
2. Créez une nouvelle branche (`git checkout -b feature/AmazingFeature`)
3. Committez vos modifications (`git commit -m 'Add some AmazingFeature'`)
4. Pushez vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## Auteur


## Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE.md](LICENSE.md) pour plus de détails.
