<script setup>
import Header from "./Header.vue";
</script>

<template>
    <Head>
        <meta kead-key="description" name="description" />
    </Head>
    <Header />
    <hr />
    <main>
        <slot> </slot>
    </main>
    <!-- <Footer/> -->
</template>
