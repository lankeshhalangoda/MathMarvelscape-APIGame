<template>
    <Preloader v-if="loading" />
    <Header />

    <div class="game-container">
        <img src="assets/images/logo.svg" alt="Game Logo" class="game-logo">
        <p style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="game-slogan">Solve, Simplify, Succeed – Discover the Power of Numbers!</p>

        <div class="buttons-container">
            <Link class="game-button" :href="route('start-game')" @click="playClickSound" @mouseover="playHoverSound">The 180 Game</Link>
            <Link class="game-button" :href="route('levels')" @click="playClickSound" @mouseover="playHoverSound">Levels</Link>
            <Link class="game-button" :href="route('leader-board')" @click="playClickSound" @mouseover="playHoverSound">Leaderboard</Link>
            <Link class="game-button" :href="route('tutorial')" @click="playClickSound" @mouseover="playHoverSound">Tutorial</Link>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Header from '@/Components/Header.vue';
import Preloader from '@/Components/Preloader.vue'

const loading = ref(true);

onMounted(() => {

    setTimeout(() => {
      loading.value = false;
    }, 2000);
  });


const playClickSound = () => {
    const clickSound = new Audio('assets/sounds/click.mp3');
    clickSound.play();
};

const playHoverSound = () => {
    const hoverSound = new Audio('assets/sounds/hover.mp3');
    hoverSound.play();
};



</script>

<style scoped>


@font-face {
    font-family: 'TomatoFont';
    src: url('assets/fonts/Squirk-RMvV.ttf') format('woff');
    font-weight: normal;
    font-style: normal;
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

.score,
.time {
  font-weight: light;
}


.game-logo {
    width: 300px;
    height: auto;
}


.buttons-container {
    display: flex;
    flex-direction: column;
}

.game-button {
    font-family: 'TomatoFont', fantasy;
    padding: 10px 20px;
    margin: 10px;
    font-size: 1.5em;
    background-color: #db3434;
    color: white;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    text-decoration: none;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

.game-button:hover {
    background-color: rgb(212, 219, 9);
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.8);
}

.game-slogan {
    font-size: 0.9em;
}
</style>
