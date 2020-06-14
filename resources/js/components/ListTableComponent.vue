<template>
    <table class="table mt-3" id="mediaTable">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">{{ type === 'book' ? 'Authors' : 'Directors'}}</th>
            <th scope="col">Format</th>
            <th scope="col">Genre</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in mediaitems">
            <td>{{item.title}}</td>
            <td v-if="type === 'book'">
                {{ item.author | authors }}
            </td>
            <td v-else>
                <template v-for="director in item.director">
                    {{ director.firstName }} {{ director.lastName }},
                </template>
            </td>
            <td>{{item.format.name}}</td>
            <td>{{item.genre.name}}</td>
            <td><img :src="item.imageLink" alt="thumbnail" class="w-75"/></td>
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
