<?php

if (!isset($_SESSION['username'])) {
    header('Location: /login?redirect=/reviews/create');
    exit;
  }

// Récupérer tous les jeux de la base de données
$gameModel = new \App\Models\Game();
$games = $gameModel->getAllGames();
?>


<form method="POST" action="/reviews/create">
    <label for="game_name">Jeu :</label>
    <select name="id_game" id="game_name" required>
        <?php foreach ($games as $game): ?>
            <option value="<?= $game['id_game'] ?>"><?= htmlspecialchars($game['name']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" value="<?= htmlspecialchars($_SESSION['username']) ?>" readonly required>

    <label for="stars">Étoiles :</label>
    <div id="stars">
        <input type="radio" id="star5" name="note" value="5"><label for="star5">★</label>
        <input type="radio" id="star4" name="note" value="4"><label for="star4">★</label>
        <input type="radio" id="star3" name="note" value="3"><label for="star3">★</label>
        <input type="radio" id="star2" name="note" value="2"><label for="star2">★</label>
        <input type="radio" id="star1" name="note" value="1"><label for="star1">★</label>
    </div>

    <label for="comment">Commentaire :</label>
    <textarea id="comment" name="comment" required></textarea>

    <button type="submit">Envoyer</button>
</form>