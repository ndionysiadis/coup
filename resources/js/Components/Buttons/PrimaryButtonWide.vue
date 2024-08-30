<script setup lang="ts">

</script>

<template>
    <button class="group w-full relative inline-block overflow-hidden px-8 py-2 text-white
                   focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-0 active:bg-primary-500">

         <span class="absolute inset-y-0 left-0 w-[2px] bg-primary-600 transition-all group-hover:w-full group-active:bg-primary-500"/>

        <span class="relative text-sm font-medium text-primary-400 transition-colors group-hover:text-white">
            <slot/>
        </span>

    </button>
</template>
