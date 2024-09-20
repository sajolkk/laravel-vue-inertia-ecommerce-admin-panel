import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
// Import only the icons you need
import { faUser, faHome, faColumns, faClipboard, faTable, faBold, faPlusCircle, faClipboardList, faBox, faTruck, faShoppingBag, faGift, faShoppingCart, faCircle, faLaptop, faWrench, faCog, faLocationArrow, faChevronRight, faChevronLeft, faChevronDown } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fab } from '@fortawesome/free-brands-svg-icons';

// Add icons to the library (local to this component)
library.add(faUser, faHome, faColumns, faClipboard, faTable, faBold, faPlusCircle, faClipboardList, faBox, faTruck, faShoppingBag, faGift, faShoppingCart, faCircle, faLaptop, faWrench, faCog, faLocationArrow, faChevronRight, faChevronLeft, faChevronDown);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('FontAwesomeIcon', FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
