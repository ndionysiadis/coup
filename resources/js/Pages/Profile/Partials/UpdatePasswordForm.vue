<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButtonIcon.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import FormInput from "@/Components/FormElements/FormInput.vue";

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value?.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value?.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <HeadingSmall>Ενημέρωση κωδικού πρόσβασης</HeadingSmall>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Βεβαιωθείτε ότι ο λογαριασμός σας χρησιμοποιεί έναν μακρύ, τυχαίο κωδικό πρόσβασης για να παραμείνετε ασφαλείς.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div class="flex flex-col gap-4">
                <FormInput
                    id="current_password"
                    ref="currentPasswordInput"
                    type="password"
                    label="Τρέχων κωδικός πρόσβασης"
                    v-model="form.current_password"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.current_password"/>

                <FormInput
                    id="password"
                    ref="passwordInput"
                    type="password"
                    label="Νέος κωδικός πρόσβασης"
                    v-model="form.password"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.password"/>

                <FormInput
                    id="password_confirmation"
                    type="password"
                    label="Επιβεβαίωση νέου κωδικού πρόσβασης"
                    v-model="form.password"
                    :required="false"
                    :autofocus="false"
                    :error="form.password_confirmation"/>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Αποθήκευση</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Αποθηκεύτηκε.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
