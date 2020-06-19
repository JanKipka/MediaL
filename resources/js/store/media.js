import axios from "axios";
import auth from "./auth";

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

        UPDATE_AUTHOR(state, newAuthor) {
            if (state.authors !== null) {
                state.authors.filter(author => function () {
                    if (author.id === newAuthor.id) {
                        author = newAuthor;
                    }
                });
            }
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
        bookFormats(state) {
            return state.formats.filter(format => format.mediaFormat === 1);
        },
        movieFormats(state) {
            return state.formats.filter(format => format.mediaFormat === 2);
        },
        artists: (state) => (type) => {
            if (type === 'book') {
                return state.authors;
            } else {
                return state.directors;
            }
        },
        author: (state) => (id) => {
            return state.authors.filter(author => author.id === id);
        },

        booksByAuthor: (state) => (id) => {
            if (state.books === null) {
                return null;
            }

            return state.books.filter((book) => book.author.some((author) => author.id === id));
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
        async initMedia({commit, state, dispatch}) {
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
            dispatch('fetchMeta');
        },

        async refreshMedia({commit, dispatch}) {
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

        async fetchArtists({commit, state}, type) {
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

        async updateArtist({commit, state}, {type, id, updateInfo}) {
            let endpoint = 'authors'
            if (type === 'movie') {
                endpoint = 'directors'
            }

            let response = await axios.post('media/meta/' + endpoint + '/update/' + id, {
                author: updateInfo
            });
            switch (type) {
                case 'book':
                    let newAuthor = response.data.author;
                    commit('UPDATE_AUTHOR', newAuthor);
                    break;
            }
        },

        async fetchArtist({state}, {type, id}) {
            let endpoint = 'authors'
            if (type === 'movie') {
                endpoint = 'directors'
            }

            let response = await axios.get('media/meta/' + endpoint + '/' + id);
            return response.data.author;
        },

        async addMedia({dispatch, state}, payload) {
            let media = payload.media;
            let type = payload.type;
            try {
                await axios.post('/media/add/' + type, {
                    media: media
                });
            } catch (e) {
                console.log('error');
            }
            return dispatch('refreshMedia');
        }
    }
}
