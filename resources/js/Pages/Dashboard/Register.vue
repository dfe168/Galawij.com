<script setup>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import TextInput from "../../components/TextInput.vue";
import Alert from "../../components/Alert.vue";

defineOptions({
    layout: DashboardLayout,
});

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const page = usePage();

const submit = () => {
    form.post(route("register"), {
        onError: () => form.reset("password", "password_confirmation"),
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="w=2/4 mx-auto">
        <h2 class="text-4xl font-bold mb-10">Rigister a new user</h2>
        <hr />
        <form class="max-w-md mx-auto mt-5 p-5" @submit.prevent="submit">
            <div v-if="form.hasErrors">
                <Alert
                    alerttype="error"
                    :message="Object.values(form.errors)[0]"
                />
            </div>

            <div v-if="page.props.flash.message">
                <Alert
                    alertType="success"
                    :message="page.props.flash.message"
                />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <TextInput name="user" type="text" v-model="form.name" />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <TextInput name="email" type="email" v-model="form.email" />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <TextInput
                    name="password"
                    type="password"
                    v-model="form.password"
                />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <TextInput
                    name="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                />
            </div>

            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Register User
            </button>
        </form>
    </div>
</template>
