import './bootstrap';
import Vue from 'vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import 'semantic-ui-css/semantic.min.css';
import SuiVue from 'semantic-ui-vue';
import router from './resources/Home/router';

Vue.router = router;
Vue.use(VueRouter);
Vue.use(SuiVue);

Vue.config.devtools = true;
Vue.config.performance = true;

// Set Vue authentication
Vue.use(VueAxios, axios);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from './components/Home/App';

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
