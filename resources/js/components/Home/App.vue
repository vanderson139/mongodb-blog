<template>
    <div>
        <sui-menu fixed inverted>
            <sui-container>
                <a href="/" is="sui-menu-item" class="header">
                    <img src="https://semantic-ui-vue.github.io/static/images/logo.png" class="logo">
                    Blog
                </a>

                <a is="sui-menu-item" href="/">Home</a>
                <a is="sui-menu-item" href="/admin">Admin</a>
            </sui-container>
        </sui-menu>

        <router-view/>

        <sui-segment inverted vertical class="footer"/>
    </div>
</template>

<script>
    export default {

    }
</script>

<style lang="css" scoped>
    img.logo {
        margin-right: 1.5em !important;
    }

    .footer {
        margin: 5em 0em 0em;
        padding: 5em 0em;
    }
</style>
