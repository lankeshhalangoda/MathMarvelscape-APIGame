<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
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

<Head title="Reset Password" />

<div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
</div>



<div class="game-container">
    <h3 style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 3rem;">RESET PASSWORD</h3>
    <img src="../../../images/logo.svg" alt="Game Logo" class="game-logo">
</div>

<br>

        <form @submit.prevent="submit" style="padding-left: 400px; padding-right: 400px;">
            <div>
                <InputLabel for="email" value="Email" class="input-label-lg" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full input-field-lg"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" class="input-label-lg"  />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full input-field-lg"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" class="input-label-lg" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full input-field-lg"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ms-4 py-3 px-6 input-label-lg"
                style="color: rgb(212, 219, 9); text-align: center; padding: 10px;" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
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
    font-family: 'TomatoFont';
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
