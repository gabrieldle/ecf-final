<?php include "html/header.html"; // Affiche le HTML contenant le header ?>
<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

include "header.html";
?>

<main>
    <h1>Interface Administrateur</h1>
    <section>
        <h2>Gérer les Animaux</h2>
        <a href="manage_animals.php">Modifier les informations des animaux</a>
    </section>
    <section>
        <h2>Gérer les Utilisateurs</h2>
        <a href="manage_users.php">Ajouter, modifier ou supprimer des utilisateurs</a>
    </section>
    <section>
        <h2>Gérer les Services</h2>
        <a href="manage_services.php">Ajouter, modifier ou supprimer des services</a>
    </section>
</main>

<?php include "footer.html"; ?>
