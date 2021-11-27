import Vue    from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import Home from './components/Home';

var router = new Router({
  routes: [
    {
      path: '/',
      name: '',
      component: Home
      // component: resolve => require(['./components/Home'], resolve)
      // component: ()=>import('./components/Home')
    }
  ]
});
export default router;
