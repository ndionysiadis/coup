<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import {Link, useForm, usePage} from '@inertiajs/vue3';
import FormInput from "@/Components/FormElements/FormInput.vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";

defineProps<{
    mustVerifyEmail?: Boolean;
    status?: String;
}>();

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header>
            <HeadingSmall>Πληροφορίες</HeadingSmall>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Ενημερώστε τις πληροφορίες προφίλ και τη διεύθυνση email του λογαριασμού σας.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div class="flex flex-col gap-4">
                <FormInput
                    id="name"
                    type="text"
                    label="Όνομα"
                    v-model="form.name"
                    :required="true"
                    :autofocus="true"
                    :error="form.errors.name"/>

                <FormInput
                    id="email"
                    type="email"
                    label="Email"
                    v-model="form.email"
                    :required="true"
                    :autofocus="false"
                    :error="form.errors.email"/>
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Η διεύθυνση email σας δεν έχει επαληθευτεί.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Κάντε κλικ εδώ για να στείλετε ξανά το email επαλήθευσης.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    Ένας νέος σύνδεσμος επαλήθευσης έχει σταλεί στη διεύθυνση email σας.
                </div>
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
