<?php
if (!isset($_SESSION['username'])) {
    header('Location: /login?redirect=/games/memory');
    exit;
  }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jeu de mémoire</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <!-- Titre du jeu -->
    <div class="text-center">
        <h1 class="text-4xl font-bold">Jeu de la mémoire</h1>
        <p class="text-lg text-gray-600">Trouve toutes les paires d'images pour gagner des points !</p>
    </div>
    
    <!-- Jeu de mémoire -->
    <div x-data="jeu()" class="score-points px-10 flex items-center justify-center min-h-screen">
        <h1 class="fixed top-0 right-0 p-4 font-bold text-3xl">
            <span x-text="points"></span>
            <span class="text-xs">pts</span>
        </h1>

        <!-- Grille avec 4 colonnes pour 16 cartes (4x4) -->
        <div class="flex-1 grid grid-cols-4 gap-5">
            <template x-for="(carte, index) in cartes" :key="index">
                <div>
                    <button x-show="! carte.effacee"
                            class="w-full h-40 bg-gray-500"
                            :style="'background-image: url(' + (carte.retournee ? carte.image : 'back.jpg') + '); background-size: cover;'"
                            :disabled="cartesRetournees.length >= 2"
                            @click="retournerCarte(carte)"
                    >
                    </button>
                </div>
            </template>
        </div>
    </div>

    <!-- Message Flash -->
    <div x-data="{ montrer: false, message: '' }"
         x-show.transition.opacity="montrer"
         x-text="message"
         @flash.window="
            message = $event.detail.message;
            montrer = true;
            setTimeout(() => montrer = false, 1000)
        "
         class="fixed bottom-0 right-0 bg-green-500 text-white p-2 mb-4 mr-4 rounded"
    >
    </div>

    <script>
        function pause(milliseconds = 1000) {
            return new Promise(resolve => setTimeout(resolve, milliseconds));
        }

        function flash(message) {
            window.dispatchEvent(new CustomEvent('flash', {
                detail: { message }
            }));
        }

        // Fonction du jeu - optimisation possible : boucle
        function jeu() {
            return {
                cartes: [
                    { image: '/images/img1.jpg', retournee: false, effacee: false },
                    { image: '/images/img2.jpg', retournee: false, effacee: false },
                    { image: '/images/img3.jpg', retournee: false, effacee: false },
                    { image: '/images/img4.jpg', retournee: false, effacee: false },
                    { image: '/images/img5.jpg', retournee: false, effacee: false },
                    { image: '/images/img6.jpg', retournee: false, effacee: false },
                    { image: '/images/img7.jpg', retournee: false, effacee: false },
                    { image: '/images/img8.jpg', retournee: false, effacee: false },
                    { image: '/images/img1.jpg', retournee: false, effacee: false },
                    { image: '/images/img2.jpg', retournee: false, effacee: false },
                    { image: '/images/img3.jpg', retournee: false, effacee: false },
                    { image: '/images/img4.jpg', retournee: false, effacee: false },
                    { image: '/images/img5.jpg', retournee: false, effacee: false },
                    { image: '/images/img6.jpg', retournee: false, effacee: false },
                    { image: '/images/img7.jpg', retournee: false, effacee: false },
                    { image: '/images/img8.jpg', retournee: false, effacee: false },
                ].sort(() => Math.random() - .5), // Mélanger les cartes

                get cartesRetournees() {
                    return this.cartes.filter(carte => carte.retournee);
                },

                get cartesEffacees() {
                    return this.cartes.filter(carte => carte.effacee);
                },

                get cartesRestantes() {
                    return this.cartes.filter(carte => !carte.effacee);
                },

                get points() {
                    return this.cartesEffacees.length; // Points basés sur les cartes effacees
                },

                async retournerCarte(carte) {
                    carte.retournee = !carte.retournee; // Retourner la carte

                    if (this.cartesRetournees.length !== 2) return; // Ne rien faire si moins de 2 cartes sont retournees

                    if (this.aUneCorrespondance()) {
                        flash('Vous avez trouvé une paire !');

                        await pause();

                        this.cartesRetournees.forEach(carte => carte.effacee = true); // Marquer les cartes comme effacees

                        if (!this.cartesRestantes.length) {
                            alert('Vous avez gagné !');
                        }
                    } else {
                        await pause(); // Pause avant de retourner les cartes
                    }

                    this.cartesRetournees.forEach(carte => carte.retournee = false); // Retourner les cartes si pas de correspondance
                },

                aUneCorrespondance() {
                    return this.cartesRetournees[0]['image'] === this.cartesRetournees[1]['image']; // Vérifier si les cartes correspondent
                }
            };
        }
    </script>
    <div class="center-container">
    <a href="/" class="button-exit"><i class="fa-solid fa-house"></i></a>
</div>

</body>
</html>