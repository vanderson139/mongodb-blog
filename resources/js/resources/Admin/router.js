import VueRouter from 'vue-router'

import App from './../../components/Admin/App'
import Login from './../../components/Admin/Login'
import ArticlesList from './../../components/Admin/ArticlesList'
import ArticleForm from './../../components/Admin/ArticleForm'

const routes = [
    {
        path: '/',
        name: 'home',
        component: App,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/article',
                name: 'article-list',
                component: ArticlesList
            },
            {
                path: '/article/create',
                name: 'article-create',
                component: ArticleForm,
            },
            {
                path: '/article/:id/edit',
                name: 'article-edit',
                component: ArticleForm,
                props: true
            }
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
];

const router = new VueRouter({
    routes,
});

export default router
