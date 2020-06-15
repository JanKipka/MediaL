import axios from "axios";

export default {
    namespaced: true,
    mutations: {
        SET_BOOKS(state, books) {
            state.books = books;
        },

        SET_MOVIES(state, movies) {
            state.movies = movies;
        },

        SET_GENRES(state, genres) {
            state.genres = genres;
        },

        SET_FORMATS(state, formats) {
            state.formats = formats;
        },

        SET_AUTHORS(state, authors) {
            state.authors = authors;
        },

        SET_DIRECTORS(state, directors) {
            state.directors = directors;
        },

        ADD_BOOK(state, book) {
            state.books.push(book);
        },

        ADD_MOVIE(state, movie) {
            state.movies.push(movie);
        }
    },
    getters: {
        books(state) {
            return state.books;
        },
        movies(state) {
            return state.movies;
        },
        genres(state) {
            return state.genres;
        },
        formats(state) {
            return state.formats;
        },
        artists: (state) => (type) => {
            if (type === 'book') {
                return state.authors;
            } else {
                return state.directors;
            }
        }
    },
    state: {
        books: null,
        movies: null,
        genres: null,
        formats: null,
        authors: null,
        directors: null
    },
    actions: {
        async initMedia({commit, state}) {
            if (state.books === null && state.movies === null) {
                let response = await axios.get('/media/all');
                if (response.data.books.length > 0) {
                    commit('SET_BOOKS', response.data.books);
                } else {
                    commit('SET_BOOKS', []);
                }

                if (response.data.movies.length > 0) {
                    commit('SET_MOVIES', response.data.movies);
                } else {
                    commit('SET_MOVIES', []);
                }
            }
        },

        async refreshMedia({commit, state}) {
            let response = await axios.get('/media/all');
            if (response.data.books.length > 0) {
                commit('SET_BOOKS', response.data.books);
            } else {
                commit('SET_BOOKS', []);
            }

            if (response.data.movies.length > 0) {
                commit('SET_MOVIES', response.data.movies);
            } else {
                commit('SET_MOVIES', []);
            }

            // reset these states so they have to be
            // pulled in freshly again
            commit('SET_AUTHORS', null);
            commit('SET_DIRECTORS', null);
        },

        async fetchMeta({commit, state}) {
            if (state.genres === null && state.formats === null) {
                let response = await axios.get('media/meta/all');
                commit('SET_GENRES', response.data.genres);
                commit('SET_FORMATS', response.data.formats);
            }
        },

        async fetchArtist({commit, state}, type) {
            let typeString = type + 's';
            if (state[typeString] === null) {
                let response = await axios.get('media/meta/' + typeString)
                if (type === 'author') {
                    if (response.data.artists.length > 0) {
                        commit('SET_AUTHORS', response.data.artists)
                    } else {
                        commit('SET_AUTHORS', []);
                    }
                } else {
                    if (response.data.artists.length > 0) {
                        commit('SET_DIRECTORS', response.data.artists)
                    } else {
                        commit('SET_DIRECTORS', [])
                    }
                }
            }
        },

        async addMedia({dispatch, state}, payload) {
            let media = payload.media;
            let type = payload.type;
            try {
                let response = await axios.post('/media/add/' + type, {
                    media: media
                });
                return dispatch('refreshMedia');
            } catch (e) {
                console.log('error');
            }
        }
    }
}
