<template>

    <Preloader v-if="loading" />
     <Header />
    <div class="game-container">
        <img src="../../../images/logo.svg" alt="Game Logo" class="game-logo">
        <p style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 3rem;">Solve, Simplify, Succeed – Discover the Power of Numbers!</p>

        <p style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 1.2rem;" class="game-slogan">Join the quest to crunch numbers, assign values, and discover the joy of solving equations with tomatoes and smiles!</p>

    <Link class="game-button" :href="route('home')" @click="playClickSound" @mouseover="playHoverSound">Start</Link>

    </div>
</template>
<script setup>
import Header from '@/Components/Header.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
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
  src: url('../../../fonts/Squirk-RMvV.ttf') format('woff');
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


.game-logo {
    width: 300px;
    height: auto;
}

.game-button {
    padding: 10px 20px;
    margin: 10px;
    font-size: 1.5em;
    background-color: #db3434;
    color: white;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

.game-button:hover {
    background-color: rgb(212, 219, 9);
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.8);
}

game-slogan {
    font-size: 1.5em;
}

.game-slogan {
    font-size: 0.9em;
}

</style>
