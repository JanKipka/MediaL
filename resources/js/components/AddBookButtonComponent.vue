<template>
    <button class="btn btn-block" :disabled="disabled" :class="btnClass" @click="click(book)">
        {{ text }}
    </button>
</template>

<script>
    import EventBus from "./event-bus";
    import axios from 'axios';
    import {mapActions} from 'vuex';

    export default {
        name: "AddBookButtonComponent",
        props: ['book', 'disabled'],
        data() {
            return {
                btnClass: 'btn-primary',
                text: 'Add to library',
                genreValue: '',
                formatValue: '',
            }
        },
        methods: {
            ...mapActions({
                add: 'media/addMedia'
            }),
            async click(book) {
                let payload = {
                    media: book,
                    type: 'book'
                };
                this.add(payload).then((response) => {
                    this.btnClass = 'btn-success';
                    this.text = 'Added';
                });
            }
        },
    }
</script>

<style scoped>

</style>
