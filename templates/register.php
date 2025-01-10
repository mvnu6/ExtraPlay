<main class="main-content">

    <body>
        <h1>Inscription</h1>

        <!-- Messages d'erreur ou de succès -->
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>

        <!-- Formulaire d'inscription -->
        <form action="#" method="POST">
            <input class="input-form" type="text" name="username" id="username" placeholder="Nom d'utilisateur" required><br>
            <input class="input-form" type="email" name="email" id="email" placeholder="Email" required><br>
            <input class="input-form" type="password" name="password" id="password" placeholder="Mot de passe" required><br>
            <button class="btn-login" type="submit">S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href="/login">Se connecter</a></p>

        <a href="/">Retour à l'accueil</a>
</main>
</body>

</html>