<div class="reviews-container">
<?php foreach ($reviews as $review): ?>
    <div class="review-container">
        <!-- Affichage de l'image de profil -->
        <img src="<?= htmlspecialchars($review['profile_picture'] ?? '/images/default-profile.jpg') ?>" alt="Profile Picture" class="profile-picture">

        <div class="review-content">
            <h3 class="review-username"><?= htmlspecialchars($review['username']) ?></h3>
            
            <?php
                $note = (int) $review['note'];  // La note de l'avis (1 à 5)
                $max_stars = 5;  // Le nombre d'étoiles maximum (5)
                $filled_stars = $note;  // Nombre d'étoiles pleines (or)
                $empty_stars = $max_stars - $filled_stars;  // Nombre d'étoiles vides (blanches)
            ?>

            <!-- Affichage des étoiles -->
            <span class="stars">
                <?php for ($i = 0; $i < $filled_stars; $i++): ?>
                    <i class="fas fa-star star-filled"></i>
                <?php endfor; ?>
                <?php for ($i = 0; $i < $empty_stars; $i++): ?>
                    <i class="fas fa-star star-empty"></i>
                <?php endfor; ?>
            </span>

            <p class="review-comment"><?= htmlspecialchars($review['comment']) ?></p>
            
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $review['id_user']): ?>
                <div class="review-actions">
                    <!-- Formulaire pour modifier l'avis -->
                    <a href="/reviews/edit?id=<?= $review['id_review'] ?>" class="button-modify">Modifier</a>

                    <!-- Formulaire pour supprimer l'avis -->
                    <form action="/reviews/delete" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')" class="delete-form">
                        <input type="hidden" name="id_review" value="<?= $review['id_review'] ?>">
                        <button type="submit" class="button-delete">Supprimer</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
</div>