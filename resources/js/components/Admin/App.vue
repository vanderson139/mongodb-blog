<template>
    <div>
        <div is="sui-sidebar-pushable">
            <sui-menu
                class="sidebar"
                is="sui-sidebar"
                inverted="true"
                vertical="true"
                animation="overlay"
                :visible="true"
            >
                <sui-menu-item>
                    <sui-menu-header>Blog Admin</sui-menu-header>
                    <sui-menu-menu>
                        <router-link is="sui-menu-item" to="/article">Articles</router-link>
                        <a is="sui-menu-item" href="https://semantic-ui.com/">
                            Sair
                            <sui-icon name="logout" />
                        </a>
                    </sui-menu-menu>
                </sui-menu-item>
            </sui-menu>

            <div class="main">
                <router-view />
            </div>
        </div>
    </div>
</template>
<style scoped>
    .main {
        margin-left: 250px;
        min-width: 550px;
        height: 100vh;
        overflow-y: scroll;
    }
    .sidebar {
        position: fixed !important;
        top: 0px !important;
        bottom: 0px !important;
        left: 0px !important;
        width: 250px !important;
        padding-bottom: 1em !important;
        background: rgb(27, 28, 29) !important;
        overflow-y: scroll !important;
    }
</style>
