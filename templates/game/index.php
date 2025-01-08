<?php ob_start(); ?>

<h1>Mes tâches</h1>

<a href="/create" class="button">Nouvelle tâche</a>

<div class="tasks">
    <?php foreach ($tasks as $task): ?>
        <div class="task <?= $task['completed'] ? 'completed' : '' ?>">
            <span><?= htmlspecialchars($task['title']) ?></span>
            <div class="actions">
                <a href="/toggle?id=<?= $task['id'] ?>" class="button">
                    <?= $task['completed'] ? '❌' : '✅' ?>
                </a>
                <a href="/delete?id=<?= $task['id'] ?>" class="button">🗑️</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>