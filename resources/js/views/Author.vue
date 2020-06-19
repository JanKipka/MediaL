<template>
    <div class="container">
        <h2 class="text-center">{{author.fullName }}</h2>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="firstName">First name:</label>
                    <input class="form-control" type="text" id="firstName" v-model="author.firstName"
                           @input="concatLastName">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="lastName">Last name:</label>
                    <input class="form-control" type="text" id="lastName" v-model="author.lastName"
                           @input="concatLastName">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="fullName">Full name:</label>
                    <input class="form-control" type="text" id="fullName" v-model="concatName" disabled>
                </div>
            </div>
            <button type="button" @click="submitAuthor" class="btn btn-success btn-block">
                Save
            </button>
        </div>
        <h3 class="text-center mt-5">Your books by {{ author.fullName || ''}}</h3>
        <div class="row mt-2">
            <list-table-component type="book" :media-items="mediaItems">
            </list-table-component>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import axios from 'axios';

    export default {
        name: "Author",
        data() {
            return {
                author: {},
                concatName: '',
                mediaItems: []
            }
        },
        computed: {
            ...mapGetters({
                getBooks: 'media/booksByAuthor'
            })
        },
        methods: {
            ...mapActions({
                submit: 'media/updateArtist',
                get: 'media/fetchArtist'
            }),
            submitAuthor() {
                let payload = {
                    type: 'book',
                    id: this.author.id,
                    updateInfo: this.author
                };
                this.submit(payload).then(() => {
                    this.$router.replace({
                        name: 'home'
                    });
                });
            },
            async fetchBooksFromAuthor() {
                let items = this.getBooks(this.$route.params.id);
                if (items === null) {
                    let response = await axios.get('/media/books/author/' + this.$route.params.id);
                    items = response.data.books;
                }

                this.mediaItems = items;
            },
            concatLastName() {
                let fName = this.author.firstName || '';
                let lName = this.author.lastName || '';
                this.concatName = fName + ' ' + lName;
            }
        },
        created() {
            let payload = {
                type: 'book',
                id: this.$route.params.id
            };
            this.fetchBooksFromAuthor();
            this.get(payload).then((response) => {
                this.author = response;
                if (response.firstName === null && response.lastName === null) {
                    this.concatName = response.fullName;
                } else {
                    this.concatLastName();
                }
            });
        }
    }
</script>

<style scoped>

</style>
