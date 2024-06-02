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

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;
</style>

<template>
    <Preloader v-if="loading" />

    <Head title="Register" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <Header />


    <div class="game-container">
        <h3 style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 3rem;">REGISTER</h3>
        <img src="../../../images/logo.svg" alt="Game Logo" class="game-logo">
    </div>

    <br>

    <form @submit.prevent="submit" style="padding-left: 400px; padding-right: 400px;">
        <div>
            <InputLabel for="name" value="Name" class="input-label-lg" />

            <TextInput id="name" type="text" class="mt-1 block w-full input-field-lg" v-model="form.name" required autofocus
                autocomplete="name" />

            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="mt-4">
            <InputLabel for="email" value="Email" class="input-label-lg" />

            <TextInput id="email" type="email" class="mt-1 block w-full input-field-lg" v-model="form.email" required
                autocomplete="username" />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel for="password" value="Password" class="input-label-lg" />

            <TextInput id="password" type="password" class="mt-1 block w-full input-field-lg" v-model="form.password"
                required autocomplete="new-password" />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <InputLabel for="password_confirmation" value="Confirm Password" class="input-label-lg" />

            <TextInput id="password_confirmation" type="password" class="mt-1 block w-full input-field-lg"
                v-model="form.password_confirmation" required autocomplete="new-password" />

            <InputError class="mt-2" :message="form.errors.password_confirmation" />
        </div>

        <br>

        <div class="flex items-center justify-between mt-4">
            <Link :href="route('login')" class="underline input-label-lg">
            Already registered?
            </Link>

            <PrimaryButton class="ms-4 py-3 px-6 input-label-lg"
                style="color: rgb(212, 219, 9); text-align: center; padding: 10px;"
                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Register
            </PrimaryButton>
        </div>
    </form>
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
