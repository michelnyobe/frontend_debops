<?php
// Inclure le fichier de configuration
require_once 'config.php';

// Fonction de connexion à la base de données
function connectDB() {
    // Paramètres de connexion à la base de données
    $host = getenv('DB_HOST'); // Adresse du serveur de base de données
    $dbname = getenv('DB_NAME'); // Nom de votre base de données
    $username = getenv('DB_USER'); // Nom d'utilisateur de la base de données
    $password = getenv('DB_PASSWORD'); // Mot de passe de la base de données

    try {
        // Création d'une nouvelle instance de connexion PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Configurer PDO pour afficher les erreurs de requête SQL
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo; // Retourner l'objet PDO
    } catch (PDOException $e) {
        // En cas d'erreur, afficher le message d'erreur
        die("Erreur de connexion : " . $e->getMessage());
    }

}

// Fonction pour afficher tous les contacts
function afficherContacts() {
    $pdo = connectDB();
    $sql = "SELECT * FROM users";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour ajouter un contact
function ajouterContact($nom, $prenom, $details) {
    $pdo = connectDB();
    $sql = "INSERT INTO users (nom, prenom, details) VALUES (:nom, :prenom, :details)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':details' => $details
    ));
}

// Fonction pour modifier un contact
function modifierContact($id, $nom, $prenom, $details) {
    $pdo = connectDB();
    $sql = "UPDATE users SET nom=:nom, prenom=:prenom, details=:details WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':details' => $details,
        ':id' => $id
    ));
}

// Fonction pour supprimer un contact
function supprimerContact($id) {
    $pdo = connectDB();
    $sql = "DELETE FROM users WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $id));
}
?>
