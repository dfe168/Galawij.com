<script setup>
import { usePage } from "@inertiajs/vue3";
import Message from "../../components/Message.vue";
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import PaginationLinks from "../../components/PaginationLinks.vue";

const page = usePage();

defineOptions({
    layout: DashboardLayout,
});

const contacts = page.props.messages;
</script>

<template>
    <Head title="Add New Painting" />
    <h2 class="text-4xl font-bold mb-10">Contact form</h2>
    <hr />
    <div v-for="contact in contacts.data" :key="contact.id">
        <Message
            :name="contact.name"
            :email="contact.email"
            :message="contact.message"
            :created_at="contact.created_at"
        />
    </div>
    <PaginationLinks class="mt-5" :paginator="contacts.links" />
</template>
