<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title">Your media</h2>
                        <h5>{{ totalCountOfMedia }} media items total</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-4">
                <card-component title="Your books" :subheadline="totalCountOfBooks + ' books total'"
                                :links="[{params: {type: 'book'}, url: 'list', btn: 'btn btn-success', desc: 'View all'},
                                    {params: {type: 'book'}, url: 'add', btn: 'btn btn-primary', desc: 'Add book'}]">
                </card-component>
            </div>
            <div class="col-sm-4">
                <card-component title="Your movies" :subheadline=" totalCountOfMovies  + ' movies total'"
                                :links="[{params: {type: 'movie'}, url: 'list', btn: 'btn btn-success', desc: 'View all'},
                                    {params: {type: 'movie'}, url: 'add', btn: 'btn btn-primary', desc: 'Add book'}]">
                </card-component>
            </div>
            <div class="col-sm-4">
                <card-component title="Your profile" :subheadline="user.name"
                                :links="[{params: {}, url: 'profile', btn: 'btn btn-primary', desc: 'View Profile'}]">
                </card-component>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "Home",
        data() {
            return {
                totalCountOfMedia: 0,
                totalCountOfBooks: 0,
                totalCountOfMovies: 0,
            }
        },
        computed: {
            ...mapGetters({
                user: 'auth/user',
                books: 'media/books',
                movies: 'media/movies'
            }),
        },
        methods: {
            ...mapActions({
                initMedia: 'media/initMedia',
            }),
            async indexCall() {
                this.initMedia().then((response) => {
                    this.totalCountOfMovies = this.movies.length;
                    this.totalCountOfBooks = this.books.length;
                    this.totalCountOfMedia = this.totalCountOfBooks + this.totalCountOfMovies;
                });
            }
        },
        mounted() {
            this.indexCall();
        }
    }
</script>

<style scoped>

</style>
