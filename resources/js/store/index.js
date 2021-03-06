import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import auth from "./auth";
import media from "./media";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
    },
    mutations: {},
    actions: {

    },
    modules: {
        auth,
        media
    }
});
