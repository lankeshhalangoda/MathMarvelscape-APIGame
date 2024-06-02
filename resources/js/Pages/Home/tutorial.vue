<template>
    <div>
        <Preloader v-if="loading" />
     <Header />

        <Carousel>

            <Slide v-for="slide in 18" :key="slide">

                <div class="carousel__item">
                    <div :style="{ backgroundImage: `url(${getBackgroundImage(slide)})` }" class="carousel__background">
                    </div>
                </div>

                <span class="carousel__description" style="text-align: center; color: rgb(255, 255, 255);">{{
                    getSlideDescription(slide) }}</span>

            </Slide>

            <template #addons>
                <Navigation />
                <Pagination />
            </template>
        </Carousel>
    </div>
    <div class="carousel__prev" @click="prevSlide">
        <i class="fas fa-chevron-left"></i>
    </div>

    <div class="carousel__next" @click="nextSlide">
        <i class="fas fa-chevron-right"></i>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import Header from '@/Components/Header.vue';
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import Preloader from '@/Components/Preloader.vue'

const loading = ref(true);

onMounted(() => {

    setTimeout(() => {
      loading.value = false;
    }, 2000);
  });


const components = {
    Carousel,
    Slide,
    Pagination,
    Navigation,
};

const getBackgroundImage = (slide) => {

    const placeholderImages = [
        'assets/images/tutorials/1.png',
        'assets/images/tutorials/2.png',
        'assets/images/tutorials/3.png',
        'assets/images/tutorials/4.png',
        'assets/images/tutorials/5.png',
        'assets/images/tutorials/6.png',
        'assets/images/tutorials/7.png',
        'assets/images/tutorials/8.png',
        'assets/images/tutorials/9.png',
        'assets/images/tutorials/10.png',
        'assets/images/tutorials/11.png',
        'assets/images/tutorials/12.png',
        'assets/images/tutorials/13.png',
        'assets/images/tutorials/14.png',
        'assets/images/tutorials/15.png',
        'assets/images/tutorials/16.png',
        'assets/images/tutorials/17.png',
        'assets/images/tutorials/18.png',
    ];

    return placeholderImages[slide - 1];
};

const getSlideDescription = (slide) => {
    const slideDescriptions = [
        'This is the landing screen of the game. Click "Start" to enter the game.',
        'Current users should enter their email address and password. New users should create an account first.',
        'You can create a new account through this page.',
        'To reset your password if forgotten, simply redirect to this page and enter your email. You will receive and email with the reset link.',
        'If a mail was sent, a message will be displayed as in the screenshot.',
        'Click on "Reset Password" button in the mail.',
        'Add the new password, confirm it, and done.',
        'This is the Main Menu of the game.',
        'In the 180 game, you get 180 seconds to compete. Solve as much as you can to top the leaderboard.',
        'You can select a level.  Time reduces from level to level. Also, the time resets for each correct answer.',
        'You cannot have more than one record for a single account in the leaderboad. You have to beat your own score to top the board.',
        'Currently you are here :)',
        'Click on the correct value of the tomato.',
        'Click on the correct value of the smile emoji. ',
        'Timer becoming red indicates that your time will be up quickly.',
        'Through this section, you can update your profile details.',
        'Through this section, you can update your password.',
        'Through this section, you can delete your account.',
    ];

    return slideDescriptions[slide - 1];
};
</script>

<style>
@font-face {
    font-family: 'TomatoFont';
    src: url('../../../fonts/Squirk-RMvV.ttf') format('woff');
    font-weight: normal;
    font-style: normal;
}

.carousel__item {
    position: relative;
    height: 35vw;
    width: 100%;
    overflow: hidden;
    border-radius: 8px;
    border: 3px solid white;
    margin-left: 10%;
    margin-right: 10%;
}

body {
    background-image: url('../../../images/background-2.jpg');
}

.carousel__background {
    min-height: 100%;
    width: 100%;
    background-size: 100% 100%;
    background-position: center;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
  }

.carousel__content {
    position: relative;
    z-index: 1;
    text-align: center;
    color: var(--vc-clr-white);
    padding: 20px;
}

.carousel__description {
    margin-top: 10px;
    width: 500px;
    display: block;
    font-size: 25px;
    margin-right: 100px;
}

.carousel__slide {
    padding: 10px;
}

.carousel__prev,
.carousel__next {
    box-sizing: content-box;
    background-color: transparent;
    border: none;
    font-size: 10vw;
    color: white;
    cursor: pointer;
}

.carousel__pagination {
    color: white;
}
</style>
