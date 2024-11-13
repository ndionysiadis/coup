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

const appName = import.meta.env.VITE_APP_NAME || "Laravel";
const head = createHead();

const googleAnalyticsId = (window as any).appConfig?.googleAnalyticsId;

if (googleAnalyticsId) {
    const script = document.createElement("script");
    script.src = `https://www.googletagmanager.com/gtag/js?id=${googleAnalyticsId}`;
    script.async = true;
    document.head.appendChild(script);

    script.onload = () => {
        (window as any).dataLayer = (window as any).dataLayer || [];
        function gtag(...args: any[]) {
            (window as any).dataLayer.push(args);
        }
        gtag("js", new Date());
        gtag("config", googleAnalyticsId);
    };
}

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
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
