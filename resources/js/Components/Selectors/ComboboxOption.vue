<script setup lang="ts">
const props = defineProps<{
    option: any;
    isSelected: boolean;
}>();

const emit = defineEmits(["select"]);

const handleClick = () => {
    emit("select", props.option);
};
</script>

<template>
    <li
        @click="handleClick"
        :class="[
            'cursor-pointer px-4 py-2',
            isSelected
                ? 'bg-gray-900 text-white'
                : 'transition duration-150 ease-in-out hover:bg-gray-900',
        ]"
    >
        <slot />
    </li>
</template>
