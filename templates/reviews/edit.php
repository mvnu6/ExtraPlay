<article class="reviews-create">
<form method="POST" action="/reviews/edit?id=<?= $review['id_review'] ?>">
    <label for="note">Note :</label>
    <input type="number" id="note" name="note" value="<?= $review['note'] ?>" min="1" max="5" required>

    <label for="comment">Commentaire :</label>
    <textarea id="comment" name="comment" required><?= $review['comment'] ?></textarea>

    <button type="submit">Mettre à jour</button>
</form>