import Vue     from 'vue'
import router  from './routers'
import {isDev} from "./utils/config"

Vue.config.productionTip = isDev

new Vue({
  el: '#app',
  // i18n,
  router
});
