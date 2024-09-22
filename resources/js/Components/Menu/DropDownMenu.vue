<script setup>
    defineProps({
        menu: Object,
        toggleDropDownMenu: Function,
    });
</script>
<template>
    <li class="group text-gray-300 hover:text-white" :class="menu.isOpen ? 'text-white' : null">
        <div class="flex justify-between items-center cursor-pointer py-2 rounded-md hover:bg-[#ffffff33] px-2" :class="menu.isOpen ? 'bg-[#ffffff33]' : null" @click="toggleDropDownMenu(menu.name)">
            <!-- bg-[#78aaf03b] -->
            <div>
                <span class="pr-2 w-[60px]">
                    <FontAwesomeIcon :icon="['fas', menu.icon]" size="xl"/>
                </span>
                <span class="px-0">{{ menu.name }}</span>
            </div>
            <div>
                <FontAwesomeIcon :icon="['fas', menu.isOpen ? 'chevron-down' : 'chevron-left']" size="xs"  />
            </div>
        </div>
        <!-- Submenu (hidden by default) -->
        <ul id="submenu" class="pl-2 bg-[#8080800f] rounded space-y-1 py-1" :class="menu.isOpen ? 'block' : 'hidden'">
            <li v-for="submenu in menu.subMenus" :key="submenu.name" class="py-2 rounded-md cursor-pointer text-gray-300 hover:text-white hover:bg-[#ffffff33] px-2">
                <a :href="submenu.route">
                    <span class="pr-2">
                        <FontAwesomeIcon :icon="['fas', submenu.icon]" size="xl"/>
                    </span>
                    <span class="px-0">{{ submenu.name }}</span>
                </a>
            </li>
        </ul>
    </li>
</template>