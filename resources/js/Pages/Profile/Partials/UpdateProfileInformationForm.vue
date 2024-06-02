<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;
</style>

<template>

    <section>
        <header>
            <p style="padding: 10px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 60px;">Profile Information</p>

            <p class="mt-1 text-md text-white-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" class="input-label-lg" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full input-field-lg"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2 input-label-lg" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" class="input-label-lg" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full input-field-lg"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2 input-label-lg" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-white-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline input-label-lg"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
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
