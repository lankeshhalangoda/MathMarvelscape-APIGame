<template>
  <Preloader v-if="loading" />
     <Header />


  <div class="info-container" style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
    <span class="score" style="display: flex; align-items: center; text-align: left;">
      <img src="../../../images/score-icon.png" alt="Mute Button" style="width: 20%; margin-right: 10px;">
      Score: {{ score }}
    </span>
    <span class="score timer" style="display: flex; align-items: center; text-align: right;">
        <img :src="timerIconSrc" alt="Timer Icon" style="width: 10%; margin-left: 15px;">
      Time Remaining: {{ timeRemaining }}
    </span>
  </div>


  <div class="game-container">

    <p style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="game-slogan">Level 06</p>


    <br>

    <img :src="image" alt="Question Image" class="question-image">

    <div>
      <button class="game-button" @click="solution(0)">0</button>
      <button class="game-button" @click="solution(1)">1</button>
      <button class="game-button" @click="solution(2)">2</button>
      <button class="game-button" @click="solution(3)">3</button>
      <button class="game-button" @click="solution(4)">4</button>
      <button class="game-button" @click="solution(5)">5</button>
      <button class="game-button" @click="solution(6)">6</button>
      <button class="game-button" @click="solution(7)">7</button>
      <button class="game-button" @click="solution(8)">8</button>
      <button class="game-button" @click="solution(9)">9</button>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import Header from '@/Components/Header.vue';
import Preloader from '@/Components/Preloader.vue'

const loading = ref(true);

onMounted(() => {

    setTimeout(() => {
      loading.value = false;
    }, 2000);
  });

const image = ref(null);
const answer = ref(null);
const score = ref(0);
const timeRemaining = ref(53);

const timerIconSrc = ref('assets/images/timer-icon.png');

const clickSound = new Audio('assets/sounds/click.mp3');
const timesUpSound = new Audio('assets/sounds/times-up.mp3');

const startTimer = () => {
  const timer = setInterval(() => {
    timeRemaining.value--;


    if (timeRemaining.value === 10) {


      document.querySelector('.timer').style.color = 'red';
      timerIconSrc.value = 'assets/images/timer-red-icon.png';
    }

    if (timeRemaining.value === 0) {
        timesUpSound.play();
      clearInterval(timer);
      Swal.fire({
        title: 'Time\'s up!',
        text: 'You ran out of time!',
        icon: 'error',
        confirmButtonText: 'Back to Home'
      }).then(() => {
        window.location.href = route('home');
      });
    }
  }, 1000);
};


const playClickSound = () => {
  const clickSound = new Audio('assets/sounds/click.mp3');
  clickSound.play();
};

const gotoHome = () => {
  playClickSound();

  Swal.fire({
    title: 'Are you sure?',
    text: 'You will lose your progress!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, go back!',
    cancelButtonText: 'No, stay here'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = route('home');
    }
  });
};

onMounted(() => {
  startGame();
  startTimer();
});

const startGame = async () => {
  try {
    const response = await axios.get(route('smile-api'));
    const data = response.data;

    image.value = data.question;
    answer.value = data.solution;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

const solution = (number) => {
  if (answer.value == number) {
    Swal.fire({
      title: 'Correct!',
      text: 'You got it right!',
      icon: 'success',
      confirmButtonText: 'Next Question'
    }).then(() => {
      timeRemaining.value = 50;
      score.value++;
      document.querySelector('.timer').style.color = 'white';
      timerIconSrc.value = 'assets/images/timer-icon.png';
      startGame();


    });
  } else {
    Swal.fire({
      title: 'Wrong!',
      text: 'You got it wrong!',
      icon: 'error',
      confirmButtonText: 'Try Again'
    }).then(() => {
      startGame();
    });
  }
};

onMounted(() => {
  startGame();
});
</script>

<style scoped>

@font-face {
  font-family: 'TomatoFont';
  src: url('../../../fonts/Squirk-RMvV.ttf') format('woff');
  font-weight: normal;
  font-style: normal;
}
.info-container {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  color: white;
}

.score,
.time {
  font-weight: light;
}

.question-image {
  border-radius: 15px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  max-width: 100%;
  height: auto;
  margin-bottom: 20px;
}


.game-container {
  text-align: center;
  padding: 0%;
  margin: 0%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: white;
}


.game-button {
  padding: 10px 20px;
  margin: 10px;
  font-size: 1.5em;
  background-color: #db3434;
  color: white;
  border: 1px solid #db3434;
  border-radius: 20px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  text-decoration: none;
  font-weight: 600;
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}


.game-button:hover {
    background-color: rgb(212, 219, 9);
    border: 1px solid  rgb(212, 219, 9);
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.8);
}


.game-slogan {
    font-size: 4rem;
}
</style>
