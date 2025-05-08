<script setup>
import Header from "../Layouts/Header.vue";
import SideBar from "../components/SideMenu/SideBar.vue";
</script>

<template>
    <Head>
        <meta head-key="description" name="description" />
    </Head>

    <!-- Header bovenaan -->
    <Header />
    <hr />

    <!-- Flexbox structuur: sidebar + main naast elkaar -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <SideBar />

        <!-- Main -->
        <main class="flex-1 w-full p-6 bg-gray-100 overflow-auto">
            <slot />
        </main>
    </div>
</template>
