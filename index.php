<?php
// Inclure le fichier de base de données
require_once 'db_connect.php';

// Afficher les contacts
$users = afficherContacts();

// Traitement des actions CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ajouter'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $details = $_POST['details'];
        ajouterContact($nom, $prenom, $details);
        header('Location: index.php');
        exit;
    } else (isset($_POST['supprimer'])) {
        $id = $_POST['id'];
        supprimerContact($id);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
</head>

<body>
    <h1>Liste des contacts</h1>
    <?php if (empty($users)): ?>
    <p>Aucun contact trouvé.</p>
    <?php else: ?>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Détails</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['nom']; ?></td>
            <td><?php echo $user['prenom']; ?></td>
            <td><?php echo $user['details']; ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>"
                    <button type="submit" name="supprimer">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <h2>Ajouter un contact</h2>
    <form method="post" action="">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom"><br>
        <label for="prenom">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom"><br>
        <label for="details">Détails:</label><br>
        <textarea id="details" name="details"></textarea><br>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>
</body>

</html>
