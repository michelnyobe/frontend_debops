<?php
// Fonction de connexion à la base de données
function connectDB() {
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }
    return $conn;
}
// ... Le reste du code reste inchangé
?>
