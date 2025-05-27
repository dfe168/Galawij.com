<script setup>
defineProps({
    url: {
        type: String
    },
    text:{
        type: String
    },
    map:{
        type:String,
        default:null
    }


});

</script>

<template>
    <div>
        <li>
            <Link
                :href="route(url)"
                :class="{
                    active: $page.component === (map ? map + '/' + text : text),
                }"
                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0
                 md:hover:text-blue-700 md:p-0 "
                >{{ text }}</Link
            >
        </li>
    </div>
</template>

<style scoped>
@import url(https://fonts.googleapis.com/css?family=Raleway:400,500);
.snip1189 {
    font-family: "Raleway", Arial, sans-serif;
    text-align: center;
    text-transform: uppercase;
    font-weight: 500;
    letter-spacing: 1px;
}
.snip1189 * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition: all 0.35s ease;
    transition: all 0.35s ease;
}
.snip1189 li {
    display: inline-block;
    list-style: outside none none;
    margin: 0 1em;
    padding: 0;
}
.snip1189 a {
    padding: 0.5em 0.5em;
    margin: 0.2em 0;
    display: block;
    position: relative;
    text-decoration: none;
}
.snip1189 a:before,
.snip1189 a:after {
    height: 14px;
    width: 14px;
    position: absolute;
    content: "";
    -webkit-transition: all 0.35s ease;
    transition: all 0.35s ease;
    opacity: 0;
}
.snip1189 a:before {
    left: 0;
    top: 0;
    border-left: 3px solid gray;
    border-top: 3px solid gray;
    -webkit-transform: translate(100%, 50%);
    transform: translate(100%, 50%);
}
.snip1189 a:after {
    right: 0;
    bottom: 0;
    border-right: 3px solid gray;
    border-bottom: 3px solid gray;
    -webkit-transform: translate(-100%, -50%);
    transform: translate(-100%, -50%);
}
.snip1189 a:hover,
.snip1189 .current a {
    color: #c0392b;
}
.snip1189 a:hover:before,
.snip1189 .current a:before,
.snip1189 a:hover:after,
.snip1189 .current a:after {
    -webkit-transform: translate(0%, 0%);
    transform: translate(0%, 0%);
    opacity: 1;
}
.active {
    border-bottom: 3px solid gray;
    color: #c0392b;
}
</style>
