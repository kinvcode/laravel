import Vue from 'vue'
import Router from 'vue-router'
import { canNavigate } from '@/libs/acl/routeProtection'


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
            component: () => import('@/pages/Home.vue')
        },
        {
            path: '/home',
            redirect: '/',
            component: routerView,
            children: [
                {
                    path: 'user',
                    name: 'home.user',
                    component: () => import('@/pages/User.vue')
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
                    component: () => import('@/pages/admin/Index.vue')
                }
            ]
        },
    ]
});

router.beforeEach((to, from, next) => {
    console.log(canNavigate(to));
    next();
})

export default router;
