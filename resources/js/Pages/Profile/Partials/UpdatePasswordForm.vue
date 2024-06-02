<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;
</style>

<template>
    <section>
        <header>
            <p style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 60px;">Update Password</p>


            <p class="mt-1 text-md text-white-600">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div>
                <InputLabel for="current_password" value="Current Password" class="input-label-lg" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full input-field-lg"
                    autocomplete="current-password"
                />

                <InputError :message="form.errors.current_password" class="mt-2 input-label-lg" />
            </div>

            <div>
                <InputLabel for="password" value="New Password" class="input-label-lg" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full input-field-lg"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" class="mt-2 input-label-lg" />
            </div>

            <div>
                <InputLabel for="password_confirmation" value="Confirm Password" class="input-label-lg" />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full input-field-lg"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password_confirmation" class="mt-2 input-label-lg" />
            </div>

            <div class="gap-4">
                <PrimaryButton :disabled="form.processing" style="padding: 1%; font-size: large;">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-white-600">Saved.</p>
                </Transition>
            </div>
        </form>
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
