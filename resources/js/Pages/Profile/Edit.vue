<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Profile
            </h2>
        </template>

        <HeadingLarge>Λογαριασμός</HeadingLarge>

        <div class="py-6">
            <div class="mx-auto max-w-7xl space-y-6">
                <div class="bg-white p-4 shadow sm:p-8 dark:bg-gray-800">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="bg-white p-4 shadow sm:p-8 dark:bg-gray-800">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <!--                <div class="bg-white p-4 shadow sm:p-8 dark:bg-gray-800">-->
                <!--                    <DeleteUserForm class="max-w-xl" />-->
                <!--                </div>-->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
