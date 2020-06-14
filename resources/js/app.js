/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('navigation-component', require('./components/NavigationComponent').default);
Vue.component('card-component', require('./components/CardComponent').default);
Vue.component('list-table-component', require('./components/ListTableComponent').default);
Vue.component('add-book-form-component', require('./components/AddBookFormComponent').default);
Vue.component('query-books-component', require('./components/QueryBooksComponent').default);
Vue.component('add-book-button-component', require('./components/AddBookButtonComponent').default);
Vue.component('select-component', require('./components/SelectComponent').default);
Vue.component('book-card-component', require('./components/BookCardComponent').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.filter('authors', function (authorArray) {
    if (authorArray) {
        let authors = authorArray.length;
        if (authors === 0) {
            return '';
        }
        let authorString = authorArray[0];
        if (authors === 1) {
            if (authorString.fullName) {
                authorString = authorString.fullName;
            }
            return authorString;
        }

        for (let i = 0; i < authors; i++) {
            let appendix = authorArray[i];
            if (appendix.fullName) {
                appendix = appendix.fullName;
            }
            authorString = authorString + ', ' + appendix;
        }
        return authorString;
    }

    return '';
});

Vue.filter('isbn', function (industryIdentifiers) {
    if (industryIdentifiers) {
        for (let i = 0; i < industryIdentifiers.length; i++) {
            let id = industryIdentifiers[i];
            if (id.type === 'ISBN_10') {
                return id.identifier;
            }

            // fallback: return isbn-13
            return id.identifier;
        }
    }
    return '';
});

Vue.filter('date', function (date) {
    try {
        let parsedDate = new Date(date);
        return parsedDate.getFullYear();
    } catch (exception) {
        return date;
    }
})

const app = new Vue({
    el: '#app',
});
