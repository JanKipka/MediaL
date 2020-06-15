import axios from "axios";

export default {
    namespaced: true,
    state: {
        token: null,
        user: null
    },

    getters: {
        authenticated(state) {
            return state.token && state.user;
        },

        user(state) {
            return state.user;
        }
    },

    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;
        },
        SET_USER(state, user) {
            state.user = user;
        }
    },
    actions: {
        async signIn({dispatch}, credentials) {
            let response = await axios.post('/auth/signin', credentials);

            return dispatch('attempt', response.data.token);
        },

        async register({commit}, registerData) {
            let response = await axios.post('/auth/register', registerData);

            return 'success';
        },

        async attempt({commit, state}, token) {
            if (token) {
                commit('SET_TOKEN', token);
            }

            if (!state.token) {
                return;
            }

            try {
                let response = await axios.get('auth/user');

                commit('SET_USER', response.data.data);
            } catch (e) {
                commit('SET_USER', null);
                commit('SET_TOKEN', null);
            }
        }
    }
};
