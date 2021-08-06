require('./bootstrap');

// Import modules...
import {createApp, h} from 'vue';
import {createI18n} from 'vue-i18n'
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import store from "@/Store/index"

const el = document.getElementById('app');

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({el, app, props, plugin}) {
        // 设置语言
        const localLang = localStorage.getItem('lang');
        const locale = localLang ?? props.initialPage.props.locale;
        const fallbackLocale = props.initialPage.props.fallbackLocale;
        const messages = props.initialPage.props.languages;
        const i18n = createI18n({
            locale: locale, // 默认当前语言环境
            fallbackLocale: fallbackLocale, // 第二默认语言环境
            messages, // 语言包
        });

        const App = createApp({
            render: () => h(app, props)
        });
        App.mixin({methods: {route: window.route}});
        App.use(plugin);
        App.use(i18n);
        App.use(store);
        App.mount(el);
    },
});

InertiaProgress.init({color: '#4B5563'});
