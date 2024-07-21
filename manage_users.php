<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include "db.php";

// Traitement des formulaires pour ajouter, modifier ou supprimer des utilisateurs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $mot_de_passe, $role]);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
    }
}

$utilisateurs = $pdo->query("SELECT * FROM utilisateurs")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Utilisateurs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include "html/header.html"; ?>

    <main class="main-content">
        <h2>Gérer les Utilisateurs</h2>

        <h3>Ajouter un Utilisateur</h3>
        <form method="POST">
            <input type="hidden" name="add" value="1">
            <label>Nom: <input type="text" name="nom" required></label><br>
            <label>Prénom: <input type="text" name="prenom" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Mot de Passe: <input type="password" name="mot_de_passe" required></label><br>
            <label>Rôle: 
                <select name="role">
                    <option value="veterinaire">Vétérinaire</option>
                    <option value="employe">Employé</option>
                    <option value="administrateur">Administrateur</option>
                </select>
            </label><br>
            <button type="submit">Ajouter</button>
        </form>

        <h3>Liste des Utilisateurs</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Date de Création</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
                <tr>
                    <td><?php echo $utilisateur['id']; ?></td>
                    <td><?php echo $utilisateur['nom']; ?></td>
                    <td><?php echo $utilisateur['prenom']; ?></td>
                    <td><?php echo $utilisateur['email']; ?></td>
                    <td><?php echo $utilisateur['role']; ?></td>
                    <td><?php echo $utilisateur['date_creation']; ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $utilisateur['id']; ?>">
                            <button type="submit" name="delete">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>

    <?php include "html/footer.html"; ?>
</body>
</html>
