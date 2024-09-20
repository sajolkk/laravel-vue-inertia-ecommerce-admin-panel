<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import SidebarMenu from './SidebarMenu.vue';

const showingNavigationDropdown = ref(false);


</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex items-start">
            <!-- aside -->
            <SidebarMenu />

            <div class="w-full h-full md:ml-[300px]">
                <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center">
                                    <Link :href="route('dashboard')">
                                        <ApplicationLogo
                                            class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                        />
                                    </Link>
                                </div>

                                <!-- Navigation Links -->
                                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                    <NavLink :href="route('dashboard')" :active="true">
                                        <slot name="header" />
                                    </NavLink>
                                </div>
                            </div>

                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <!-- Settings Dropdown -->
                                <div class="ms-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    {{ $page.props.auth.user.name }}

                                                    <svg
                                                        class="ms-2 -me-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                            <!-- Hamburger -->
                            <div class="-me-2 flex items-center sm:hidden">
                                <button
                                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                                >
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path
                                            :class="{
                                                hidden: showingNavigationDropdown,
                                                'inline-flex': !showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{
                                                hidden: !showingNavigationDropdown,
                                                'inline-flex': showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div
                        :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                        class="sm:hidden"
                    >
                        <div class="pt-2 pb-3 space-y-1">
                            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </ResponsiveNavLink>
                        </div>

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Heading -->
                <header class="bg-white dark:bg-gray-800 shadow mt-1" v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <slot />
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quasi eos laudantium doloremque similique porro illum molestias incidunt rerum, fuga, illo quos repudiandae voluptatum, beatae fugiat rem non tenetur ex?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque neque voluptatum ex maiores blanditiis saepe, asperiores molestiae sapiente suscipit sit, aperiam ipsam labore deleniti enim earum. Provident suscipit error alias qui non distinctio et eveniet rerum inventore id aspernatur facilis delectus ut laboriosam asperiores mollitia cum assumenda nesciunt, officiis, nostrum ducimus consectetur tempora necessitatibus? Mollitia officiis similique iure placeat cumque tenetur, praesentium sit totam sint dolore voluptas quod nulla molestias quos velit deserunt voluptatum asperiores, pariatur odio nobis quasi. Autem iure hic sit, dolorum id quis explicabo ullam velit sint beatae tenetur dicta, enim tempore quasi. Officia fugiat id blanditiis suscipit fuga odio cumque, iusto beatae culpa consectetur reiciendis asperiores minus ab, veniam quidem ipsum nobis sunt praesentium deserunt commodi illo perferendis doloremque consequuntur? Non dignissimos ipsa dolore tempora quod aspernatur quis perferendis officiis necessitatibus facilis, eos pariatur in ab suscipit consequatur quia eligendi provident illo esse. Vel iure ut, deleniti impedit omnis porro voluptatibus, soluta id similique in ab ducimus praesentium cumque eos dicta repellendus molestiae mollitia eaque fuga harum veniam consequuntur pariatur nihil? Molestias magnam reiciendis esse nostrum, tempora pariatur repellat? Ipsa, dolore unde voluptatum, quibusdam blanditiis magni pariatur vero maiores iusto eaque labore qui fugit corrupti quaerat sequi nemo voluptates tempore est molestias adipisci incidunt! Rem, cupiditate deleniti mollitia officia exercitationem sed cum asperiores consequuntur officiis! Veritatis assumenda impedit, unde corporis quasi nihil. Reprehenderit pariatur suscipit temporibus a architecto molestias voluptas consectetur? Optio dolores suscipit architecto inventore labore expedita cupiditate cum beatae natus minus amet explicabo repellat voluptates eveniet porro molestias modi nihil quisquam ipsam recusandae, debitis numquam accusamus! Hic molestias tempore similique ex eaque suscipit reprehenderit magni, voluptatibus ea iste incidunt odio in fugiat dolorem molestiae explicabo. Incidunt illum aliquid dolorum, deleniti magni ratione expedita corrupti nesciunt odio ducimus quam adipisci laboriosam, soluta cum quod quibusdam illo mollitia doloribus aspernatur accusantium voluptas architecto, officiis amet obcaecati? Corrupti temporibus amet distinctio id sequi facere repellat eum eveniet autem non sed, ab beatae quasi maxime, veritatis consequuntur iusto doloremque eos suscipit eligendi voluptas at fugit. Illo, ipsa, reprehenderit dolores quam necessitatibus a tempora quos dolorum porro commodi doloribus nesciunt. Pariatur autem repellendus alias neque expedita quasi laboriosam nulla? Tempora explicabo nesciunt mollitia nisi eum. Cupiditate officiis, maxime velit qui quibusdam labore optio pariatur alias ullam perferendis ipsum vitae. Facere molestias voluptates nisi nam laborum dolores harum sed nostrum sapiente mollitia illum quos molestiae provident fugit explicabo voluptas rerum autem, amet esse qui consectetur recusandae est temporibus. Omnis provident nihil at eaque esse repellendus natus fugit porro odio ea hic veniam voluptas illo quod sunt sed quisquam, alias sint vero earum iste est id? Eum reiciendis aperiam odit saepe? Atque nam molestiae, illum cumque soluta deleniti, alias animi enim quidem maxime excepturi dignissimos velit itaque obcaecati nisi blanditiis odio vero quam exercitationem eos et minima quasi aliquid voluptates. Dicta deleniti accusamus id consequuntur odio quos officia corporis doloremque, asperiores eius delectus doloribus iste aliquid praesentium eum, animi veritatis explicabo? Deserunt quia sed corrupti perferendis veniam perspiciatis reprehenderit rem possimus sunt dolores adipisci animi id tempora vel iure a nulla doloremque aperiam sequi repudiandae, doloribus error unde. Sed id veniam consectetur odit consequuntur quaerat voluptatibus tempore mollitia dolores, repellat, iste inventore debitis, quidem itaque ipsum. Nesciunt modi ad praesentium consequatur eius, quod dolorum accusamus. Dicta vel at alias vero rem voluptatibus. A similique soluta esse nulla velit consequatur laudantium laborum eaque alias. A dicta autem quo nam, ratione quam nesciunt. Quae officiis modi blanditiis eius. Cum laborum in rem exercitationem laudantium? Eius consectetur nemo aliquid dolorem quis. Porro blanditiis iste consectetur rem voluptas facilis obcaecati adipisci dicta, at veritatis, tempore sed laborum fuga! Tempora non asperiores omnis? Sed qui harum quisquam ad magnam ab ratione blanditiis maxime distinctio iusto. Corrupti, explicabo? Ducimus expedita temporibus dolorem doloribus deleniti, reiciendis quos est natus consequatur fugit voluptate sint ipsa nemo quam iste nihil, quas quae veritatis? Laborum accusamus error eius blanditiis, ea temporibus sint at dolore! Quis cupiditate ipsum eaque impedit doloremque reiciendis odit architecto facere ipsam tempore natus vel dolor ratione ea placeat consectetur, totam earum recusandae deleniti voluptatum? Quidem aliquid repellat sint enim sed aspernatur consequatur? Doloremque inventore in delectus repellat praesentium enim unde ratione illum officia animi. Possimus debitis, voluptate asperiores ratione impedit commodi, aperiam minus excepturi perspiciatis consectetur fugiat quod natus nulla at ipsum dolorem molestiae. Tenetur explicabo fugit fuga sint assumenda aliquam consequuntur ut voluptas provident reiciendis accusantium id, dolorem earum rerum architecto accusamus. Quidem laborum eius minima, culpa dicta perferendis modi incidunt, pariatur ipsa labore cum necessitatibus tempora magnam est. Illum, sequi odio. Doloribus ad labore vel. Corrupti adipisci eveniet totam laborum ex magni aperiam laudantium at iste culpa dolorum voluptate quas nemo rem sint ut, cum deserunt aspernatur officia assumenda nihil. Dolore doloremque, eligendi sequi nulla natus rem. Assumenda quaerat sit laboriosam dolore praesentium obcaecati totam ipsam voluptatum nostrum non ducimus omnis illo quia odit repudiandae, deleniti natus soluta dicta nemo ab ipsa! Quod perferendis atque, dolor alias et corporis eligendi praesentium vel voluptatibus temporibus. Nostrum accusamus qui at quos omnis aliquid blanditiis excepturi quia ad voluptatum laudantium itaque ipsa inventore, vero molestias magnam id tempore, explicabo provident quidem, in sequi velit quas! Nisi nihil mollitia sunt ab sit est repellat quod a aliquam tenetur sapiente id, quas ducimus similique pariatur facilis, quidem sequi, sint rem quos ea distinctio necessitatibus commodi eum. Ipsum, incidunt voluptate. Reiciendis eaque laudantium laboriosam asperiores praesentium amet error, vero molestias quaerat explicabo quibusdam, ducimus, inventore reprehenderit soluta natus minus ad voluptate temporibus. Voluptatem corrupti mollitia cumque? Ex sunt modi voluptas, ut eius deleniti? Voluptate vitae voluptatum distinctio ipsa ea hic soluta earum, doloremque atque eos aliquam ab adipisci aspernatur cupiditate repellendus laborum. Illum officia assumenda consequuntur quia ad quam neque aspernatur aliquam praesentium, ab, earum, tenetur labore sunt? Recusandae expedita, architecto ratione tenetur excepturi ullam nam, odit id eaque vitae iste ad! Magnam, assumenda. Optio hic quaerat fugiat at, vel ut voluptatibus distinctio magnam recusandae quo praesentium, accusamus tenetur repellat assumenda, commodi architecto eligendi enim quis. Aut quos corrupti quam laudantium.
                </main>
            </div>
        </div>
    </div>
</template>

