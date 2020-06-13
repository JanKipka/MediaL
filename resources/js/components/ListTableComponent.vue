<template>
    <table class="table mt-3" id="mediaTable">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">{{ type }}</th>
            <th scope="col">Format</th>
            <th scope="col">Genre</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in mediaitems">
            <th scope="row">{{item.id}}</th>
            <td>{{item.title}}</td>
            <td v-if="type === 'book'">
                <template v-for="author in item.author">
                    {{ author.firstName }} {{ author.lastName }},
                </template>
            </td>
            <td v-else>
                <template v-for="director in item.director">
                    {{ director.firstName }} {{ director.lastName }},
                </template>
            </td>
            <td>{{item.format.name}}</td>
            <td>{{item.genre.name}}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "ListTableComponent",
        props: ['type', 'mediaitems']
    }
</script>

<style scoped>

</style>
