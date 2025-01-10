<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['username'])) {
  header('Location: /login?redirect=/games/motus');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lotus</title>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
</head>
<style>
  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;

    -webkit-box-shadow: 0 8px 10px -6px #000000;
    -moz-box-shadow: 0 8px 10px -6px #000000;
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.3);
  }

  nav h1 {
    padding-right: 5px;
    background-image: linear-gradient(65deg, #AE7D15, #ECD24D);
    background-size: 100%;
    background-repeat: repeat;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    -moz-background-clip: text;
    -moz-text-fill-color: transparent;
  }

  nav svg {
    width: 10%;
    padding: 1em;
  }

  main {
    margin-top: 2em;
    text-align: center;
  }

  main article {
    display: flex;
    justify-content: center;
  }

  main section {
    display: grid;
    gap: 5px;
  }

  main section div {
    padding: 8px;
    width: 27px;
    height: 25px;
    border: solid 1px grey;
  }

  .answer-grid {}

  .correct {
    background-color: red;
  }

  .present {
    background-color: yellow;
    border-radius: 25%;
  }

  .secretWord {
    margin-top: 4em;
    background-color: #70e000;
    border-radius: 25%;
  }

  .section-page {
    display: flex;
    justify-content: center;
  }

  .section-page article.keys {
    display: flex;
    flex-wrap: wrap;
    width: 35%;
  }

  .section-page article img {
    width: 39px;
    margin-left: 10px;
  }

  .answer-guess {
    display: flex;
    justify-content: center;
    margin-top: 3em;
  }

  .answer-guess input {
    padding: 10px;
    font-size: 16px;
    width: 150px;
    margin-right: 10px;
  }

  .answer-guess button {
    padding: 10px;
    font-size: 16px;
    cursor: pointer;
  }
</style>

<body x-data="{
    words: ['table', 'chaud', 'mango', 'lapin', 'fruit', 'Terre', 'Monde', 'Livre', 'Fleur', 'Balle', 'Plage', 'Pomme', 'Chien', 'Force', 'Paire', 'Lourd', 'Plume', 'Vivre', 'Maman', 'Neige', 'Excellent', 'Succulent', 'Restaurant', 'Mer', 'Lune', 'Pain', 'Chat', 'Porte', 'Livre', 'Soleil', 'Vache', 'Bonheur', 'Montagne', 'Parapluie', 'Amitié', 'Liberté', 'Vérité', 'Chocolat', 'Horizon', 'Ordinateur', 'Animalerie'],
    guess:'',
    open: false,
    fail: false,
    keep: true,
    count_guess: 6,
    tab_guess:[],
    tab_words:[],
    secretWord: '',
    correctPositions:[],
    presentLetters:[],
    init(){
      this.randomIndex= Math.floor(Math.random() * this.words.length);
      this.secretWord= this.words[this.randomIndex].toUpperCase();
      this.correctPositions= Array(this.secretWord.length).fill(false);
    },
    
    lotus() {
        this.tab_words=[];
        this.guess = this.guess.toUpperCase();
        if(this.guess.length === this.secretWord.length){
            
            for(let i = 0; i < this.guess.length; i++) {
                this.tab_words.push({
                    letter: this.guess[i],
                    isCorrectPosition: this.guess[i] === this.secretWord[i],
                    isPresentLetters: this.guess[i] !== this.secretWord[i] && this.secretWord.includes(this.guess[i])
                });
            }
            
        if (this.tab_guess.length < 6 && !this.open){
          this.tab_guess.push(this.tab_words);
          this.count_guess--;
        }
        if(this.guess === this.secretWord.toUpperCase()){
          this.open=true;
          this.count_guess=0;
        }
        if(this.count_guess === 0 && this.keep){
          if(this.guess === this.secretWord.toUpperCase()){
            this.open = true;
            this.keep = false;
          }
          else{
            this.fail= true;
            this.open=true;
          }
        }
        
        this.guess='';
      }
    }
  }">

  <main class="main-page">
    <p>Devinez le mot !</p>
    <!-- GRID -->
    <article class="grid-container">
      <section :style="'grid-template-columns: repeat(' + secretWord.length + ', 1fr)'">
        <template x-for="(word, index) in tab_guess.slice().reverse()">
          <!-- Slice() : crée une copie du tableau -->
          <template x-for="(letterInfo, i) in word" :key="i">
            <div x-text="letterInfo.letter" :class="{'correct' : letterInfo.isCorrectPosition, 'present' : letterInfo.isPresentLetters && !letterInfo.isCorrectPosition}"></div>
          </template>
        </template>
        <!-- afficher quand c'est fini -->
        <template x-if="count_guess===0">
          <template x-for="(letterInfo, i) in secretWord">
            <div x-text="letterInfo" :class="{'secretWord' : letterInfo}"></div>
          </template>
        </template>
        <!-- Essai -->
        <template x-for="letter in secretWord">
          <div x-show="!open" class="answer-grid"></div>
        </template>


      </section>
    </article>
    <!--  -->
    <p x-text="count_guess + ' mots restants'"></p>
    <p x-show="open && !fail" x-text="'Bravo ! T\'as bien trouvé le mot :  '+ secretWord"></p>
    <p x-show="fail" x-text="'Nice try fréro, le mot était :  '+ secretWord"></p>
    <p x-show="fail" x-text="-100 aura"></p>
    <a href="">
      <i class="fa-solid fa-arrow-rotate-right"></i>
    </a>
  </main>

  <section class="answer-guess">
    <input type="text" placeholder="Devine le mot" :maxlength="secretWord.length" x-model="guess" @keyup.enter="lotus()"> <!-- A changer max-lenght -->
    <button @click="lotus()">Entrer</button>
  </section>








  <script>
    const section = document.querySelector('main section');
    const submitButton = document.getElementById('submit');
    const guessInput = document.getElementById('guess');

    submitButton.addEventListener('click', () => {
      const guess = guessInput.value.toUpperCase();
      addNewElement(guess); // Ajoute l'élément en bas
      guessInput.value = ''; // Réinitialiser l'input
    });

    function addNewElement(letter) {
      const newDiv = document.createElement('div');
      newDiv.textContent = letter;
      section.appendChild(newDiv); // Ajoute le nouvel élément à la fin (en bas)
    }
  </script>
  <div class="center-container">
    <a href="/" class="button-exit"><i class="fa-solid fa-house"></i></a>
  </div>
</body>

</html>