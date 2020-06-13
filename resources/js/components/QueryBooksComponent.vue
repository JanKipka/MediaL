<template>
    <div class="tab-pane" id="queryApi" role="tabpanel" aria-labelledby="query-api">
        <input type="text" v-on:input="queryApi" class="form-control mt-1" placeholder="Search for title"
               name="queryKey"
               v-model="queryTitle"/>
        <input type="text" v-on:input="queryApi" class="form-control mt-2" placeholder="Search for author"
               name="queryAuthor"
               v-model="queryAuthor">
        <input type="text" v-on:input="queryApi" class="form-control mt-2" placeholder="Search for ISBN"
               name="queryISBN" v-model="queryISBN">
        <h2 class="text-center mt-3" v-if="searching === 1">Searching...</h2>
        <table class="table mt-2" v-if="books.length > 0">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Authors</th>
                <th scope="col">Seitenzahl</th>
                <th scope="col">Thumbnail</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="book in books">
                <td>{{book.title}}</td>
                <td>{{book.authors}}</td>
                <td>{{book.pageCount}}</td>
                <td><img class="w-25" :src="book.imageLink" alt="thumbnail"/></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    function Book(title, authors, pageCount, imageLink) {
        this.title = title;
        this.authors = authors;
        this.pageCount = pageCount;
        this.imageLink = imageLink;
    }

    export default {
        name: "QueryBooksComponent",
        data() {
            return {
                books: [],
                queryTitle: '',
                queryAuthor: '',
                queryISBN: '',
                searching: 0,
            };
        },
        methods: {
            async queryApi() {
                this.books = [];
                if (this.queryAuthor || this.queryISBN || this.queryTitle) {
                    if (this.timer) {
                        clearTimeout(this.timer);
                        this.timer = null;
                    }
                    this.timer = setTimeout(() => {
                        this.searching = 1;
                        console.log('executing...');
                        window.axios.post('api/queryBooks', {
                            queryAuthor: this.queryAuthor,
                            queryISBN: this.queryISBN,
                            queryTitle: this.queryTitle,
                        }).then((response) => {
                            this.searching = 2;
                            console.log(response);
                            let data = response.data;
                            data.items.forEach(item => this.books.push(new Book(
                                item.volumeInfo.title,
                                item.volumeInfo.authors,
                                item.volumeInfo.pageCount,
                                item.volumeInfo.imageLinks ? item.volumeInfo.imageLinks.thumbnail : ''
                            )));
                        });
                    }, 800);
                } else {
                    this.searching = 0;
                }
            }
        },

        created() {
        }

    }
</script>

<style scoped>

</style>
