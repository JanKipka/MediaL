<template>
    <table class="table mt-3" id="mediaTable">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">{{ type === 'book' ? 'Authors' : 'Directors'}}</th>
            <th scope="col">Format</th>
            <th scope="col">Genre</th>
            <th scope="col">Read?</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in mediaItems">
            <td>{{item.title}}</td>
            <td v-if="type === 'book'">
                <router-link v-for="author in item.author" :key="author.id" :to="{name: 'author', params: {id: author.id}}">
                    {{ author.fullName }}
                </router-link>
<!--                {{ item.author | authors }}-->
            </td>
            <td v-else>
                <template v-for="director in item.director">
                    {{ director.firstName }} {{ director.lastName }},
                </template>
            </td>
            <td>{{item.format.name}}</td>
            <td>{{item.genre.name}}</td>
            <td>{{item.read | hasRead }}</td>
            <td><div><img :src="item.imageLink" alt="thumbnail" class="book-thumbnail"/></div></td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "ListTableComponent",
        props: ['type', 'mediaItems']
    }
</script>

<style scoped>
    .book-thumbnail {
        width: 100px;
    }
</style>
