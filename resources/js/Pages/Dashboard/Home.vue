<script setup>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import { usePage, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import EditPaintingModal from "../../components/EditPaintingModal.vue";
import { debounce } from "lodash";

//UsePage gebruiken omdat bij rendering pagina is ook gebruikt
const page = usePage();

defineOptions({
    layout: DashboardLayout,
});

const paintings = page.props.paintings;

const search = ref(page.props.searchTerm);

watch(
    search,
    debounce(
        (q) =>
            router.get(
                route("dashboard.home"),
                { search: q },
                { preserveState: false }
            ),
        500
    )
);

const isModalOpen = ref(false);
const selectedPainting = ref(null);

function openEditModal(painting) {
    selectedPainting.value = painting;
    isModalOpen.value = true;
}

function deletePainting(painting) {
    //router.delete(`/paintings/${painting.id}`, {
    router.delete(route("painting.delete", painting.id), {
        onBefore: () =>
            confirm("Are you sure you want to delete this painting?"),
        onSuccess: () => {
            router.visit(route("dashboard.home"));
        },
    });
}

function closeEditModal() {
    isModalOpen.value = false;
    selectedPainting.value = null;
}
</script>

<template>
    <Head title="| Dashboard" />
    <article>
        <div v-if="$page.props.flash.message" class="alert">
            {{ $page.props.flash.message }}
        </div>
    </article>
    <div
        class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border"
    >
        <div
            class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border"
        >
            <div class="flex items-center justify-between gap-8 mb-8">
                <div>
                    <h5
                        class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900"
                    >
                        Painting list
                    </h5>
                    <p
                        class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700"
                    >
                        See information about all paintings
                    </p>
                </div>
                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                    <a
                        class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        :href="route('dashboard.add')"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            aria-hidden="true"
                            stroke-width="2"
                            class="w-4 h-4"
                        >
                            <path
                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
                            ></path>
                        </svg>
                        Add Paintings
                    </a>
                </div>
            </div>
            <div
                class="flex flex-col items-center justify-between gap-4 md:flex-row"
            >
                <div class="block w-full overflow-hidden md:w-max"></div>
                <div class="w-full md:w-72">
                    <div class="relative h-10 w-full min-w-[200px]">
                        <div
                            class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                aria-hidden="true"
                                class="w-5 h-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                                ></path>
                            </svg>
                        </div>
                        <input
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" "
                            type="search"
                            v-model="search"
                        />
                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"
                        >
                            Search painting name
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6 px-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 text-center transition-colors border-y">
                            Id
                        </th>
                        <th class="p-4 text-center transition-colors border-y">
                            Painting
                        </th>
                        <th class="p-4 text-center transition-colors border-y">
                            Name
                        </th>
                        <th class="p-4 text-center transition-colors border-y">
                            Medium
                        </th>
                        <th class="p-4 text-center transition-colors border-y">
                            Size (With x Length)
                        </th>
                        <th class="p-4 text-center transition-colors border-y">
                            Owner
                        </th>
                        <th class="p-4 text-center transition-colors border-y">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody v-for="painting in paintings.data" :key="painting.id">
                    <tr>
                        <td class="p-2 border-b border-blue-gray-50">
                            {{ painting.id }}
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            <img
                                :src="'/storage/paintings/' + painting.img"
                                alt="painting"
                                class="relative inline-block h-10 w-10 !rounded-full object-cover object-center"
                            />
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            {{ painting.name }}
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            {{ painting.medium }}
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            {{ painting.width }} X {{ painting.length }}
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            {{ painting.user.name }}
                        </td>
                        <td class="p-4 border-b border-blue-gray-50">
                            <button
                                class="cursor-pointer"
                                @click="openEditModal(painting)"
                            >
                                🖋️ Edit
                            </button>
                            |
                            <button
                                class="cursor-pointer"
                                @click="deletePainting(painting)"
                            >
                                ❌ Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div
            class="flex items-center justify-between p-4 border-t border-blue-gray-50"
        >
            <p
                class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900"
            >
                Page {{ paintings.current_page }} of {{ paintings.last_page }}
            </p>
            <div class="flex gap-2">
                <a
                    class="rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button"
                    :href="paintings.prev_page_url"
                >
                    Previous
                </a>
                <a
                    class="rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button"
                    :href="paintings.next_page_url"
                >
                    Next
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Modal  -->
    <EditPaintingModal
        :show="isModalOpen"
        :painting="selectedPainting"
        @close="closeEditModal"
    />
</template>
