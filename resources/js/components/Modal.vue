<script setup>
defineProps({
    show: Boolean,
});

defineEmits(["close"]);
</script>

<template>
    <teleport to="body">
        <div
            v-if="show"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div
                class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative"
            >
                <button
                    @click="$emit('close')"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                >
                    ✖
                </button>
                <slot />
            </div>
        </div>
    </teleport>
</template>
