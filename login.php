

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include "html/header.html"; // Affiche le HTML contenant le header ?>

    <main class="main-content">
        <div class="login-container">
            <h2 class="login-title">Connexion</h2>
            <form method="POST" action="login.php">
                <div class="input-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Se connecter</button>
                <?php if (!empty($error)) { echo '<p class="error">' . $error . '</p>'; } ?>
            </form>
        </div>
    </main>

    <?php include "html/footer.html"; // Affiche le HTML contenant le footer ?>
</body>
</html>

