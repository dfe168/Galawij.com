<script setup></script>

<template>
    <Head title="| Home" />
    <div>
        <div
            class="title pt-4 animate__animated animate__pulse animate__infinite"
        >
            <h1 class="h1-text">Galawij<br />Gallery</h1>
        </div>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <div class="p-4 md:w-1/3 animate__backInLeft">
                        <div
                            class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"
                        >
                            <img
                                class="lg:h-48 md:h-36 w-full object-cover object-center"
                                :src="'storage/img/IMG-2529cefa01c69b132e2a63777287a3d8-V.jpg'"
                                alt="blog"
                            />
                            <div class="p-6">
                                <h1
                                    class="title-font text-lg font-medium text-gray-900 dark:text-gray-100 mb-3"
                                >
                                    Meditation
                                </h1>
                                <p class="leading-relaxed mb-3">
                                    I find relief in painting. When I paint, I
                                    become so immersed that I forget about the
                                    world around me. It’s just me, my canvas,
                                    and the colors.
                                </p>
                                <div class="flex items-center flex-wrap">
                                    <!-- <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                  <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                  </svg>
                </a> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 md:w-1/3">
                        <div
                            class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"
                        >
                            <img
                                class="lg:h-48 md:h-36 w-full object-cover object-center"
                                :src="'storage/img/IMG-7b24e1443bc581ba7db1d08db3ba3ed3-V.jpg'"
                                alt="blog"
                            />
                            <div class="p-6">
                                <h1
                                    class="title-font text-lg font-medium text-gray-900 mb-3 dark:text-gray-100"
                                >
                                    Self-exploring
                                </h1>
                                <p class="leading-relaxed mb-3">
                                    Art is a fantastic form of expression. I
                                    believe it’s one of the best ways for
                                    self-exploration and self-discovery.
                                </p>
                                <div class="flex items-center flex-wrap"></div>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 md:w-1/3 animate__backInLeft">
                        <div
                            class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"
                        >
                            <img
                                class="lg:h-48 md:h-36 w-full object-cover object-center"
                                :src="'storage/img/54685545.jpg'"
                                alt="blog"
                            />
                            <div class="p-6">
                                <h1
                                    class="title-font text-lg font-medium text-gray-900 dark:text-gray-100 mb-3"
                                >
                                    Self-expression
                                </h1>
                                <p class="leading-relaxed mb-3">
                                    The satisfaction I find in creating art
                                    stems from having the opportunity to convey
                                    my feelings through drawings.
                                </p>
                                <div class="flex items-center flex-wrap"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css?family=Montserrat");
body {
    background-color: #111;
}

.title {
    font-family: "Montserrat";
    text-align: center;
    color: #fff;
    align-items: center;
    justify-content: center;
    letter-spacing: 1px;
}

.h1-text {
    background-image: url("/storage/img/giphy.webp");
    background-size: cover;
    color: transparent;
    -moz-background-clip: text;
    -webkit-background-clip: text;
    text-transform: uppercase;
    font-size: 10vw;
    line-height: 0.75;
    margin: 10px 0;
}
/* styling my button */

.white-mode {
    text-decoration: none;
    padding: 7px 10px;
    background-color: #122;
    border-radius: 3px;
    color: #fff;
    transition: 0.35s ease-in-out;
    position: absolute;
    left: 15px;
    bottom: 15px;
    font-family: "Montserrat";
}

.white-mode:hover {
    background-color: #fff;
    color: #122;
}
</style>
