<template>
    <div class="card-body d-flex">
        <div class="col-9">
            <h4 class="card-title">
                {{ book.title }}
            </h4>
            <h5 class="card-subtitle text-muted">
                {{ book.authors | authors }}
            </h5>
            <div class="row mt-3">
                <div class="col-5">
                    <h5>ISBN: {{ book.isbn }}</h5>
                    <h5>Page count: {{ book.pageCount }}</h5>
                    <h5>Published in: {{ book.publishedDate | date }}</h5>
                </div>
                <div class="col-7 mt-n4">
                    <h5 class="text-center">Zusatzinformationen</h5>
                    <p>
                        {{ book.textSnippet }}
                    </p>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-5">
                    <select-component :book="book" :dataArray="formats"
                                      selectId="selectFormats" type="format" label="Format">
                    </select-component>
                </div>
                <div class="col-5">
                    <select-component :book="book" :dataArray="genres" selectId="selectGenres"
                                      type="genre" label="Genre">
                    </select-component>
                </div>
                <div class="col-2">
                    <input type="checkbox" class="form-check-input" id="hasRead" v-model="book.read">
                    <label class="form-check-label" for="hasRead">Read?</label>
                </div>
            </div>
            <div>
                <add-book-button-component :book="book" :disabled="(book.format === 0) || (book.genre === 0)">
                </add-book-button-component>
            </div>
        </div>
        <div class="col-3">
            <img class="h-75 book-card-image" :src="book.imageLink" alt="thumbnail"/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BookCardComponent",
        props: ['book', 'genres', 'formats']
    }
</script>

<style scoped>
    .book-card-image {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        position: absolute;
        margin: auto;
    }
</style>
