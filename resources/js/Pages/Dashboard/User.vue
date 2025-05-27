<script setup>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import TextInput from "../../components/TextInput.vue";
import Button from "../../components/Button.vue";
import { usePage, useForm } from "@inertiajs/vue3";
import Alert from "../../components/Alert.vue";

defineOptions({
    layout: DashboardLayout,
});

const page = usePage();

const form = useForm({
    id: page.props.userInfo.id,
    name: page.props.userInfo.name,
    email: page.props.userInfo.email,
    current_password: null,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.put(route("user.update", form.id), {
        onError: () =>
            form.reset("current_password", "password", "password_confirmation"),
        onSuccess: () => {
            form.reset("current_password", "password", "password_confirmation");
        },
    });
};
</script>

<template>
    <Head title="| Profile" />
    <h2 class="text-4xl font-bold mb-10">My Profile</h2>
    <Alert
        v-if="form.hasErrors"
        alertType="error"
        :message="Object.values(form.errors)"
    />
    <Alert
        v-if="page.props.flash.message"
        alertType="success"
        :message="page.props.flash.message"
    />
    <hr />

    <div class="w=2/4 mx-auto">
        <form class="max-w-md mx-auto mt-5 p-5" @submit.prevent>
            <div class="relative z-0 w-full mb-5 group">
                <TextInput name="Name" type="text" v-model="form.name" />
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <TextInput name="E-mail" type="text" v-model="form.email" />
            </div>
            <div class="border p-2 mt-10">
                <small class="small">Change your password</small>
                <div class="relative z-0 w-full mt-2 group">
                    <TextInput
                        name="Current password"
                        type="password"
                        v-model="form.current_password"
                        :requred="false"
                    />
                </div>
                <div class="relative z-0 w-full mt-3 group">
                    <TextInput
                        name="password"
                        type="password"
                        v-model="form.password"
                        :requred="false"
                    />
                </div>
                <div class="relative z-0 w-full mt-3 mb-5 group">
                    <TextInput
                        name="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        :requred="false"
                    />
                </div>
            </div>

            <!-- Voeg hier andere velden toe zoals medium, width, length -->
            <div class="flex justify-between space-x-2 mt-10">
                <Button
                    text="Update"
                    type="submit"
                    class="cursor-pointer w-xl"
                    @click="submit"
                ></Button>
            </div>
        </form>
    </div>
</template>
