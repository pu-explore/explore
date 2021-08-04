require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { createI18n } from 'vue-i18n'
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import store from "@/Store/index"
import helper from "@/helper";

const el = document.getElementById('app');

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        const localLang = localStorage.getItem('lang');

        const locale = localLang ? localLang : props.initialPage.props.locale;

        const fallbackLocale = props.initialPage.props.fallbackLocale;

        const messages = props.initialPage.props.lang;

        const i18n = createI18n({
            locale: localLang, // 默认当前语言环境
            fallbackLocale: fallbackLocale, // 第二默认语言环境
            messages, // 语言包
        });

        createApp({
            render: () => h(app, props),
        })
            .mixin({ methods: { route: window.route } })
            .use(plugin)
            .use(i18n)
            .use(store)
            .use(helper)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
