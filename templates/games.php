<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
  header('Location: /login');
  exit;
}
if (isset($_SESSION['username'])) {
  echo "<h1 class='msg-logged'>Bienvenue, " . htmlspecialchars($_SESSION['username']) . " ! 👋</h1>";
}
?>
<main class="games-main">
  <h1 class="text-games">Liste des jeux 🎮</h1>
  <div class="games">
    <?php foreach ($games as $game): ?>
      

      <!-- Cartes ! -->
      <div class="grid">
      <a href="<?= $game['game_path'] ?>">
        <div class="card-game">
          
          <a href="<?= $game['game_path'] ?>" class="text-dark"><?= htmlspecialchars($game['name']); ?></a>
          <p>
          Devinez le mot caché en utilisant logique et déductions ! Un défi rapide et captivant.


          </p>
          <div class="shine"></div>
          <div class="background">
            <a href="<?= $game['game_path'] ?>" class="game-hover-overlay-link">
              <img src="<?= $game['image_path']; ?>" alt="<?= $game['name']; ?>" class="img-fluid">
          </div>
          <a href="<?= $game['game_path'] ?>" class="btn btn-primary">
            <i class="fa fa-gamepad"></i><span class="ml-2">Jouer</span>
          </a>
        </div>
      </a>
      </div>

    <?php endforeach; ?>
  </div>
</main>