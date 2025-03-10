import "./bootstrap";
import "../css/app.css";

import { createApp, h, DefineComponent } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist";
import { MotionPlugin } from "@vueuse/motion";
import PhosphorIcons from "@phosphor-icons/vue";
import Toast from "vue-toastification";
import VueViewer from "v-viewer";
import "viewerjs/dist/viewer.css";
import { createHead } from "@vueuse/head";
import { VueCookieNext } from "vue-cookie-next";


const appName = import.meta.env.VITE_APP_NAME || "COUP";
const head = createHead();

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>("./Pages/**/*.vue"),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(MotionPlugin)
            .use(PhosphorIcons)
            .use(Toast)
            .use(VueViewer)
            .use(head)
            .use(VueCookieNext)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
})
    .then(() => {
        console.log("COUP app initialized successfully.");
    })
    .catch((error) => {
        console.error("Failed to initialize COUP app:", error);
    });
