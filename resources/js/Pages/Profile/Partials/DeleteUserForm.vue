<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';


const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;
</style>

<template>
    <section class="space-y-6">

        <header>
            <p style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 60px;" class="game-slogan">
                Delete Account</p>

            <p class="mt-1 text-md text-white-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. <br>Before deleting
                your account, please download any data or information that you wish to retain.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion" style="padding: 1%; font-size: large;">Delete Account</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6 flex flex-col items-center">
                <p style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 60px; color: white;"
                    class="game-slogan">Are you sure?</p>

                <p class="mt-1 text-md text-white-600 text-center" style="color: white;">
                    Once your account is deleted, all of its resources and data will be permanently deleted. <br>Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6 w-full max-w-md">
                    <InputLabel for="password" value="Password" class="sr-only input-label-lg" />

                    <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                        class="mt-1 block w-full input-field-lg" placeholder="Password" @keyup.enter="deleteUser" />

                    <InputError :message="form.errors.password" class="mt-2 input-label-lg" />
                </div>

                <div class="mt-6 flex justify-center">
                    <SecondaryButton @click="closeModal" style="padding: 1%; font-size: large;">Cancel</SecondaryButton>

                    <DangerButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="deleteUser" style="padding: 1%; font-size: large;">
                        Delete Account
                    </DangerButton>
                </div>
            </div>
        </Modal>


    </section>
</template>


<style scoped>

@font-face {
    font-family: 'TomatoFont';
    src: url('../../../../public/assets/fonts/Squirk-RMvV.ttf') format('woff');
    font-weight: normal;
    font-style: normal;
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
