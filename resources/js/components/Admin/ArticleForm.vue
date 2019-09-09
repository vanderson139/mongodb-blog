<template>
    <div class="page-container">
        <sui-grid :columns="1" padded>
            <sui-grid-column>
                <h1 is="sui-header">
                    Article
                </h1>
                <sui-form autocomplete="off" @submit.prevent="save" method="post">
                    <sui-form-field>
                        <label>Title</label>
                        <input placeholder="Title" v-model="title">
                    </sui-form-field>
                    <sui-form-field>
                        <label>Slug</label>
                        <input placeholder="Slug" v-model="slug">
                    </sui-form-field>
                    <sui-form-field>
                        <label>Text</label>
                        <textarea placeholder="Text" v-model="text"></textarea>
                    </sui-form-field>
                    <sui-button type="submit">Submit</sui-button>
                </sui-form>
            </sui-grid-column>
        </sui-grid>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                title: null,
                slug: null,
                text: null,
                success: false,
                has_error: false,
                error: ''
            }
        },
        created() {
            if(this.$props.id) {
                this.fetch(this.$props.id);
            }
        },
        methods: {
            fetch(id) {
                window.axios.get(`/article/${id}`).then((response) => {
                    this.title = response.data.title;
                    this.slug = response.data.slug;
                    this.text = response.data.text;
                });
            },
            save() {
                let title = this.title;
                let slug = this.slug;
                let text = this.text;

                let data = { title, slug, text };

                if(this.$props.id) {
                    this.update(this.$props.id, data);
                } else {
                    this.create(data);
                }
            },
            create(data) {
                window.axios.post(`/article`, data).then((response) => {
                    this.$router.push({path: `/article`});
                });
            },
            update(id, data) {
                window.axios.put(`/article/${id}`, data).then((response) => {
                    this.$router.push({path: `/article`});
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
