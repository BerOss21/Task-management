import {
    createWebHistory,
    createRouter
} from 'vue-router';

import Home from '../views/Home.vue';
import Show from '../views/Show.vue';
import Create from '../views/Create.vue';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import Tokens from '../views/Tokens.vue';

const routes = [{
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/tasks/:id',
        name: 'detail',
        component: Show,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/tasks/create',
        name: 'create',
        component: Create,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/signin',
        name: 'login',
        component: Login,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/signup',
        name: 'register',
        component: Register,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/api',
        name: 'tokens',
        component: Tokens,
        meta: {
            requiresAuth: true
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('user');

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated) next({
            name: 'login'
        });
        else next();
    } else if (to.matched.some(record => record.meta.requiresGuest)) {
        if (isAuthenticated) next({
            name: 'home'
        });
        else next();
    } else next();
});

export default router;
