<template>
    <div class="background">
        <sui-grid centered vertical-align="middle">
            <sui-grid-column>

                <h2 is="sui-header" color="teal" image>
                    <sui-image src="https://semantic-ui-vue.github.io/static/images/logo.png" />
                    <sui-header-content>Log-in to your account</sui-header-content>
                </h2>

                <sui-form autocomplete="off" @submit.prevent="login" method="post">
                    <sui-segment stacked>
                        <sui-form-field>
                            <sui-input
                                type="email"
                                placeholder="E-mail address"
                                icon="user"
                                v-model="email"
                                icon-position="left" />
                        </sui-form-field>
                        <sui-form-field>
                            <sui-input
                                type="password"
                                placeholder="Password"
                                icon="lock"
                                v-model="password"
                                icon-position="left" />
                        </sui-form-field>
                        <sui-button size="large" color="teal" fluid>Login</sui-button>
                    </sui-segment>
                </sui-form>
            </sui-grid-column>
        </sui-grid>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: null,
                password: null,
                success: false,
                has_error: false,
                error: ''
            }
        },
        mounted() {
            //
        },
        methods: {
            login() {
                let app = this;
                this.$auth.login({
                    data: {
                        email: app.email,
                        password: app.password
                    },
                    success: function() {
                        // handle redirection
                        app.success = true;
                        const redirectTo = '/article';
                        this.$router.push({path: redirectTo})
                    },
                    error: function(res) {
                        app.has_error = true;
                        app.error = res.response.data.error
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            }
        }
    }
</script>

<style lang="css" scoped>
    .background {
        background-color: #DADADA !important;
        height: 100vh;
        margin: 1em 0;
    }

    .grid {
        height: 100%;
    }

    .column {
        max-width: 450px;
        text-align: center !important;
    }
</style>
