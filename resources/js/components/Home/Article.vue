<template>
    <div class="page-container">
        <sui-grid :columns="1" padded>
            <sui-segment is="sui-grid-column">
                <sui-container class="main" text>
                    <sui-header size="huge" v-if="article">{{ article.title }}</sui-header>
                    <p v-if="article">{{ article.text }}</p>
                </sui-container>
            </sui-segment>
        </sui-grid>
    </div>
</template>

<script>
    export default {
        props: ['slug'],
        data() {
            return {
                article: null,
            }
        },
        created() {
            if(this.$props.slug) {
                this.fetch(this.$props.slug);
            }
        },
        methods: {
            fetch(slug) {
                window.axios.get(`/${slug}`).then((response) => {
                    this.article = response.data;
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
