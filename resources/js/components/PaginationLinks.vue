<script setup>
defineProps({
    paginator: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="flex justify-center">
        <nav class="bg-gray-200 rounded-full px-4 py-2">
            <ul class="flex text-gray-200 gap-4 font-medium py-2">
                <div v-for="links in paginator">
                    <li>
                        <a
                            :href="links.url"
                            class="rounded-full px-4 py-2 text-gray-600"
                            v-html="links.label"
                            :class="{
                                'text-amber-50': !links.url,
                                'bg-blue-300': links.active,
                            }"
                        ></a>
                    </li>
                </div>
            </ul>
        </nav>
    </div>
</template>
