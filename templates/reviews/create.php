<h1>Add Review</h1>
<form method="POST">
    <label for="note">Note:</label>
    <input type="number" name="note" min="1" max="5" required><br>

    <label for="comment">Comment:</label>
    <textarea name="comment" required></textarea><br>

    <input type="hidden" name="id_game" value="<?= $_GET['id_game'] ?>">
    <input type="submit" value="Submit">
</form>
