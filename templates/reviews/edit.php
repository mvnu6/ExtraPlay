<h1>Edit Review</h1>
<form method="POST">
    <label for="note">Note:</label>
    <input type="number" name="note" value="<?= $review['note'] ?>" min="1" max="5" required><br>

    <label for="comment">Comment:</label>
    <textarea name="comment" required><?= $review['comment'] ?></textarea><br>

    <input type="submit" value="Update">
</form>
