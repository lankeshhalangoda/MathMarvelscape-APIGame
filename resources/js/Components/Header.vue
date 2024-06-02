<template>
    <div class="header">
        <p class="header-button"
            v-if="!['home', 'index', 'login', 'register', 'password.request'].includes(route().current())"
            style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;"
            @click="gotoHome">
            <img src="assets/images/back-button.png" alt="Back Button" style="width: 50%; height: 50%; border-radius: 50%;">
        </p>
        <p class="header-button"
            v-if="!['index', 'login', 'register', 'start-game', 'password.request'].includes(route().current())"
            style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;" @click="logout">
            <img src="assets/images/logout-button.png" alt="Back Button"
                style="width: 50%; height: 50%; border-radius: 50%;">
        </p>
        <p class="header-button"
            style="width: 50px; height: 50px; margin-left: auto; display: flex; align-items: center; justify-content: center;"
            @click="gotoProfile">
            <img src="assets/images/profile-button.png" alt="Profile Button"
                style="width: 70%; height: 70%; border-radius: 50%;">
        </p>
        <div class="header-button"
            style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;"
            @click="toggleSoundState">
            <img :src="soundState === 'mute' ? 'assets/images/mute-button.png' : 'assets/images/unmute-button.png'"
                alt="Toggle Button" style="width: 50%; height: 50%; border-radius: 50%;">
        </div>

    </div>
</template>
<script setup>
import { stop, ref } from 'vue';
import Swal from 'sweetalert2';

const soundState = ref('mute');

const toggleSoundState = () => {
    soundState.value = soundState.value === 'mute' ? 'unmute' : 'mute';
    if (soundState.value === 'mute') {
        muteAllSounds();
    } else {
        playAllSounds();
    }
};



let backgroundMusic = null;
let isBackgroundMusicPlaying = 1;

const playClickSound = () => {
    const clickSound = new Audio('assets/sounds/click.mp3');
    clickSound.play();
};

const preloadClickSound = () => {
    const clickSound = new Audio('assets/sounds/click.mp3');
    clickSound.preload = 'auto';
};
preloadClickSound();

const logout = () => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out of the game!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#db3434',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, log me out!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(route('logout'))
            window.location.href = route('login')
        }
    })
};

let hasBackgroundMusicPlayed = false;


const playBackgroundMusic = () => {

    if (!hasBackgroundMusicPlayed) {
        backgroundMusic = new Audio('assets/sounds/bg.mp3');
        backgroundMusic.volume = 0.5;
        backgroundMusic.loop = true;
        backgroundMusic.play();
        hasBackgroundMusicPlayed = true;
    }



};

const muteAllSounds = () => {
    stopBackgroundMusic();

    hasBackgroundMusicPlayed = false;

    stopAllSounds();
};

const stopAllSounds = () => {
    const sounds = document.getElementsByTagName('audio');
    for (let i = 0; i < sounds.length; i++) {
        sounds[i].pause();
        sounds[i].currentTime = 0;
    }
};

const playAllSounds = () => {
    isBackgroundMusicPlaying = 1;
    playBackgroundMusic();
};

const stopBackgroundMusic = () => {
    if (backgroundMusic) {
        backgroundMusic.pause();
        backgroundMusic.currentTime = 0;
    }
};


const gotoProfile = () => {

    Swal.fire({
        title: 'Are you sure?',
        text: "You will be directed to your profile!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#db3434',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Go!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = route('profile.edit');
        }
    })
};

const gotoHome = () => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You will be redirected to the home page!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#db3434',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, go to home!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = route('home');
        }
    })
};

</script>

<style scoped>

@font-face {
    font-family: 'TomatoFont';
    src: url('../../../../public/assets/fonts/Squirk-RMvV.ttf') format('woff');
    font-weight: normal;
    font-style: normal;
}

.header {
    display: flex;
    justify-content: flex-end;
}
.header-button {
    background-color: #db3434;
    margin: 10px;
    color: white;
    border: 1px solid white;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}
.header-button:hover {
    background-color: rgb(25, 23, 23);
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.7);
}</style>
