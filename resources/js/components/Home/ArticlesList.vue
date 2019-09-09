<template>
    <div class="page-container">
        <sui-container class="main" text>
            <sui-grid :columns="1" padded>
                <sui-segment
                    is="sui-grid-column"
                    v-for="article in articles"
                    v-bind="article"
                    :key="article._id">
                    <router-link :to="{path: `/${article.slug}`}">
                        <sui-header size="huge">{{ article.title }}</sui-header>
                    </router-link>
                    <p>{{ article.text }}</p>
                </sui-segment>
            </sui-grid>
        </sui-container>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                articles: [],
            }
        },
        created() {
            this.fetch();
        },
        methods: {
            fetch() {
                window.axios.get(`/`).then((response) => {
                    this.articles = response.data.data
                });
            },
        }
    }
</script>

<style scoped>
    .page-container {
        max-width: 1200px;
        margin-top: 5em;
    }
</style>
