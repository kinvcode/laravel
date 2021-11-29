import Vue     from 'vue'
import router  from './routers'
import {isDev} from "./utils/config"
import VueI18n from 'vue-i18n'

Vue.config.productionTip = isDev
Vue.use(VueI18n)

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
    data() {
        return {
            locale: 'en',
        }
    },
    methods: {
        changeLanguage(lang) {
            switch (lang) {
                case 'zh-CN':
                case 'zh-HK':
                case 'en':
                    this.$i18n.locale = lang
                    break;
                default:
                    this.$i18n.locale = 'en'
                    break;
            }
        },
    }
});
