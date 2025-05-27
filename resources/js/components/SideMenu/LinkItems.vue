<script setup>
defineProps({
    href: {
        type: String,
    },
    text: {
        type: String,
    },
});
</script>

<template>
    <a :href="href" class="block py-2 px-4 rounded hover:bg-gray-700">
        {{ text }}
    </a>
</template>
