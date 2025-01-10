<main class="main-content main-login">
    <h1>Connexion</h1>
    <!-- Affichage des erreurs -->
    <?php
    if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <!-- Formulaire de connexion -->
    <form action="#" method="post" class="">
        <label for="email">Adresse Email :</label><br>
        <input type="email" name="email" id="email" placeholder="Votre email" required><br>
        <label for="password">Mot de Passe :</label><br>
        <input type="password" name="password" id="password" placeholder="Votre mot de passe" required><br>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore de compte ? <a href="/register">S'inscrire</a></p>

    <a href="/">Retour à l'accueil</a>
    </body>

    </html>

    <!-- --- -->
<!-- 
    <!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form>
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="txt" placeholder="User name" required="">
					<input type="email" name="email" placeholder="Email" required="">
          <input type="number" name="broj" placeholder="BrojTelefona" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>Sign up</button>
				</form>
			</div>

			<div class="login">
				<form>
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>Login</button>
				</form>
			</div>
	</div>
</body>
</html> -->