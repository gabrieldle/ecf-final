<?php include "html/header.html"; // Affiche le HTML contenant le header ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Zoo d'Arcadia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main>
    <div class="video-container">
        <video autoplay muted loop id="bg-video">
            <source src="video/intro.mp4" type="video/mp4">
        </video>
    </div>
    <section class="text-image-section">
        <div class="text-content">
            <h2>Découvrez notre zoo</h2>
            <p>Le Zoo d'Arcadia, situé en France près de la forêt légendaire de Brocéliande en Bretagne, a ouvert ses portes en 1960. Depuis sa création, il s'est engagé à offrir un habitat naturel et sécurisé à une grande variété d'animaux.</p>
            <a href="train.php" class="btn">En savoir plus</a>
        </div>
        <div class="image-content">
            <img src="img/train.jpg" alt="Zoo d'Arcadia">
        </div>
    </section>
    <section class="text-image-section reverse">
        <div class="text-content">
            <h2>La santé et le bien-être des animaux</h2>
            <p>La santé et le bien-être des animaux sont au cœur des préoccupations du Zoo d'Arcadia. Chaque jour, avant l'ouverture du zoo, une équipe de vétérinaires effectue des contrôles rigoureux sur chaque animal.</p>
            <a href="train.php" class="btn">En savoir plus</a>
        </div>
        <div class="image-content">
            <img src="img/soin.jpg" alt="Vétérinaire au travail">
        </div>
    </section>
</main>

<?php include "html/presentation.html"; ?>
<?php include "html/footer.html"; // Affiche le HTML contenant le footer ?>
</body>
</html>








