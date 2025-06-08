<script setup>
import { ref, onMounted } from "vue";

defineProps({
    message: [String, Object],
    alertType: {
        type: String,
        default: "error",
    },
});

const visible = ref(true);

onMounted(() => {
    setTimeout(() => {
        visible.value = false;
    }, 10 * 1000); // 3 seconden
});
</script>

<template>
    <div v-if="alertType == 'success'">
        <div
            v-if="visible"
            :key="JSON.stringify(message)"
            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200"
            role="alert"
        >
            <span class="font-medium">Success </span> {{ message }}
        </div>
    </div>
    <div v-if="alertType == 'error'">
        <div
            v-if="visible"
            :key="JSON.stringify(message)"
            class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200"
            role="alert"
        >
            <span class="font-medium"> </span> {{ message }}
        </div>
    </div>
</template>
