<template>
    <div>
        <navigation-component :app-name="appName">
        </navigation-component>
        <main class="py-4">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
    export default {
        name: "App",
        props: ['appName'],
    }
</script>

<style scoped>

</style>
