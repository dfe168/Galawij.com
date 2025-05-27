<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import LinkItems from "./LinkItems.vue";

const isOpen = ref(false);
const sidebar = ref(null);

const toggle = () => (isOpen.value = !isOpen.value);
const close = () => (isOpen.value = false);

const handleClickOutside = (e) => {
    if (
        isOpen.value &&
        sidebar.value &&
        !sidebar.value.contains(e.target) &&
        !e.target.closest("button") // laat toggle-button toe
    ) {
        close();
    }
};

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});
onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
});
</script>

<template>
    <!-- Sidebar -->
    <aside
        ref="sidebar"
        :class="[
            'md:relative md:translate-x-0 md:z-0',
            'fixed inset-y-0 left-0 w-56 bg-gray-600 text-white transform transition-transform duration-300 ease-in-out z-40',
            isOpen ? 'translate-x-0' : '-translate-x-full',
        ]"
    >
        <div class="p-6 font-bold text-xl border-b border-gray-700">
            <a :href="route('dashboard.home')">Dashboard</a>
        </div>
        <nav @click="close" class="p-4 space-y-2 text-sm">
            <LinkItems :href="route('dashboard.add')" text="Add painting" />
            <LinkItems :href="route('dashboard.contacts')" text="Contacts" />
            <hr />
            <LinkItems
                :href="route('dashboard.register')"
                text="Register new admin"
            />
            <LinkItems :href="route('dashboard.user')" text="My profile" />
        </nav>
    </aside>

    <!-- Overlay voor mobiel -->
    <div
        v-if="isOpen"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
        @click="close"
    ></div>

    <!-- Mobiele topbar -->
    <header class="p-4 flex items-center md:hidden bg-white border-b">
        <button @click="toggle" class="text-gray-800">
            <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>
        </button>
    </header>
</template>
