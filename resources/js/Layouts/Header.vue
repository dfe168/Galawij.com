<script setup>
import NavItem from "../components/NavItem.vue";
</script>

<template>
    <header>
        <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5">
            <div
                class="container flex flex-wrap justify-between items-center mx-auto"
            >
                <!-- logo -->
                <Link :href="route('home')" class="flex items-center">
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M12 14l9-5-9-5-9 5z"></path>
                        <path
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                        ></path>
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 14l9-5-9-5-9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                        ></path>
                    </svg>
                    <span
                        class="self-center text-xl font-semibold whitespace-nowrap"
                        ><h1>Galawij Gallery</h1></span
                    >
                </Link>

                <!-- Mobile burger -->
                <button
                    data-collapse-toggle="mobile-menu"
                    type="button"
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="mobile-menu-2"
                    aria-expanded="false"
                >
                    <span class="sr-only">Open main menu</span>
                    <svg
                        class="w-6 h-6"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <svg
                        class="hidden w-6 h-6"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>

                <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
                    <ul
                        class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium snip1189"
                    >
                        <NavItem url="home" text="Home" />
                        <NavItem url="about" text="About" />
                        <NavItem url="gallery" text="Gallery" />
                        <NavItem url="contact" text="Contact" />

                        <NavItem
                            v-if="$page.props.auth.user"
                            url="dashboard.home"
                            text="Dashboard"
                            map="Dashboard"
                        />
                        <NavItem
                            v-if="$page.props.auth.user"
                            url="logout"
                            text="Logout"
                        />
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>
<script>
import { Link } from "@inertiajs/vue3";

export default {
    mounted() {
        const toggleButton = document.querySelector(
            '[data-collapse-toggle="mobile-menu"]'
        );
        const mobileMenu = document.getElementById("mobile-menu");
        const menuLinks = mobileMenu ? mobileMenu.querySelectorAll("a") : [];

        if (toggleButton && mobileMenu) {
            toggleButton.addEventListener("click", () => {
                const isExpanded =
                    toggleButton.getAttribute("aria-expanded") === "true";
                toggleButton.setAttribute("aria-expanded", !isExpanded);
                mobileMenu.classList.toggle("hidden");
            });

            menuLinks.forEach((link) => {
                link.addEventListener("click", () => {
                    toggleButton.setAttribute("aria-expanded", false);
                    mobileMenu.classList.add("hidden");
                });
            });
        }
    },
};
</script>

<style scoped>
@import url(https://fonts.googleapis.com/css?family=Raleway:400,500);
.snip1189 {
    font-family: "Raleway", Arial, sans-serif;
    text-align: center;
    text-transform: uppercase;
    font-weight: 500;
    letter-spacing: 1px;
}
</style>
