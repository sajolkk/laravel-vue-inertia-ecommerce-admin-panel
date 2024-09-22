<script setup>
    import { ref } from 'vue';
    defineProps({
        menu: Object()
    });
    
</script>
<template>
    <li class="py-2 rounded-md cursor-pointer text-gray-300 hover:text-white hover:bg-[#ffffff33] px-2" >
        <a :href="menu.route">
            <span class="pr-2">
                <FontAwesomeIcon :icon="['fas', menu.icon]" size="xl"/>
            </span>
            <span>{{ menu.name }}</span>
        </a>
    </li>
</template>