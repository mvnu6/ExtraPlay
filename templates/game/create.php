<?php ob_start(); ?>

<h1>Nouvelle tâche</h1>

<form action="/create" method="post" class="task-form">
    <input type="text" name="title" placeholder="Titre de la tâche" required>
    <button type="submit" class="button">Ajouter</button>
</form>

<a href="/" class="button">Retour</a>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>