<script setup lang="ts">
import moment from "moment";
import { PhHeart } from "@phosphor-icons/vue";

const currentYear = moment().format("YYYY");
</script>

<template>
    <div class="flex flex-col items-center text-sm text-gray-300">
        <div>COUP - Coffee, Wine, Kitchen &#169; {{ currentYear }}</div>
        <div class="flex items-center gap-1 text-xs text-gray-500">
            Crafted with
            <PhHeart weight="fill" />
            by
            <span class="font-bold">@ndionysiadis</span>
        </div>
    </div>
</template>
