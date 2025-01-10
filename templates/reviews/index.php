<?php 
if (!isset($_SESSION['username'])) {
    header('Location: /login?redirect=/reviews');
    exit;
  }
?>

<?php foreach ($reviews as $review): ?>

    <div>
        <h3><?= htmlspecialchars($review['id_game']) ?> - <?= htmlspecialchars($review['username']) ?></h3>
        <p>Note : <?= htmlspecialchars($review['note']) ?>/5</p>
        <p><?= htmlspecialchars($review['comment']) ?></p>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $review['id_user']): ?>
            <!-- Formulaire pour modifier l'avis -->
            <a href="/reviews/edit?id=<?= $review['id_review'] ?>">Modifier</a>

            <!-- Formulaire pour supprimer l'avis -->
            <form action="/reviews/delete" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')">
                <input type="hidden" name="id_review" value="<?= $review['id_review'] ?>">
                <button type="submit">Supprimer</button>
            </form>
        <?php endif; ?>
    </div>
<?php endforeach; ?>