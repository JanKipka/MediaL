import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from "../views/Home";
import Register from "../views/Register";
import Login from "../views/Login";
import store from "../store/index";
import Add from "../views/Add";
import List from "../views/List";
import Author from "../views/Author";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/add/:type',
            name: 'add',
            component: Add,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/list/:type',
            name: 'list',
            component: List,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                guest: true
            },
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                guest: true
            },
        },
        {
            path: '/author/:id',
            name: 'author',
            component: Author,
            meta: {
                requiresAuth: true
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('token') === null) {
            next({
                name: 'login'
            })
        }
        next()
    } else if(to.matched.some(record => record.meta.guest)) {
        if(localStorage.getItem('token') === null){
            next()
        }
        else{
            next({ name: 'home'})
        }
    } else {
        next()
    }
});

export default router
