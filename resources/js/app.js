import '../css/app.css';

import { createApp, h } from 'vue';
import {createInertiaApp, Head, Link} from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'
import Layout from "@/Shared/Layout.vue";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `My App - ${title}`,
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        if(page.default.layout === undefined) {
            page.default.layout = page.default.layout || Layout
        }
        return page
    }
    ,
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Link', Link)
            .component('Head', Head)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: false,
});

// router.on('start', () => NProgress.start())
// router.on('finish', () => NProgress.done())
