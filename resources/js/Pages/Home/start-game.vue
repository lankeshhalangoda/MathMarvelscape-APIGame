<template>
    <Preloader v-if="loading" />
    <div class="header">
        <p class="header-button" v-if="!['home', 'index', 'login', 'register'].includes(route().current())"
            style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;"
            @click="gotoHome">
            <img src="../../../images/back-button.png" alt="Back Button" style="width: 50%; height: 50%; border-radius: 50%;">
        </p>
        <p class="header-button" v-if="!['index', 'login', 'register', 'start-game'].includes(route().current())"
            style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;" @click="logout">
            <img src="../../../images/logout-button.png" alt="Logout Button"
                style="width: 50%; height: 50%; border-radius: 50%;">
        </p>
        <p class="header-button"
            style="width: 50px; height: 50px; margin-left: auto; display: flex; align-items: center; justify-content: center;"
            @click="gotoProfile">
            <img src="../../../images/profile-button.png" alt="Profile Button"
                style="width: 70%; height: 70%; border-radius: 50%;">
        </p>
        <div class="header-button"
            style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;"
            @click="toggleSoundState">
            <img :src="soundState === 'mute' ? 'assets/images/mute-button.png' : 'assets/images/unmute-button.png'"
                alt="Toggle Button" style="width: 50%; height: 50%; border-radius: 50%;">
        </div>
    </div>


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

        <p style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="game-slogan">Find the correct values for tomatoes.</p>


        <br>

        <img :src="image" alt="Question Image" class="question-image">

        <div>
            <button class="game-button" @click="solution(0)" @mouseover="playHoverSound">0</button>
            <button class="game-button" @click="solution(1)" @mouseover="playHoverSound">1</button>
            <button class="game-button" @click="solution(2)" @mouseover="playHoverSound">2</button>
            <button class="game-button" @click="solution(3)" @mouseover="playHoverSound">3</button>
            <button class="game-button" @click="solution(4)" @mouseover="playHoverSound">4</button>
            <button class="game-button" @click="solution(5)" @mouseover="playHoverSound">5</button>
            <button class="game-button" @click="solution(6)" @mouseover="playHoverSound">6</button>
            <button class="game-button" @click="solution(7)" @mouseover="playHoverSound">7</button>
            <button class="game-button" @click="solution(8)" @mouseover="playHoverSound">8</button>
            <button class="game-button" @click="solution(9)" @mouseover="playHoverSound">9</button>
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
const timeRemaining = ref(183);
let timer;

const timerIconSrc = ref('assets/images/timer-icon.png');

const clickSound = new Audio('assets/sounds/click.mp3');
const timesUpSound = new Audio('assets/sounds/times-up.mp3');


const startTimer = () => {
    timer = setInterval(() => {
        timeRemaining.value--;



        if (timeRemaining.value === 20) {

            for (let i = 0; i < 10; i++) {
                setTimeout(() => {
                    playClickSound();
                }, 1000 * i);
            }
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
                saveUserScore();
                router.visit(route('home'));
            });
        }

        saveUserScore();
    }, 1000);


};



const playClickSound = () => {
    const clickSound = new Audio('assets/sounds/click.mp3');
    clickSound.play();
};
const playHoverSound = () => {
    const hoverSound = new Audio('assets/sounds/hover.mp3');
    hoverSound.play();
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
            clearInterval(timer);
            router.visit(route('home'));
        }
    });
};

onMounted(() => {
    startGame();
    startTimer();
});

const startGame = async () => {
    try {
        const response = await axios.get(route('tomato-api'));
        const data = response.data;

        image.value = data.question;
        answer.value = data.solution;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
};



const saveUserScore = async () => {
    try {
        const response = await axios.post(route('save-score'), {
            score: score.value
        });
    } catch (error) {
        console.error('Error saving user score:', error);
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
            score.value++;
            saveUserScore();
            startGame();
        });
    } else {
        Swal.fire({
            title: 'Wrong!',
            text: 'You got it wrong!',
            icon: 'error',
            confirmButtonText: 'Try Again'
        }).then(() => {
            saveUserScore();
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

.header {
    display: flex;
    justify-content: flex-end;
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


.header-button {
    background-color: #db3434;
    margin: 10px;
    color: white;
    border: 1px solid #db3434;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

.game-button:hover {
    background-color: rgb(212, 219, 9);
    border: 1px solid  rgb(212, 219, 9);
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.8);
}

.header-button:hover {
    background-color: rgb(25, 23, 23);
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.7);
}
</style>
