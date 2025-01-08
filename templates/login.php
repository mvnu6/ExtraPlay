<?php
// Inclure le fichier header
include 'header.php';
?>

<section class="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Connexion</h2>
                <form action="process_login.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="email">Adresse email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Se connecter</button>
                </form>
                <p class="text-center mt-3">
                    Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a>.
                </p>
            </div>
        </div>
    </div>
</section>

<?php
// Inclure le fichier footer
include 'footer.php';
?>