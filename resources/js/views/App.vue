<template>
    <!--<navigation-component :appname="appname"
                          :authenticated="authenticated"
                          :username="username">
    </navigation-component>-->
    <main class="py-4">
        <router-view></router-view>
    </main>
</template>

<script>
    export default {
        name: "App",
        props: ['appname']
    }
</script>

<style scoped>

</style>
