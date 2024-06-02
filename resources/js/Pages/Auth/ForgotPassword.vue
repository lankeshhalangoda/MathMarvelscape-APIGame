<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
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
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;
</style>

<template>
    <Preloader v-if="loading" />

    <Head title="Forgot Password?" />

    <Header />

    <div class="game-container">
        <h3 style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 3rem;">FORGOT PASSWORD?</h3>
        <img src="../../../images/logo.svg" alt="Game Logo" class="game-logo">

        <br>

        <div class="mb-4 input-label-lg">
            Forgot your password? No worries.<br> Provide your email, and we'll send a reset link for you to choose a new
            password.
        </div>

        <div v-if="status" class="mb-4 font-medium text-md text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" style="padding-left: 400px; padding-right: 400px;">
            <div>
                <InputLabel for="email" value="Enter Your Email" class="input-label-lg" /><br>

                <TextInput id="email" type="email" class="mt-1 block w-full input-field-lg" v-model="form.email" required
                    autofocus autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <PrimaryButton class=" input-label-lg"
                    style="color: rgb(212, 219, 9); text-align: center; padding: 10px;" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Email Password Reset Link
                </PrimaryButton>
            </div>

            <div class="flex items-center justify-center mt-4">
                <Link :href="route('login')" class="underline input-label-lg">
                Back to Login
                </Link>
            </div>

        </form>
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
.input-field-lg {
    padding: 15px;
    font-size: 1em;
    color: #db3434;
    background-color: rgba(255, 255, 255, 0.6);
}

.input-label-lg {
    font-size: 0.9em;
    color: white;
    padding-bottom: 5px;
}
</style>
