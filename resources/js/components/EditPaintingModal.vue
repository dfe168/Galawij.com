<script setup>
import Modal from "./Modal.vue";
import { router, useForm } from "@inertiajs/vue3";
import { watch } from "vue";
import TextInput from "./TextInput.vue";
import Button from "./Button.vue";
import ImageUpload from "./ImageUpload.vue";

const props = defineProps({
    show: Boolean,
    painting: Object,
});

const emit = defineEmits(["close"]);

const form = useForm({
    id: null,
    name: "",
    medium: "",
    width: "",
    length: "",
    img: null,
});

watch(
    () => props.painting,
    (newVal) => {
        if (newVal) {
            form.id = newVal.id;
            form.name = newVal.name;
            form.medium = newVal.medium;
            form.width = newVal.width;
            form.length = newVal.length;
            form.img = null;
        }
    },
    { immediate: true }
);

function close() {
    emit("close");
}

function submit() {
    form.post(route("painting.update", form.id), {
        onSuccess: () => {
            router.visit(route("dashboard.home"));
            close();
        },
    });
}
</script>

<template>
    <Modal :show="show" @close="close">
        <h2 class="text-lg font-bold mb-4">Edit Painting</h2>
        <div class="w=2/4 mx-auto">
            <form class="max-w-md mx-auto mt-5 p-5" @submit.prevent="submit">
                <ImageUpload
                    v-model="form.img"
                    :max-size-m-b="2"
                    class="mb-5"
                />
                <div class="relative z-0 w-full mb-5 group">
                    <TextInput
                        name="Painting Name:"
                        type="text"
                        v-model="form.name"
                    />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <TextInput
                        name="Medium:"
                        type="text"
                        v-model="form.medium"
                    />
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
                <div class="flex justify-end space-x-2">
                    <Button text="Close" @click="close" />
                    <Button text="Update" type="submit" />
                </div>
            </form>
        </div>
    </Modal>
</template>
