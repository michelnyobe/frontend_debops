<?php
// Inclure le fichier de configuration
require_once 'config.php';

// Fonction de connexion à la base de données
function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }
    return $conn;
}

// Fonction pour afficher tous les contacts
function afficherContacts() {
    $conn = connectDB();
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $contacts = array();
    if ($result !== false && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
    }
    $conn->close();
    return $contacts;
}

// Fonction pour ajouter un contact
function ajouterContact($nom, $prenom, $detail) {
    $conn = connectDB();
    $sql = "INSERT INTO users (nom, prenom, details) VALUES ('$nom', '$prenom', '$detail')";
    $conn->query($sql);
    $conn->close();
}

// Fonction pour modifier un contact
function modifierContact($id, $nom, $prenom, $detail) {
    $conn = connectDB();
    $sql = "UPDATE users SET nom='$nom', prenom='$prenom', details='$detail' WHERE id=$id";
    $conn->query($sql);
    $conn->close();
}

// Fonction pour supprimer un contact
function supprimerContact($id) {
    $conn = connectDB();
    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);
    $conn->close();
}
?>
