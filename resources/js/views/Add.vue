<template>
    <add-book-form-component :type="type"
                             :artists="artists" :genres="genres" :formats="formats">
    </add-book-form-component>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "Add",
        data() {
            return {
                type: '',
                artists: [],
                formats: []
            }
        },
        computed: {
            ...mapGetters({
                genres: 'media/genres',
                getArtists: 'media/artists'
            }),
        },
        methods: {
            async getFormData() {
                if (this.genres === null || this.formats === null) {
                    await this.$store.dispatch('media/fetchMeta');
                }
                if (this.getArtists(this.type) === null) {
                    let param;
                    if (this.type === 'book') {
                        param = 'author';
                    } else {
                        param = 'director';
                    }
                    await this.$store.dispatch('media/fetchArtists', param);
                }
                this.formats = this.$store.getters["media/" + this.type + "Formats"];
                this.artists = this.getArtists(this.type);
            }
        },
        created() {
            this.type = this.$route.params.type;
            this.getFormData();
        }
    }
</script>

<style scoped>

</style>
