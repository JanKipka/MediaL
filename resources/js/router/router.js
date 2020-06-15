import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from "../views/Home";
import Register from "../views/Register";
import Login from "../views/Login";

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/add/:type',
            name: 'add',
        },
        {
            path: '/list/:type',
            name: 'list',
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        }
    ]
});

export default router
