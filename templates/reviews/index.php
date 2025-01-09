<?php foreach ($reviews as $review): ?>
    <div>
        <h3><?= htmlspecialchars($review['id_game']) ?> - <?= htmlspecialchars($review['id_user']) ?></h3>
        <p>Note : <?= htmlspecialchars($review['note']) ?>/5</p>
        <p><?= htmlspecialchars($review['comment']) ?></p>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $review['id_user']): ?>
            <a href="/reviews/edit?id=<?= $review['id_review'] ?>">Modifier</a>
            <a href="/reviews/delete?id=<?= $review['id_review'] ?>" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>