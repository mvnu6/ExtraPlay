<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    echo "<h1>Bienvenue, " . htmlspecialchars($_SESSION['username']) . " !</h1>";
    
}
?>  
<main class="main-content">
    <h1>Liste des jeux</h1>
    <div class="row">
        <?php foreach ($games as $game): ?>
            <div class="game col-xl-3 col-lg-4 col-sm-6">
                <div class="game-image">
                    <a href="/game/<?= $game['id_game']; ?>" class="game-hover-overlay-link">
                        <img src="/path/to/image/<?= $game['id_game']; ?>.jpg" alt="<?= $game['name']; ?>" class="img-fluid">
                    </a>
                </div>
                <div class="game-action-buttons">
                    <a href="/game/<?= $game['id_game']; ?>" class="btn btn-dark btn-buy">
                        <i class="fa fa-search"></i><span class="btn-buy-label ml-2">Voir</span>
                    </a>
                    <a href="/quiz/<?= $game['id_game']; ?>" class="btn btn-primary">
                        <i class="fa fa-gamepad"></i><span class="ml-2">Jouer</span>
                    </a>
                </div>
                <div class="py-2">
                    <h3 class="h6 text-uppercase mb-1">
                        <a href="/game/<?= $game['id_game']; ?>" class="text-dark"><?= htmlspecialchars($game['name']); ?></a>
                    </h3>
                    <p class="text-muted"><?= htmlspecialchars($game['description']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>