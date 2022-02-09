import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Home'; // 【重要】不可删除
Vue.use(Router)

const routerView = {
    template: '<router-view></router-view>'
};

let router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('./pages/Home.vue')
        },
        {
            path: '/home',
            redirect: '/',
            component: routerView,
            children: [
                {
                    path: 'user',
                    name: 'home.user',
                    component: () => import('./pages/User.vue')
                },
            ]
        },
        {
            path: '/home/*',
            redirect: '/',
        },
        {
            path: '/admin',
            name: 'admin',
            redirect: '/admin/dashboard',
            component: routerView,
            children: [
                {
                    path: 'dashboard',
                    name: 'admin.dashboard',
                    component: () => import('./pages/admin/Index.vue')
                }
            ]
        },
    ]
});

router.beforeEach((to, from, next) => {
    console.log(to);
    console.log(from);
    next();
})

export default router;
