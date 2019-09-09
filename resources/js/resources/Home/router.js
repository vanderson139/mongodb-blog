import VueRouter from 'vue-router'

import Article from './../../components/Home/Article'
import ArticlesList from './../../components/Home/ArticlesList'

const routes = [
    {
        path: '/',
        name: 'home',
        component: ArticlesList,
    },
    {
        path: '/:slug',
        name: 'article',
        component: Article,
        props: true
    }
];

const router = new VueRouter({
    routes,
});

export default router
