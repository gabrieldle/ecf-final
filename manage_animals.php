<?php
session_start();
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'veterinaire') {
    header("Location: login.php");
    exit;
}

include "db.php";

// Traitement des formulaires pour ajouter, modifier ou supprimer des animaux
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $nom = $_POST['nom'];
        $espece = $_POST['espece'];
        $description = $_POST['description'];
        $date_arrivee = $_POST['date_arrivee'];
        $habitat = $_POST['habitat'];

        $stmt = $pdo->prepare("INSERT INTO animaux (nom, espece, description, date_arrivee, habitat) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $espece, $description, $date_arrivee, $habitat]);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $stmt = $pdo->prepare("DELETE FROM animaux WHERE id = ?");
        $stmt->execute([$id]);
    }
}

$animaux = $pdo->query("SELECT * FROM animaux")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Animaux</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include "html/header.html"; ?>

    <main class="main-content">
        <h2>Gérer les Animaux</h2>

        <h3>Ajouter un Animal</h3>
        <form method="POST">
            <input type="hidden" name="add" value="1">
            <label>Nom: <input type="text" name="nom" required></label><br>
            <label>Espèce: <input type="text" name="espece" required></label><br>
            <label>Description: <textarea name="description"></textarea></label><br>
            <label>Date d'arrivée: <input type="date" name="date_arrivee" required></label><br>
            <label>Habitat: <input type="text" name="habitat" required></label><br>
            <button type="submit">Ajouter</button>
        </form>

        <h3>Liste des Animaux</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Espèce</th>
                <th>Description</th>
                <th>Date d'Arrivée</th>
                <th>Habitat</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($animaux as $animal) : ?>
                <tr>
                    <td><?php echo $animal['id']; ?></td>
                    <td><?php echo $animal['nom']; ?></td>
                    <td><?php echo $animal['espece']; ?></td>
                    <td><?php echo $animal['description']; ?></td>
                    <td><?php echo $animal['date_arrivee']; ?></td>
                    <td><?php echo $animal['habitat']; ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">
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
