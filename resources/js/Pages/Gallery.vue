<script setup>
import { ref } from "vue";
import PaginationLinks from "../components/PaginationLinks.vue";

defineProps({ paintings: Object });

const showModal = ref(false);
const currentImage = ref(null);

function openModal(image) {
    currentImage.value = image;
    showModal.value = true;
    document.addEventListener("keydown", handleEscape);
}

function closeModal() {
    showModal.value = false;
    currentImage.value = null;
    document.removeEventListener("keydown", handleEscape);
}

function handleEscape(event) {
    if (event.key === "Escape") {
        closeModal();
    }
}
</script>

<template>
    <Head title="| Gallery" />
    <div>
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-5 m-5"
        >
            <div
                v-for="painting in paintings.data"
                :key="painting.id"
                @click="openModal('storage/paintings/' + painting.img)"
                class="aspect-square overflow-hidden"
            >
                <div
                    class="text-center font-bold first-letter:uppercase text-amber-700"
                >
                    {{ painting.name }}
                </div>
                <img
                    class="h-3/4 w-full object-cover rounded-lg py-1"
                    :src="'storage/paintings/' + painting.img"
                    alt=""
                />
                <div class="flex justify-between px-7">
                    <small><b>Medium: </b>{{ painting.medium }}</small>
                    <small
                        ><b>Size: </b>{{ painting.length }}X{{
                            painting.width
                        }}
                        (cm)</small
                    >
                </div>
            </div>
        </div>

        <PaginationLinks class="mb-5" :paginator="paintings.links" />

        <div
            v-if="showModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            @click.self="closeModal"
        >
            <div class="bg-white p-6 rounded-lg relative max-w-4xl w-full">
                <button
                    @click="closeModal"
                    class="absolute top-0 right-2 text-black text-lg font-bold"
                >
                    Close
                </button>
                <img
                    class="h-auto max-h-[80vh] max-w-full rounded-lg mx-auto"
                    :src="currentImage"
                    alt=""
                />
            </div>
        </div>
    </div>
</template>
