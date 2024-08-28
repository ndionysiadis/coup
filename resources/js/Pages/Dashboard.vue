<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';

const props = defineProps<{
    user: App.Data.UserData
}>()

const title = 'Dashboard - COUP'
</script>

<template>
    <Head :title="title"/>

    <AuthenticatedLayout :user="props.user">
        <template #header>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
