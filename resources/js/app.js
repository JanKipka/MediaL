/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import axios from 'axios';

Vue.component('navigation-component', require('./components/NavigationComponent').default);
Vue.component('card-component', require('./components/CardComponent').default);
Vue.component('list-table-component', require('./components/ListTableComponent').default);
Vue.component('add-book-form-component', require('./components/AddBookFormComponent').default);
Vue.component('query-books-component', require('./components/QueryBooksComponent').default);
Vue.component('add-book-button-component', require('./components/AddBookButtonComponent').default);
Vue.component('select-component', require('./components/SelectComponent').default);
Vue.component('book-card-component', require('./components/BookCardComponent').default);

import App from "./views/App";
import router from "./router/router";
import store from "./store/index";
import './filters/filters.js';
import './store/subscriber.js';

window.Vue = Vue;

axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`;

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
    const app = new Vue({
        router,
        store,
        el: '#app',
        components: {App},
    });
});
