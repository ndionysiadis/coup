<script setup lang="ts">
import {PhMagnifyingGlass, PhX} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import {computed} from "vue";

const props = withDefaults(
    defineProps<{
        modelValue?: string | null,
        autofocus?: boolean,
        clearRoute: string,
        placeholder?: string,
    }>(),
    {
        autofocus: false,
        placeholder: 'Πληκτρολογήστε για αναζήτηση...'
    }
)

const emit = defineEmits(['update:modelValue'])

function updateValue(event: Event) {
    const input = event.target as HTMLInputElement
    emit('update:modelValue', input.value)
}

console.log('Props:', props);
</script>

<template>
    <div
        class="relative block text-white border border-primary-500 shadow-sm focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500">
        <label for="search" class="sr-only">Αναζήτηση</label>

        <input
            id="search"
            type="text"
            :placeholder="props.placeholder"
            :value="props.modelValue"
            @input="updateValue"
            :autofocus="props.autofocus"
            class="peer block w-full pl-12 border-none placeholder-gray-400 placeholder-text-xs bg-transparent focus:border-transparent focus:outline-none focus:ring-0"
        />

        <AppLink v-if="props.modelValue" :href="props.clearRoute">
            <span
                class="absolute top-1/2 -translate-y-1/2 p-3 text-sm text-gray-400 bg-gray-800 hover:cursor-pointer">
                <PhX weight="bold" size="16"/>
            </span>
        </AppLink>

        <span v-if="!props.modelValue" class="absolute top-1/2 -translate-y-1/2 p-3 text-sm text-gray-400 bg-gray-800">
            <PhMagnifyingGlass weight="bold"/>
        </span>
    </div>
</template>
