<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id'])) {
  header('Location: /login');
  exit;
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>Quiz en Alpine.js</title>

  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding-top: 50px;
      background-color: #f4f4f4;
    }

    .quiz-container {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    button {
      margin: 10px 0;
      padding: 10px;
      width: 100%;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button.correct {
      background-color: green;
      color: white;
    }

    button.incorrect {
      background-color: red;
      color: white;
    }

    button:hover {
      opacity: 0.9;
    }

    /* Style pour les images des coeurs */
    .heart {
      width: 30px;
      height: 30px;
      margin: 5px;
    }

    .hearts-container {
      margin-top: 20px;
    }
  </style>
</head>
<!-- quizApp va etre rappele plus tard pour le js -->
<div class="quiz-container" x-data="quizApp()">
  <!-- tant que le quizz n'est pas fini cela affiche la question actuelle -->
  <div x-show="!estFini">
    <!-- Affiche la question actuelle -->
    <h2 x-text="questionActuelle.question"></h2>

    <!-- Affiche les trois boutons de réponses possibles -->
    <!--  vérifie si l'utilisateur a sélectionné la réponse "a", et si la réponse "a" est correcte.. -->
    <div>
      <button :class="{'correct': selectionnee === 'a' && estCorrect('a'), 'incorrect': selectionnee === 'a' && !estCorrect('a')}"
        @click="selectionnerReponse('a')"
        x-text="questionActuelle.answers[0]"></button>
    </div>
    <div>
      <button :class="{'correct': selectionnee === 'b' && estCorrect('b'), 'incorrect': selectionnee === 'b' && !estCorrect('b')}"
        @click="selectionnerReponse('b')"
        x-text="questionActuelle.answers[1]"></button>
    </div>
    <div>
      <button :class="{'correct': selectionnee === 'c' && estCorrect('c'), 'incorrect': selectionnee === 'c' && !estCorrect('c')}"
        @click="selectionnerReponse('c')"
        x-text="questionActuelle.answers[2]"></button>
    </div>

    <!-- Bouton pour passer à la question suivante -->
    <button x-show="selectionnee" @click="questionSuivante()">Question suivante</button>

    <!-- Conteneur pour afficher les coeurs pleins ou vides en fonction des bonnes réponses -->
    <div class="hearts-container">
      <!--boucle qui va itérer 5 fois et qui va génerer 5 images -->
      <template x-for="i in 5" :key="i">
        <img :src="i <= nbBonnesReponses ? '/images/coeur.jpg' : '/images/coeur_vide.png'" alt="coeur" class="heart">
      </template>
    </div>
  </div>

  <!-- Section qui s'affiche à la fin du quiz -->
  <div x-show="estFini">
    <h2>Quiz terminé !</h2>
    <p>Vous avez répondu correctement à <span x-text="nbBonnesReponses"></span> questions .</p>
    <button @click="recommencerQuiz()">Recommencer</button>
  </div>
</div>
<script>
  function quizApp() {
    return {
      questions: [{
          question: 'Traduis "corner" en français.',
          correct: 'a',
          answers: ['coin', 'pièce', 'angle']
        },
        {
          question: 'Traduis "silent" en français.',
          correct: 'a',
          answers: ['silencieux', 'muet', 'tranquille']
        },
        {
          question: 'Traduis "bottle" en français.',
          correct: 'a',
          answers: ['bouteille', 'flacon', 'récipient']
        },
        {
          question: 'Traduis "car" en français.',
          correct: 'a',
          answers: ['voiture', 'chaise', 'eau']
        },
        {
          question: 'Traduis "tree" en français.',
          correct: 'a',
          answers: ['arbre', 'nuage', 'vent']
        },
        {
          question: 'Traduis "book" en français.',
          correct: 'a',
          answers: ['livre', 'feu', 'poisson']
        },
        {
          question: 'Traduis "computer" en français.',
          correct: 'a',
          answers: ['ordinateur', 'oiseau', 'lait']
        },
        {
          question: 'Traduis "table" en français.',
          correct: 'b',
          answers: ['chaise', 'table', 'orange']
        },
        {
          question: 'Traduis "chair" en français.',
          correct: 'c',
          answers: ['maison', 'chien', 'chaise']
        },
        {
          question: 'Traduis "sun" en français.',
          correct: 'a',
          answers: ['soleil', 'pluie', 'ciel']
        },
        {
          question: 'Traduis "moon" en français.',
          correct: 'b',
          answers: ['maison', 'lune', 'arbre']
        },
        {
          question: 'Traduis "sky" en français.',
          correct: 'b',
          answers: ['vent', 'ciel', 'terre']
        },
        {
          question: 'Traduis "water" en français.',
          correct: 'a',
          answers: ['eau', 'feu', 'livre']
        },
        {
          question: 'Traduis "fire" en français.',
          correct: 'b',
          answers: ['oiseau', 'feu', 'nuage']
        },
        {
          question: 'Traduis "earth" en français.',
          correct: 'a',
          answers: ['terre', 'fruit', 'poisson']
        },
        {
          question: 'Traduis "wind" en français.',
          correct: 'a',
          answers: ['vent', 'eau', 'feu']
        },
        {
          question: 'Traduis "rain" en français.',
          correct: 'b',
          answers: ['chat', 'pluie', 'feu']
        },
        {
          question: 'Traduis "snow" en français.',
          correct: 'a',
          answers: ['neige', 'fleur', 'feu']
        },
        {
          question: 'Traduis "cloud" en français.',
          correct: 'a',
          answers: ['nuage', 'fraise', 'feu']
        },
        {
          question: 'Traduis "flower" en français.',
          correct: 'b',
          answers: ['fruit', 'fleur', 'arbre']
        },
        {
          question: 'Traduis "bird" en français.',
          correct: 'b',
          answers: ['fleur', 'oiseau', 'chien']
        },
        {
          question: 'Traduis "fish" en français.',
          correct: 'a',
          answers: ['poisson', 'lait', 'maison']
        },
        {
          question: 'Traduis "apple" en français.',
          correct: 'c',
          answers: ['poisson', 'chaise', 'pomme']
        },
        {
          question: 'Traduis "banana" en français.',
          correct: 'b',
          answers: ['voiture', 'banane', 'chien']
        },
        {
          question: 'Traduis "orange" en français.',
          correct: 'c',
          answers: ['chaise', 'voiture', 'orange']
        },
        {
          question: 'Traduis "lemon" en français.',
          correct: 'b',
          answers: ['fraise', 'citron', 'chat']
        },
        {
          question: 'Traduis "strawberry" en français.',
          correct: 'b',
          answers: ['citron', 'fraise', 'chaise']
        },
        {
          question: 'Traduis "grape" en français.',
          correct: 'a',
          answers: ['raisin', 'pain', 'livre']
        },
        {
          question: 'Traduis "milk" en français.',
          correct: 'a',
          answers: ['lait', 'eau', 'chien']
        },
        {
          question: 'Traduis "bread" en français.',
          correct: 'a',
          answers: ['pain', 'fruit', 'nuage']
        },
        {
          question: 'Traduis "cheese" en français.',
          correct: 'c',
          answers: ['maison', 'jus', 'fromage']
        },
        {
          question: 'Traduis "egg" en français.',
          correct: 'b',
          answers: ['dormir', 'oeuf', 'poisson']
        },
        {
          question: 'Traduis "meat" en français.',
          correct: 'a',
          answers: ['viande', 'chaise', 'eau']
        },
        {
          question: 'Traduis "vegetable" en français.',
          correct: 'a',
          answers: ['légume', 'sel', 'lait']
        },
        {
          question: 'Traduis "fruit" en français.',
          correct: 'a',
          answers: ['fruit', 'descendre', 'chien']
        },
        {
          question: 'Traduis "juice" en français.',
          correct: 'b',
          answers: ['lait', 'jus', 'voiture']
        },
        {
          question: 'Traduis "coffee" en français.',
          correct: 'a',
          answers: ['café', 'huile', 'voiture']
        },
        {
          question: 'Traduis "tea" en français.',
          correct: 'b',
          answers: ['arbre', 'thé', 'ciel']
        },
        {
          question: 'Traduis "sugar" en français.',
          correct: 'c',
          answers: ['livre', 'chaise', 'sucre']
        },
        {
          question: 'Traduis "salt" en français.',
          correct: 'a',
          answers: ['sel', 'poivre', 'voiture']
        },
        {
          question: 'Traduis "pepper" en français.',
          correct: 'b',
          answers: ['sel', 'poivre', 'chien']
        },
        {
          question: 'Traduis "butter" en français.',
          correct: 'b',
          answers: ['lait', 'beurre', 'poisson']
        },
        {
          question: 'Traduis "oil" en français.',
          correct: 'a',
          answers: ['huile', 'livre', 'chien']
        },
        {
          question: 'Traduis "knife" en français.',
          correct: 'a',
          answers: ['couteau', 'table', 'livre']
        },
        {
          question: 'Traduis "fork" en français.',
          correct: 'a',
          answers: ['fourchette', 'chaise', 'voiture']
        },
        {
          question: 'Traduis "spoon" en français.',
          correct: 'a',
          answers: ['cuillère', 'chat', 'arbre']
        },
        {
          question: 'Traduis "plate" en français.',
          correct: 'a',
          answers: ['assiette', 'livre', 'poisson']
        },
        {
          question: 'Traduis "cup" en français.',
          correct: 'a',
          answers: ['tasse', 'lait', 'maison']
        },
        {
          question: 'Traduis "glass" en français.',
          correct: 'a',
          answers: ['verre', 'fruit', 'voiture']
        },
        {
          question: 'Traduis "napkin" en français.',
          correct: 'a',
          answers: ['serviette', 'poisson', 'chien']
        },
        {
          question: 'Traduis "Bonjour" en anglais.',
          correct: 'b',
          answers: ['Hi', 'Hello', 'Goodbye']
        },
        {
          question: 'Traduis "Chat" en anglais.',
          correct: 'a',
          answers: ['Cat', 'Dog', 'Fish']
        },
        {
          question: 'Traduis "Pomme" en anglais.',
          correct: 'a',
          answers: ['Apple', 'Banana', 'Orange']
        },
        {
          question: 'Traduis "École" en anglais.',
          correct: 'c',
          answers: ['Playground', 'love', 'School']
        },
        {
          question: 'Traduis "Livre" en anglais.',
          correct: 'c',
          answers: ['movie', 'Magazine', 'Book']
        },
        {
          question: 'Traduis "Maison" en anglais.',
          correct: 'b',
          answers: ['Tree', 'house', 'Car']
        },
        {
          question: 'Traduis "Soleil" en anglais.',
          correct: 'a',
          answers: ['Sun', 'Coffee', 'Moon']
        },
        {
          question: 'Traduis "Fleur" en anglais.',
          correct: 'a',
          answers: ['Flower', 'Water', 'Coffee']
        },
        {
          question: 'Traduis "Rouge" en anglais.',
          correct: 'a',
          answers: ['Red', 'Green', 'yellow']
        },
        {
          question: 'Traduis "Rire" en anglais.',
          correct: 'c',
          answers: ['love', 'Cry', 'Laugh']
        },
        {
          question: 'Traduis "Manger" en anglais.',
          correct: 'a',
          answers: ['Eat', 'Run', 'eate']
        },
        {
          question: 'Traduis "Dormir" en anglais.',
          correct: 'a',
          answers: ['Sleep', 'Butterfly', 'Dance']
        },
        {
          question: 'Traduis "Chien" en anglais.',
          correct: 'c',
          answers: ['Elephant', 'Cow', 'Dog']
        },
        {
          question: 'Traduis "Chaton" en anglais.',
          correct: 'a',
          answers: ['Kitten', 'Lion', 'cat']
        },
        {
          question: 'Traduis "Sourire" en anglais.',
          correct: 'c',
          answers: ['Rainbow', 'Cry', 'Smile']
        },
      ],
      // Initialisation de la question actuelle (par index), des réponses sélectionnées et des compteurs
      indexQuestionActuelle: 0,
      selectionnee: null, // Réponse sélectionnée par l'utilisateur
      nbBonnesReponses: 0,
      nbQuestionsPosees: 0,
      estFini: false, // Indique si le quiz est terminé

      // Obtenir la question actuelle en fonction de l'index
      get questionActuelle() {
        return this.questions[this.indexQuestionActuelle];
      },


      selectionnerReponse(reponse) {
        if (!this.selectionnee) {
          this.selectionnee = reponse; // Marque la réponse sélectionnée
          if (this.estCorrect(reponse)) {
            this.nbBonnesReponses++; // Incrémente les bonnes réponses si correct
          }
          this.nbQuestionsPosees++; // Incrémente le nombre de questions posées


          if (this.nbBonnesReponses >= 5 || this.nbQuestionsPosees >= 10) {
            this.estFini = true;
          }
        }
      },

      // Vérifie si la réponse sélectionnée est correcte
      estCorrect(reponse) {
        return reponse === this.questionActuelle.correct;
      },

      // Sélectionne une nouvelle question aléatoire et réinitialise la réponse sélectionnée
      questionSuivante() {
        this.selectionnee = null;
        this.indexQuestionActuelle = Math.floor(Math.random() * this.questions.length);
      },


      recommencerQuiz() {
        this.nbQuestionsPosees = 0; // Réinitialise le compteur de questions
        this.indexQuestionActuelle = 0;
        this.nbBonnesReponses = 0;
        this.selectionnee = null;
        this.estFini = false; // Indique que le quiz n'est pas terminé
        this.questionSuivante(); // Sélectionne une nouvelle question au démarrage
      }
    };
  }
</script>
</body>

</html>
<?php echo "<a href='/logout'>Se déconnecter</a>"; ?>