<script setup lang="ts">
import {PhCheck} from "@phosphor-icons/vue";

const props = withDefaults(
    defineProps<{
        modelValue?: boolean,
        name: string,
        label: string,
        disabled?: boolean,
    }>(),
    {
        modelValue: false,
        disabled: false,
    }
)

const emit = defineEmits(['update:modelValue'])

function updateValue() {
    emit('update:modelValue', !props.modelValue)
}
</script>

<template>
    <label class="flex items-center cursor-pointer">
        <input
            type="checkbox"
            :name="props.name"
            :checked="props.modelValue"
            @change="updateValue"
            :disabled="props.disabled"
            class="hidden"
        />
        <div
            class="w-4 h-4 border border-primary-500 flex items-center justify-center focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500"
            :class="{
                'bg-primary-500': props.modelValue,
                'border-primary-500': !props.modelValue,
                'text-white': props.modelValue,
            }"
        >
            <PhCheck weight="bold" v-if="props.modelValue" class="-mt-0.5"/>
        </div>
        <span class="ms-2 text-sm text-white">{{ props.label }}</span>
    </label>
</template>
