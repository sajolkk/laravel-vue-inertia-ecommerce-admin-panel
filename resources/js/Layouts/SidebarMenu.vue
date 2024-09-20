<script setup>
    import Menu from '@/Components/Menu/Menu.vue';
    import DropDownMenu from '@/Components/Menu/DropDownMenu.vue';
    
    const menus = [
        {
            name: 'Dashboard',
            icon: 'home',
            isOpen: false,
            isSubMenu: false,
            subMenus: [],
            route: route('dashboard')
        },
        {
            name: 'Category',
            icon: 'columns',
            isOpen: false,
            isSubMenu: true,
            route: '',
            subMenus: [
                {
                    name: 'New Category',
                    icon: 'plus-circle',
                    route: route('dashboard')
                },
                {
                    name: 'Category List',
                    icon: 'clipboard-list',
                    route: route('dashboard')
                }
            ],
        },
        {
            name: 'Variation',
            icon: 'table',
            isOpen: false,
            isSubMenu: false,
            subMenus: [],
            route: '',
        },
        {
            name: 'Brand',
            icon: 'bold',
            isOpen: false,
            isSubMenu: true,
            route: '',
            subMenus: [
                {
                    name: 'New Brand',
                    icon: 'plus-circle',
                    route: route('dashboard')
                },
                {
                    name: 'Brand List',
                    icon: 'clipboard-list',
                    route: route('dashboard')
                }
            ],
        },
        {
            name: 'Product',
            icon: 'box',
            isOpen: false,
            isSubMenu: true,
            route: '',
            subMenus: [
                {
                    name: 'New Product',
                    icon: 'plus-circle',
                    route: route('dashboard')
                },
                {
                    name: 'Product List',
                    icon: 'clipboard-list',
                    route: route('dashboard')
                }
            ],
        },
        {
            name: 'Supplier',
            icon: 'truck',
            isOpen: false,
            isSubMenu: true,
            route: '',
            subMenus: [
                {
                    name: 'New Supplier',
                    icon: 'plus-circle',
                    route: route('dashboard')
                },
                {
                    name: 'Supplier List',
                    icon: 'clipboard-list',
                    route: route('dashboard')
                }
            ],
        },
        {
            name: 'Purchase',
            icon: 'shopping-bag',
            isOpen: false,
            isSubMenu: true,
            route: '',
            subMenus: [
                {
                    name: 'New Purchase',
                    icon: 'plus-circle',
                    route: route('dashboard')
                },
                {
                    name: 'Purchase List',
                    icon: 'clipboard-list',
                    route: route('dashboard')
                }
            ],
        },
        {
            name: 'Offer',
            icon: 'gift',
            isOpen: false,
            isSubMenu: true,
            route: '',
            subMenus: [
                {
                    name: 'New Offer',
                    icon: 'plus-circle',
                    route: route('dashboard')
                },
                {
                    name: 'Offer List',
                    icon: 'clipboard-list',
                    route: route('dashboard')
                }
            ],
        },
        {
            name: 'Order',
            icon: 'shopping-cart',
            isOpen: false,
            isSubMenu: true,
            route: '',
            subMenus: [
                {
                    name: 'Order Report',
                    icon: 'circle',
                    route: route('dashboard')
                }
            ],
        },
        {
            name: 'PC Builder Component',
            icon: 'laptop',
            isOpen: false,
            isSubMenu: true,
            route: '',
            subMenus: [
                {
                    name: 'New Component',
                    icon: 'plus-circle',
                    route: route('dashboard')
                },
                {
                    name: 'Component List',
                    icon: 'clipboard-list',
                    route: route('dashboard')
                }
            ],
        },
        {
            name: 'Setting',
            icon: 'wrench',
            isOpen: false,
            isSubMenu: true,
            route: '',
            subMenus: [
                {
                    name: 'Website Setting',
                    icon: 'cog',
                    route: route('dashboard')
                },
                {
                    name: 'Shipping Area',
                    icon: 'location-arrow',
                    route: route('dashboard')
                }
            ],
        },
    ];
</script>
<template>
    <div class="hidden md:block w-[300px] shadow-2xl h-screen dark:bg-gray-800 py-2 fixed top-0 left-0">
        <!-- Fixed Top Logo Section -->
        <div class="sticky top-0 bg-gray-800 z-10">
            <a href="" class="flex justify-center items-center cursor-pointer text-gray-300 hover:text-white pb-[10px] border-b-[1px] border-gray-600">
                <div>
                <img src="https://admin.sopmatech.com/assets/uploads/setting/logo/1705161862.jpeg" width="70" alt="">
                </div>
                <div class="pl-3 font-bold">
                Sopma Tech
                </div>
            </a>
        </div>
        <!-- Scrollable Menu Section -->
        <nav class="pt-1 mt-2 h-[calc(100vh-80px)] overflow-y-auto scrollbar px-2">
            <ul class="list-none space-y-1">
                <template v-for="menu in menus" :key="menu.name">
                    <template v-if="menu.isSubMenu">
                        <DropDownMenu :menu="menu" />
                    </template>

                    <template v-else>
                        <Menu :menu="menu" />
                    </template>
                </template>
            </ul>
        </nav>
    </div>
</template>