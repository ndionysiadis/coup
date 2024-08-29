<script setup lang="ts">
import moment from "moment";
import {PhHeart} from "@phosphor-icons/vue";

const currentYear = moment().format('YYYY');
</script>

<template>
    <div class="text-gray-300 text-sm flex flex-col items-center">
        <div>COUP - Coffee, Wine, Kitchen &#169; {{ currentYear }}</div>
        <div class="flex items-center gap-1 text-xs text-gray-500">
            Made with
            <PhHeart weight="fill"/>
            & VILT stack by
            <span class="font-semibold">@ndionysiadis</span>
        </div>
    </div>
</template>
