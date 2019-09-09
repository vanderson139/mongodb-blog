<template>
    <div class="page-container">
        <sui-grid :columns="1" padded>
            <sui-grid-column>
                <h1 is="sui-header">
                    Articles
                </h1>
            </sui-grid-column>
        </sui-grid>
        <sui-grid :columns="1" padded>
            <sui-segment is="sui-grid-column">
                <router-link :to="{path: `/article/create`}">
                    <sui-button icon="add" content="New Article" size="small" primary/>
                </router-link>
                <sui-table celled>
                    <sui-table-header>
                        <sui-table-row>
                            <sui-table-header-cell>Title</sui-table-header-cell>
                            <sui-table-header-cell>Slug</sui-table-header-cell>
                            <sui-table-header-cell>Created At</sui-table-header-cell>
                            <sui-table-header-cell>Actions</sui-table-header-cell>
                        </sui-table-row>
                    </sui-table-header>

                    <sui-table-body>
                        <sui-table-row
                            v-for="article in articles"
                            v-bind="article"
                            :key="article._id">
                            <sui-table-cell>{{ article.title }}</sui-table-cell>
                            <sui-table-cell>{{ article.slug }}</sui-table-cell>
                            <sui-table-cell>{{ article.created_at }}</sui-table-cell>
                            <sui-table-cell>
                                <router-link :to="{path: `/article/${article._id}/edit`}">
                                    <sui-button icon="edit" content="Edit" size="small"/>
                                </router-link>
                                <sui-button icon="trash" content="Delete" size="small" color="red" v-on:click="remove(article._id)"/>
                            </sui-table-cell>
                        </sui-table-row>
                    </sui-table-body>
                </sui-table>
            </sui-segment>
        </sui-grid>
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
                window.axios.get(`/article`).then((response) => {
                    this.articles = response.data.data
                });
            },
            remove(id) {
                window.axios.delete(`/article/${id}`).then(() => {
                    this.$router.go();
                });
            }
        }
    }
</script>

<style scoped>
    .page-container {
        max-width: 1200px;
    }
</style>
