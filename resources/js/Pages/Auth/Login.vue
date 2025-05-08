<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "../../components/TextInput.vue";

const form = useForm({
    email: null,
    password: null,
    remember: null,
});

const submit = () => {
    form.post("/login", {
        onError: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Login" />

    <div class="w=2/4 mx-auto">
        <form class="max-w-md mx-auto mt-5 p-5" @submit.prevent="submit">
            <h1 class="mx-auto mb-3">Login to your account</h1>
            <p class="mx-auto text-red-600 m-4" v-if="form.errors">
                {{ Object.values(form.errors)[0] }}
            </p>

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

            <div
                class="flex items-center justify-between text-slate-600 mt-3 mb-4"
            >
                <div>
                    <label for="">Remember me </label>
                    <input type="checkbox" v-model="form.remember" />
                </div>
            </div>

            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Login
            </button>
        </form>
    </div>
</template>
