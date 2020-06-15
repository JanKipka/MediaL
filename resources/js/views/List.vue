<template>
    <div class="container">
        <h2>All your {{ type }}s</h2>
        <list-table-component :type="type" :media-items="mediaItems">
        </list-table-component>
    </div>
</template>

<script>
    import axios from 'axios';
    import {mapGetters} from "vuex";
    export default {
        name: "List",
        data() {
            return {
                type: '',
                mediaItems: []
            }
        },
        computed: {
            ...mapGetters({
                books: 'media/books',
                movies: 'media/movies'
            }),
        },
        methods: {
          async list() {
              if (this.books === null || this.movies === null) {
                  await this.$store.dispatch('media/fetchMedia');
              }
              if (this.type === 'book') {
                  this.mediaItems = this.books;
              } else {
                  this.mediaItems = this.movies;
              }
          }
        },
        created() {
            this.type = this.$route.params.type;
            this.list();
        }
    }
</script>

<style scoped>

</style>
