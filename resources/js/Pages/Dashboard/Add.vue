<script setup>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import TextInput from "../../components/TextInput.vue";
import Button from "../../components/Button.vue";
import ImageUpload from "../../components/ImageUpload.vue";
import { router, useForm } from "@inertiajs/vue3";

defineOptions({
    layout: DashboardLayout,
});

const form = useForm({
    id: null,
    name: "",
    medium: "",
    width: "",
    length: "",
    img: null,
});

const props = defineProps({
    imgError: null,
});

const submit = () => {
    form.post(route("paintings.create"), {
        onSuccess: () => {
            router.visit(route("dashboard.home"));
        },
    });
};
</script>

<template>
    <Head title="Add New Painting" />
    <h2 class="text-4xl font-bold mb-10">Add New Painting</h2>
    <hr />
    <p class="mx-auto text-red-600 text-center m-4" v-if="form.errors">
        {{ Object.values(form.errors)[0] }}
    </p>
    <div class="w=2/4 mx-auto">
        <form class="max-w-md mx-auto mt-5 p-5" @submit.prevent>
            <ImageUpload v-model="form.img" :max-size-m-b="2" class="mb-5" />

            <div class="relative z-0 w-full mb-5 group">
                <TextInput
                    name="Painting Name:"
                    type="text"
                    v-model="form.name"
                />
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <TextInput name="Medium:" type="text" v-model="form.medium" />
            </div>
            <div class="relative z-0 w-1/2 mb-5 group">
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <TextInput
                            name="Width:"
                            type="number"
                            v-model="form.width"
                        />
                    </div>
                    <div class="w-1/2">
                        <TextInput
                            name="Length:"
                            type="number"
                            v-model="form.length"
                        />
                    </div>
                </div>
            </div>
            <!-- Voeg hier andere velden toe zoals medium, width, length -->
            <div class="flex justify-between space-x-2 mt-10">
                <Button text="Reset" type="reset" class="cursor-pointer w-xl" />
                <Button
                    text="Submit"
                    type="submit"
                    class="cursor-pointer w-xl"
                    @click="submit"
                ></Button>
            </div>
        </form>
    </div>
</template>
