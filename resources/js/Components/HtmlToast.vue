<template>
    <div class="text-sm" v-html="htmlContent"></div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    props: {
        htmlContent: String,
    },
});
</script>
