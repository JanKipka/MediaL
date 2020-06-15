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
            <div class="col-sm-3">
                <card-component title="Your books" :subheadline="totalCountOfBooks + ' books total'"
                                :links="[{params: {type: 'book'}, url: 'list', btn: 'btn btn-success', desc: 'View all'},
                                    {params: {type: 'book'}, url: 'add', btn: 'btn btn-primary', desc: 'Add book'}]">
                </card-component>
            </div>
            <div class="col-sm-3">
                <card-component title="Your movies" :subheadline=" totalCountOfMovies  + ' movies total'"
                                :links="[{params: {type: 'movie'}, url: 'list', btn: 'btn btn-success', desc: 'View all'},
                                    {params: {type: 'movie'}, url: 'add', btn: 'btn btn-primary', desc: 'Add book'}]">
                </card-component>
            </div>
            <div class="col-sm-3">
                <card-component title="Your genres" :subheadline="totalCountOfGenres + ' genres total'"
                                :links="[{params: {type: 'book'}, url: 'list', btn: 'btn btn-success', desc: 'View all'}]">
                </card-component>
            </div>
            <div class="col-sm-3">
                <card-component title="Your profile" :subheadline="username"
                                :links="[{params: {}, url: 'profile', btn: 'btn btn-primary', desc: 'View Profile'}]">
                </card-component>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Home",
        data() {
            return {
                username: '',
                totalCountOfMedia: 0,
                totalCountOfBooks: 0,
                totalCountOfMovies: 0,
                totalCountOfGenres: 0,
            }
        },
        created() {
            this.$http({
                url: 'index',
                method: 'GET'
            }).then((response) => {
                this.username = response.userName;
                this.totalCountOfMovies = response.movieCount;
                this.totalCountOfGenres = response.genreCount;
                this.totalCountOfBooks = response.bookCount;
                this.totalCountOfMedia = this.totalCountOfBooks + this.totalCountOfMovies;
            }, () => {
                // error handling
            });
        }
    }
</script>

<style scoped>

</style>
