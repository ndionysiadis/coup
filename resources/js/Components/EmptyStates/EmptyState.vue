<script setup lang="ts"></script>

<template>
    <div class="flex flex-col items-center gap-2">
        <div class="text-gray-400" v-motion-pop-visible :delay="300">
            <slot name="icon" />
        </div>

        <div class="text-lg font-semibold text-white">
            Δεν βρέθηκαν αποτελέσματα!
        </div>

        <div class="text-sm text-gray-400">
            <slot name="content" />
        </div>

        <div>
            <slot name="action" />
        </div>
    </div>
</template>
