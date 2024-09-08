<script setup lang="ts">
const props = defineProps<{
    option: any;
    isSelected: boolean;
}>();

const emit = defineEmits(['select']);

const handleClick = () => {
    emit('select', props.option);
};
</script>

<template>
    <li
        @click="handleClick"
        :class="['px-4 py-2 cursor-pointer', isSelected ? 'bg-gray-900 text-white' : 'hover:bg-gray-900 transition duration-150 ease-in-out']"
    >
        <slot />
    </li>
</template>
