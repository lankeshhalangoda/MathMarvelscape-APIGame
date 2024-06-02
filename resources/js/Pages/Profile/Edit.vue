<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Preloader from '@/Components/Preloader.vue'
import { onMounted, ref } from 'vue';

const loading = ref(true);

onMounted(() => {

    setTimeout(() => {
      loading.value = false;
    }, 2000);
  });

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;
</style>

<template>
    <Preloader v-if="loading" />


<Head title="Profile" />

<div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
</div>

<Header />

<div class="game-container">
        <h3 style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 3rem;">USER DETAILS</h3>
        <img src="assets/images/logo.svg" alt="Game Logo" class="game-logo">

        <br>
                <div class="mb-4 input-label-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="input-label-lg"
                    />
                </div>

                <div class="mb-4 input-label-lg">
                    <UpdatePasswordForm class="input-label-lg" />
                </div>

                <div class="mb-4 input-label-lg">
                    <DeleteUserForm class="input-label-lg" />
                </div>


        </div>

</template>

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

.input-label-lg {
  font-size: 0.9em;
  color: white;
  padding-bottom: 5px;
}

</style>
