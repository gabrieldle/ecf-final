

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Zoo Écologique</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <section class="contact-form">
            <h2>Contactez-nous</h2>
            <?php
            if (isset($success)) {
                echo "<p class='success'>$success</p>";
            } elseif (isset($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = htmlspecialchars($_POST['name']);
                    $email = htmlspecialchars($_POST['email']);
                    $message = htmlspecialchars($_POST['message']);

                    $to = "votre.email@zoo.com";
                    $subject = "Nouveau message de $name";
                    $body = "Nom: $name\nEmail: $email\nMessage:\n$message";

                    if (mail($to, $subject, $body)) {
                        $success = "Message envoyé avec succès.";
                    } else {
                        $error = "Erreur lors de l'envoi du message.";
                    }
                }
                include "html/header.html"; // Affiche le HTML contenant le header
                ?>
            <form method="post" action="contact.php">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Envoyer</button>
            </form>
        </section>
    </main>
    <?php include "html/footer.html"; // Affiche le HTML contenant le footer ?>
</body>
</html>
