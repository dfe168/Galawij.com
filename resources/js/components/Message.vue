<script setup>
import { defineProps } from "vue";

const props = defineProps({
    name: String,
    email: String,
    message: String,
    created_at: String,
});

import { computed } from "vue";
import Contacts from "../Pages/Dashboard/Contacts.vue";

const formattedDate = computed(() => {
    if (!props.created_at) return "";
    // Format: 2025-05-10 21:32
    const date = new Date(props.created_at);
    const pad = (n) => n.toString().padStart(2, "0");
    return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(
        date.getDate()
    )} ${pad(date.getHours())}:${pad(date.getMinutes())}`;
});
</script>

<template>
    <div class="max-w-2xl px-8 py-4 bg-white rounded-lg shadow-md mt-4">
        <div class="flex items-center justify-between">
            <span
                href="#"
                class="text-xl font-bold text-gray-700 hover:text-gray-600 hover:underline"
                tabindex="0"
                >Name: {{ name }}</span
            >

            <span class="text-sm font-light text-gray-600">{{
                formattedDate
            }}</span>
        </div>
        <hr />
        <div class="flex items-center">
            <p class="mt-2 text-gray-600">
                {{ message }}
            </p>
        </div>
        <div>
            <a
                class="text-blue-700 cursor-pointer flex justify-end font-extralight mt-5"
                tabindex="0"
                :href="`mailto:${{ email }}`"
                >Sender E-mail: {{ email }}</a
            >
        </div>
    </div>
</template>
