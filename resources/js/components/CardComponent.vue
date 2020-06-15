<template>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ title }}</h2>
            <h5>{{ subheadline }}</h5>
            <router-link v-for="link in links" :key="link.url" :to="{ name: link.url, params: link.params}" class="m-2" :class="link.btn">{{link.desc}}</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CardComponent",
        props: ['title', 'links', 'subheadline']
    }
</script>

<style scoped>

</style>
