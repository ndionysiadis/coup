<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogoFull.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden bg-gray-900 pb-20"
    >
        <div class="lines absolute inset-0">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>

        <div class="mb-6 flex w-full justify-center">
            <Link href="/">
                <ApplicationLogo
                    class="w-32 fill-current text-primary-500 sm:w-44"
                />
            </Link>
        </div>

        <div
            class="z-10 mt-6 w-full overflow-hidden bg-gray-800 px-4 py-6 shadow-2xl shadow-gray-950/50 sm:max-w-md sm:px-6"
        >
            <slot />
        </div>

        <div class="absolute inset-x-0 bottom-3 px-4 sm:px-0">
            <slot name="bottom" />
        </div>
    </div>
</template>

<style scoped>
* {
    box-sizing: border-box !important;
}

html,
body {
    height: 100%;
}

body {
    display: table;
    width: 100%;
    height: 100%;
    line-height: 1.6;
    position: relative;
    font-family: sans-serif;
    overflow: hidden;
}

.lines {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    margin: auto;
    width: 90vw;
}

.line {
    position: absolute;
    width: 1px;
    height: 100%;
    top: 0;
    left: 50%;
    background: rgba(255, 255, 255, 0.1);
    overflow: hidden;
}

.line::after {
    content: "";
    display: block;
    position: absolute;
    height: 15vh;
    width: 100%;
    top: -50%;
    left: 0;
    background: linear-gradient(
        to bottom,
        rgba(255, 255, 255, 0) 0%,
        #ffffff 75%,
        #ffffff 100%
    );
    animation: drop 7s 0s infinite;
    animation-fill-mode: forwards;
    animation-timing-function: cubic-bezier(0.4, 0.26, 0, 0.97);
}

.line:nth-child(1) {
    margin-left: -25%;
}

.line:nth-child(1)::after {
    animation-delay: 2s;
}

.line:nth-child(3) {
    margin-left: 25%;
}

.line:nth-child(3)::after {
    animation-delay: 2.5s;
}

@keyframes drop {
    0% {
        top: -50%;
    }
    100% {
        top: 110%;
    }
}
</style>
