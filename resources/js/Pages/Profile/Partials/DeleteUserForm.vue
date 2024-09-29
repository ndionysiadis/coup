<script setup lang="ts">
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";
import HeadingSmall from "@/Components/Texts/HeadingSmall.vue";
import FormInput from "@/Components/FormElements/FormInput.vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value?.focus());
};

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => {
            form.reset();
        },
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <HeadingSmall>Διαγραφή Λογαριασμού</HeadingSmall>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Μόλις διαγραφεί ο λογαριασμός σας, όλοι οι πόροι και τα δεδομένα
                του θα διαγραφούν οριστικά. Πριν τη διαγραφή τον λογαριασμό σας,
                πραγματοποιήστε λήψη τυχόν δεδομένων ή πληροφοριών που θέλετε να
                διατηρήσετε.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion"
            >Διαγραφή λογαριασμού</DangerButton
        >

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                >
                    Είστε βέβαιοι ότι θέλετε να διαγράψετε τον λογαριασμό σας;
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Μόλις διαγραφεί ο λογαριασμός σας, όλοι οι πόροι και τα
                    δεδομένα του θα διαγραφούν οριστικά. Παρακαλώ εισάγετε τον
                    κωδικό πρόσβασή σας για να επιβεβαιώσετε ότι θέλετε να
                    διαγράψετε οριστικά τον λογαριασμό σας.
                </p>

                <div class="mt-6">
                    <FormInput
                        id="password"
                        type="password"
                        label="Password"
                        ref="passwordInput"
                        v-model="form.password"
                        :error="form.errors.password"
                        @keyup.enter="deleteUser"
                    />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Άκυρο
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Διαγραφή
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
