<h1>All Reviews</h1>
<a href="/reviews/create">Add a review</a>

<ul>
    <?php foreach ($reviews as $review): ?>
        <li>
            <a href="/reviews/<?= $review['id_review'] ?>"><?= $review['comment'] ?></a>
        </li>
    <?php endforeach; ?>
</ul>
