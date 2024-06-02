<template>
   <Preloader v-if="loading" />
     <Header />

    <div class="game-container">
        <p style="padding-top: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="page-title">Select Your Level</p>

        <p style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="game-slogan">Give a Go! <br>Time reduces from level to level!</p>

        <div class="level-row">
            <Link class="game-button" :href="route('level1')" @click="playClickSound" @mouseover="playHoverSound">01</Link>
            <Link class="game-button" :href="route('level2')" @click="playClickSound" @mouseover="playHoverSound">02</Link>
            <Link class="game-button" :href="route('level3')" @click="playClickSound" @mouseover="playHoverSound">03</Link>
            <Link class="game-button" :href="route('level4')" @click="playClickSound" @mouseover="playHoverSound">04</Link>
            <Link class="game-button" :href="route('level5')" @click="playClickSound" @mouseover="playHoverSound">05</Link>
        </div>

        <div class="level-row">
            <Link class="game-button" :href="route('level6')" @click="playClickSound" @mouseover="playHoverSound">06</Link>
            <Link class="game-button" :href="route('level7')" @click="playClickSound" @mouseover="playHoverSound">07</Link>
            <Link class="game-button" :href="route('level8')" @click="playClickSound" @mouseover="playHoverSound">08</Link>
            <Link class="game-button" :href="route('level9')" @click="playClickSound" @mouseover="playHoverSound">09</Link>
            <Link class="game-button" :href="route('level10')" @click="playClickSound" @mouseover="playHoverSound">10</Link>
        </div>

    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Preloader from '@/Components/Preloader.vue'

const loading = ref(true);

onMounted(() => {

    setTimeout(() => {
      loading.value = false;
    }, 2000);
  });

const totalLevels = 10;


const playClickSound = () => {
    const clickSound = new Audio('assets/sounds/click.mp3');
    clickSound.play();
};

const playHoverSound = () => {
    const hoverSound = new Audio('assets/sounds/hover.mp3');
    hoverSound.play();
};

const preloadClickSound = () => {
    const clickSound = new Audio('assets/sounds/click.mp3');
    clickSound.preload = 'auto';
};
preloadClickSound();


const getLevelsForRow = (row) => {
    const startIndex = (row - 1) * 5 + 1;
    const endIndex = Math.min(startIndex + 4, totalLevels);
    return Array.from({ length: endIndex - startIndex + 1 }, (_, index) => startIndex + index);
};

const gotoHome = () => {
    playClickSound();
    router.visit(route('home'));
};

const goToLevel = (level) => {
    console.log(`Navigating to Level ${level}`);
};
</script>

<style scoped>

@font-face {
  font-family: 'TomatoFont';
  src: url('../../../fonts/Squirk-RMvV.ttf') format('woff');
  font-weight: normal;
  font-style: normal;
}
.level-row {
    display: flex;
    justify-content: center;
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

.page-title {
    font-size: 2em;
    margin-bottom: 20px;
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
    font-weight: 600;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

.game-button:hover {
    background-color: rgb(212, 219, 9);
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.8);

}

</style>

