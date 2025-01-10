<?php if (isset($_SESSION['username'])) {
  header('Location: /games');
  exit;
}
?>
<main class="main-content main-login">
    <h1>Connexion</h1>
    <!-- Affichage des erreurs -->
    <?php
    if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <!-- Formulaire de connexion -->
    <form action="#" method="post" class="">
        <input class="input-form" type="email" name="email" id="email" placeholder="Votre email" required><br>
        <input class="input-form" type="password" name="password" id="password" placeholder="Votre mot de passe" required><br>
        <button class="btn-login"type="submit">Se connecter</button>
    </form>
    <p>Pas encore de compte ? <a href="/register">S'inscrire</a></p>

    <a href="/">Retour à l'accueil</a>
    </body>

    </html>

    