import Vue    from 'vue'
import Router from 'vue-router'
import Home from './pages/Home'; // 【重要】不可删除
Vue.use(Router)

let router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: () => import('./pages/Home.vue')
        },
        {
            path: '/home/user',
            component: () => import('./pages/User.vue')
        },
        {
            path: '/home',
            redirect: '/',
        },
        {
            path: '/home/*',
            redirect: '/',
        },
    ]
});
export default router;
