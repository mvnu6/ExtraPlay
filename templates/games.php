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
            <div class="">
                <div class="game-image">
                    <a href="<?=$game['game_path']?>" class="game-hover-overlay-link">
                        <img src="<?= $game['image_path']; ?>" alt="<?= $game['name']; ?>" class="img-fluid">
                    </a>
                </div>
                
                <div class="py-2">
                    <h3 class="h6 text-uppercase mb-1">
                        <a href="<?=$game['game_path']?>" class="text-dark"><?= htmlspecialchars($game['name']); ?></a>
                    </h3>
                    <p class="text-muted"><?= htmlspecialchars($game['description']); ?></p>
                </div>

                <div class="game-action-buttons">
                    <a href="<?=$game['game_path']?>" class="btn btn-primary">
                        <i class="fa fa-gamepad"></i><span class="ml-2">Jouer</span>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>