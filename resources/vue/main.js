import Vue     from 'vue'
import router  from '@/router'
import {isDev} from "@/utils/config"
import VueI18n from 'vue-i18n'
import store from '@/store'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';


Vue.config.productionTip = isDev
Vue.use(VueI18n)
Vue.use(ElementUI);

// 在此处引入所有字体
require('@/assets/font/iconfont.css') // For form-wizard

// 多语言配置
const i18n = new VueI18n({
    locale: 'en',
    messages: {
        en: {}
    }
})


new Vue({
    el: '#app',
    i18n,
    router,
    store,
    methods: {
        changeLanguage(lang) {
            switch (lang) {
                case 'zh_CN':
                case 'zh_HK':
                case 'en':
                    this.$i18n.locale = lang
                    sessionStorage.setItem('locale', lang);
                    break;
                default:
                    this.$i18n.locale = 'en'
                    sessionStorage.setItem('locale', 'en');
                    break;
            }
        },
    },
});
