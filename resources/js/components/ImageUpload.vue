<script setup>
import { ref } from "vue";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
    modelValue: {
        type: [File, null],
        default: null,
    },
    maxSizeMB: {
        type: Number,
        default: 2,
    },
});

const error = ref(null);
const previewUrl = ref(null);
const fileName = ref(null);
const fileSize = ref(null);

function handleFileChange(event) {
    const file = event.target.files[0];
    if (!file) return;

    const maxBytes = props.maxSizeMB * 1024 * 1024;

    if (file.size > maxBytes) {
        error.value = `Image is larger than ${props.maxSizeMB} MB.`;
        previewUrl.value = null;
        emit("update:modelValue", null);
        return;
    }

    error.value = null;
    previewUrl.value = URL.createObjectURL(file);
    fileName.value = file.name;
    fileSize.value = (file.size / 1024 / 1024).toFixed(2) + " MB";

    emit("update:modelValue", file);
}
</script>

<template>
    <div class="space-y-4">
        <label class="block text-sm font-medium text-gray-700"
            >Upload Image</label
        >

        <!-- Uploadbox -->
        <div
            class="relative border-2 border-dashed border-gray-300 rounded-lg p-4 text-center transition hover:border-blue-500 hover:bg-blue-50 cursor-pointer"
        >
            <input
                type="file"
                accept="image/*"
                @change="handleFileChange"
                class="absolute inset-0 opacity-0 cursor-pointer z-10"
            />
            <div class="z-0 relative">
                <svg
                    class="mx-auto h-12 w-12 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 16V4m0 0L3 8m4-4l4 4M17 8h2a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2h2"
                    />
                </svg>
                <p class="mt-2 text-sm text-gray-600">
                    Click or drag an image
                    <span class="font-medium"
                        >(.jpg, .png, max {{ maxSizeMB }} MB)</span
                    >
                </p>
            </div>
        </div>

        <!-- Preview -->
        <transition name="fade">
            <div v-if="previewUrl" class="flex items-center gap-4">
                <img
                    :src="previewUrl"
                    alt="Preview"
                    class="w-24 h-24 object-cover rounded shadow-md ring-1 ring-gray-200"
                />
                <div>
                    <p class="text-sm text-gray-800 font-medium">
                        {{ fileName }}
                    </p>
                    <p class="text-xs text-gray-500">{{ fileSize }}</p>
                </div>
            </div>
        </transition>

        <!-- Error -->
        <div
            v-if="error"
            class="px-3 py-2 bg-red-100 text-red-700 text-sm rounded shadow-sm"
        >
            {{ error }}
        </div>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
