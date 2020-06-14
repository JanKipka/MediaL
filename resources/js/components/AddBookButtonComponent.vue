<template>
    <button class="btn btn-block" :disabled="disabled" :class="btnClass" @click="add(book)">
        {{ text }}
    </button>
</template>

<script>
    import EventBus from "./event-bus";

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
            async add(book) {
                window.axios.post('/api/addBook', {
                    book: book
                }).then((response) => {
                    this.btnClass = 'btn-success';
                    this.text = 'Added';
                });
            }
        },
    }
</script>

<style scoped>

</style>
