<template>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ title }}</h2>
            <h5>{{ subheadline }}</h5>
            <a v-for="link in links" :href="link.url" class="m-2" :class="link.btn">{{link.desc}}</a>
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
