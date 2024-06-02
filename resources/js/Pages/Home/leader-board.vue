<template>
     <Preloader v-if="loading" />
     <Header />

    <div class="leaderboard-container">
        <p style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="leaderboard-heading">High Scores</p>

        <p style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="game-slogan">Compete yourself with others!</p>
        <div class="leaderboard-entry" style="background-color: #f0f0f013;">
      <div class="position">#</div>
      <div class="player-info">
        <p class="player-name">Name</p>
        <p class="player-score">Score</p>
      </div>
    </div>

        <div v-for="(player, index) in leaderboard" :key="index" class="leaderboard-entry"
            :style="{ backgroundColor: getBackgroundColor(index) }">
            <div class="position">{{ index + 1 }}</div>
            <div class="player-info">
                <p class="player-name">{{ player.name }}</p>
                <p class="player-score">{{ player.score }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Preloader from '@/Components/Preloader.vue'

const loading = ref(true);

onMounted(() => {

    setTimeout(() => {
      loading.value = false;
    }, 2000);
  });

const leaderboard = ref({});

const getBackgroundColor = (index) => {
    if (index < 3) {
        // Gold, silver, and bronze background for the first three records
        const colors = ['rgba(255, 215, 0, 0.8)', 'rgba(192, 192, 192, 0.8)', 'rgba(205, 133, 63, 0.8)'];
        return colors[index];
    } else {
        // Default background color for the rest
        return 'rgba(255, 255, 255, 0.1)';
    }
};

const getLeaderboard = async () => {

    const response = await axios.get(route('get-leaderboard'));

    if (response.status === 200) {
        leaderboard.value = response.data;
    }
};

const gotoHome = () => {
    router.visit(route('home'));
};

onMounted(() => {
    getLeaderboard();
});

</script>

<style scoped>

@font-face {
    font-family: 'TomatoFont';
    src: url('assets/fonts/Squirk-RMvV.ttf') format('woff');
    font-weight: normal;
    font-style: normal;
}

.game-slogan {
    font-size: 0.9em;
}
.leaderboard-container {
    margin-top: 0px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: white;
}

.leaderboard-heading {
    font-size: 2em;
    margin-bottom: 20px;
}

.leaderboard-entry {
    display: flex;
    align-items: center;
    margin: 10px;
    border-radius: 8px;
    padding-top: 1vw;
    width: 50vw;
    height: 3vw;
}

.position {
    font-size: 1.5em;
    width: 30px;
    text-align: center;
    margin-right: 10px;
    margin-left: 50px;
}

.player-info {
    display: flex;
    align-items: center;
    flex-grow: 1;
}

.player-name {
    margin-left: 200px;
    margin: auto;
}
.player-score {
    margin-right: 100px;
}

</style>
