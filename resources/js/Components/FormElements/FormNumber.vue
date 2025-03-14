<script setup lang="ts">
const props = withDefaults(
    defineProps<{
        modelValue?: number | string | null;
        label: string;
        error?: string;
        id: string;
        autofocus: boolean;
        required: boolean;
        disabled?: boolean;
        step: string;
        min?: number;
        max?: number;
    }>(),
    {
        label: "",
        autofocus: false,
        required: false,
        disabled: false,
        step: "1",
    },
);

const emit = defineEmits(["update:modelValue"]);

function updateValue(event: Event) {
    const input = event.target as HTMLInputElement;
    emit("update:modelValue", input.value);
}
</script>

<template>
    <div
        class="relative block border border-primary-500 text-white shadow-sm focus-within:border-primary-500 focus-within:ring-1 focus-within:ring-primary-500"
    >
        <label :for="props.id" class="sr-only">{{ props.label }}</label>

        <input
            :id="props.id"
            type="number"
            :step="props.step"
            :min="props.min"
            :max="props.max"
            :placeholder="props.label"
            :value="props.modelValue"
            @input="updateValue"
            :required="props.required"
            :autofocus="props.autofocus"
            :disabled="props.disabled"
            class="peer block w-full border-none bg-transparent placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0"
        />

        <span
            class="pointer-events-none absolute start-2.5 top-0 -translate-y-1/2 bg-gray-800 px-2 py-0.5 text-xs text-gray-400 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs"
        >
            {{ props.label }}
        </span>

        <span
            v-if="$slots.default"
            class="absolute inset-y-0 right-0 flex items-center bg-gray-800 px-3 text-gray-400"
        >
            <slot />
        </span>
    </div>

    <div v-if="props.error" class="-mt-3 text-sm text-red-400">
        {{ props.error }}
    </div>
</template>
