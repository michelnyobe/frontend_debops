<?php
// Inclure le fichier de base de données
require_once 'db_connect.php';

// Afficher les contacts
$contacts = afficherContacts();

// Traitement des actions CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ajouter'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $detail = $_POST['detail'];
        ajouterContact($nom, $prenom, $detail);
        header('Location: index.php');
        exit;
    } elseif (isset($_POST['modifier'])) {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $detail = $_POST['detail'];
        modifierContact($id, $nom, $prenom, $detail);
        header('Location: index.php');
        exit;
    } elseif (isset($_POST['supprimer'])) {
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
    <?php if (empty($contacts)): ?>
    <p>Aucun contact trouvé.</p>
    <?php else: ?>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Détail</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?php echo $contact['nom']; ?></td>
            <td><?php echo $contact['prenom']; ?></td>
            <td><?php echo $contact['details']; ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                    <button type="submit" name="modifier">Modifier</button>
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
        <label for="detail">Détail:</label><br>
        <textarea id="detail" name="detail"></textarea><br>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>
</body>

</html>
