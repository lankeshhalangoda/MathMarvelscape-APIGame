<template>
    <div class="preloader">
      <img src="assets/gifs/loadingbar.webp" alt="Loading..." />
      <p>Loading...</p>
    </div>
  </template>

  <style scoped>
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.9);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 1000;
    }

    p {
        color: yellow;
    }

    img {
      width: 500px;
      height: 100px;
    }
  </style>
