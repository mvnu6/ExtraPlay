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
  echo "<h1>Bienvenue, " . htmlspecialchars($_SESSION['username']) . " !</h1>";
}
?>
<main class="main-content">
  <h1>Liste des jeux</h1>
  <div class="games">
    <?php foreach ($games as $game): ?>
      

      <!-- Cartes ! -->
      <div class="grid">
        <div class="card-game">
          
          <a href="<?= $game['game_path'] ?>" class="text-dark"><?= htmlspecialchars($game['name']); ?></a>
          <p>
            Standard chunk of Lorem Ipsum used since the 1500s is showed below
            for those interested.
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
      </div>

    <?php endforeach; ?>
  </div>
</main>