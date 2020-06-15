import axios from "axios";

export default {
    namespaced: true,
    state: {
        token: null,
        user: null
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

            dispatch('attempt', response.data.token);
        },

        async attempt({ commit }, token) {
            commit('SET_TOKEN', token);

            try {
                let response = await axios.get('auth/user', {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                });

                commit('SET_USER', response.data.data);
            } catch(e) {
                commit('SET_USER', null);
                commit('SET_TOKEN', null);
            }
        }
    }
};
