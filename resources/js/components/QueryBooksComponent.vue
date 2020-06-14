<template>
    <div class="tab-pane fade show active" id="queryApi" role="tabpanel" aria-labelledby="query-api">
        <input type="text" v-on:input="queryApi" class="form-control mt-1" placeholder="Search for title"
               name="queryKey"
               v-model="queryTitle"/>
        <input type="text" v-on:input="queryApi" class="form-control mt-2" placeholder="Search for author"
               name="queryAuthor"
               v-model="queryAuthor">
        <input type="text" v-on:input="queryApi" class="form-control mt-2" placeholder="Search for ISBN"
               name="queryISBN" v-model="queryISBN">
        <h2 class="text-center mt-3" v-if="searching === 1">Searching...</h2>
        <h2 class="text-center mt-3" v-if="noResultsFound">No books found</h2>
        <div v-if="books.length > 0">
            <div class="card mt-2 mb-2" v-for="book in books">
                <book-card-component :genres="genres" :formats="formats" :book="book">
                </book-card-component>
            </div>
        </div>
    </div>
</template>

<script>
    import AddBookButtonComponent from "./AddBookButtonComponent";
    import SelectComponent from "./SelectComponent";
    import BookCardComponent from "./BookCardComponent";
    import EventBus from "./event-bus";

    function Book(title, authors, pageCount, imageLink, isbn, publishedDate, textSnippet) {
        this.title = title;
        this.authors = authors;
        this.pageCount = pageCount;
        this.imageLink = imageLink;
        this.isbn = isbn;
        this.publishedDate = publishedDate;
        this.textSnippet = textSnippet;
        this.read = false;
        this.format = 0;
        this.genre = 0;
    }

    export default {
        name: "QueryBooksComponent",
        components: {BookCardComponent, SelectComponent, AddBookButtonComponent},
        props: ['formats', 'genres'],
        data() {
            return {
                books: [],
                queryTitle: '',
                queryAuthor: '',
                queryISBN: '',
                searching: 0,
                selectedFormat: '',
                selectedGenre: '',
                noResultsFound: false,
            };
        },
        methods: {
            async queryApi() {
                this.books = [];
                this.searching = 1;
                this.noResultsFound = false;
                if (this.queryAuthor || this.queryISBN || this.queryTitle) {
                    if (this.timer) {
                        clearTimeout(this.timer);
                        this.timer = null;
                    }
                    this.timer = setTimeout(() => {
                        console.log('executing...');
                        window.axios.post('api/queryBooks', {
                            queryAuthor: this.queryAuthor,
                            queryISBN: this.queryISBN,
                            queryTitle: this.queryTitle,
                        }).then((response) => {
                            this.searching = 2;
                            console.log(response);
                            let data = response.data;
                            if (data.totalItems > 0) {
                                this.noResultsFound = false;
                                data.items.forEach(item => this.books.push(new Book(
                                    item.volumeInfo.title,
                                    item.volumeInfo.authors,
                                    item.volumeInfo.pageCount,
                                    item.volumeInfo.imageLinks ? item.volumeInfo.imageLinks.thumbnail : '',
                                    item.volumeInfo.industryIdentifiers ? this.$options.filters.isbn(item.volumeInfo.industryIdentifiers) : [],
                                    item.volumeInfo.publishedDate,
                                    item.searchInfo ? item.searchInfo.textSnippet : ''
                                )));
                            } else {
                                this.noResultsFound = true;
                            }
                        });
                    }, 800);
                } else {
                    this.searching = 0;
                    this.noResultsFound = false;
                }
            },
        },
    }
</script>

<style scoped>

</style>
