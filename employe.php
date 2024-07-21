<?php
session_start();
if ($_SESSION['role'] != 'employe') {
    header("Location: index.php");
    exit;
}

include "header.html";
?>

<main>
    <h1>Interface Employé</h1>
    <section>
        <h2>Consulter les Statistiques</h2>
        <a href="view_stats.php">Voir les statistiques du zoo</a>
    </section>
</main>

<?php include "footer.html"; ?>
