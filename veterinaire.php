<?php
session_start();
if ($_SESSION['role'] != 'veterinaire') {
    header("Location: index.php");
    exit;
}

include "header.html";
?>

<main>
    <h1>Interface Vétérinaire</h1>
    <section>
        <h2>Gérer les Animaux</h2>
        <a href="manage_animals.php">Modifier les informations des animaux</a>
    </section>
</main>

<?php include "footer.html"; ?>
