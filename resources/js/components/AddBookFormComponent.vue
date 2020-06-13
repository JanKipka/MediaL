<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Add a {{ type }} to your library</h2>
                <ul class="nav nav-tabs" id="addTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="existing-media" data-toggle="tab" href="#existingMedia" role="tab"
                           aria-controls="existingMedia" aria-selected="true">Choose existing {{ type }} from library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="new-media" data-toggle="tab" href="#newMedia" role="tab"
                           aria-controls="newMedia" aria-selected="false">Enter new {{ type }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="query-api" data-toggle="tab" href="#queryApi" role="tab"
                           aria-controls="queryApi" aria-selected="false">Query books</a>
                    </li>
                </ul>
                <div class="tab-content" id="mediaContent">
                    <div class="tab-pane form-group fade show active"
                         id="existingMedia" role="tabpanel"
                         aria-labelledby="existing-media">
                        <list-table-component :type="type" :mediaitems="mediaitems">
                        </list-table-component>
                    </div>
                    <div class="tab-pane" id="newMedia" role="tabpanel"
                         aria-labelledby="new-media">
                        <form action="/persist" method="POST" id="addForm">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <label for="media_title">Title:</label>
                                <input type="text" class="form-control" id="media_title" name="title"
                                       :placeholder="placeholderType"/>
                            </div>
                            <ul class="nav nav-tabs" id="artistTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" :class="artists.length > 0 ? 'active' : ''" id="existing-tab"
                                       data-toggle="tab" href="#existing" role="tab"
                                       aria-controls="existing" aria-selected="true">Choose
                                        existing {{ type === 'book' ? 'author' : 'director' }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" :class="artists.length === 0 ? 'active' : ''" id="new-tab"
                                       data-toggle="tab" href="#new" role="tab"
                                       aria-controls="new" aria-selected="false">Enter
                                        new {{ type === 'book' ? 'author' : 'director' }}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="artistTabContent">
                                <div class="tab-pane form-group fade show" :class="artists.length > 0 ? 'active' : ''"
                                     id="existing" role="tabpanel"
                                     aria-labelledby="existing-tab">
                                    <label for="format">{{ type === 'book' ? 'Author' : 'Director' }}:</label>
                                    <select class="form-control" name="artist" id="artistSelect">
                                        <option v-for="artist in artists"
                                            :value="artist.id">{{artist.firstName}} {{artist.lastName}}</option>
                                    </select>
                                </div>
                                <div class="tab-pane" :class="artists.length === 0 ? 'active' : ''" id="new" role="tabpanel"
                                     aria-labelledby="new-tab">
                                    <div class="form-group">
                                        <label for="artist_name">First
                                            name:</label>
                                        <input type="text" class="form-control" id="artist_name" name="artist_first"
                                               :placeholder="placeholderString"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="artist_lastname">Last
                                            name:</label>
                                        <input type="text" class="form-control" id="artist_lastname" name="artist_last"
                                               :placeholder="placeholderString"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="format">Format:</label>
                                <select class="form-control" name="format" id="format">
                                    <option v-for="format in formats" :value="format.id">{{format.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="genre">Genre:</label>
                                <select class="form-control" name="genre" id="genre">
                                    <option v-for="genre in genres" :value="genre.id">{{genre.name}}</option>
                                </select>
                            </div>

                            <input type="hidden" :value="type" name="type"/>
                            <input type="hidden" id="artistTabChoice" name="artistTabChoice">
                            <button type="submit" class="btn btn-primary">Add {{ type }}</button>
                        </form>
                    </div>
                        <query-books-component></query-books-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddBookFormComponent",
        props: ['type', 'mediaitems', 'artists', 'formats', 'genres'],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                placeholderString: 'Enter new name of the ' + this.type === 'book' ? 'author' : 'director',
                placeholderType: 'Enter the name of the ' + this.type
            };
        },
    }
</script>

<style scoped>

</style>
