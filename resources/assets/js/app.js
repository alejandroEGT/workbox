
require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './rutas';
Vue.router = new VueRouter({ routes: routes});
let AppLayout= require('./components/ExampleComponent');//Vista Suprema
//ELEMENT UI.
import ElementUI from 'element-ui'
import lang from 'element-ui/lib/locale/lang/es'
import locale from 'element-ui/lib/locale'
import 'element-ui/lib/theme-default/index.css'
import './assets/icon.css'
//Axios
import axios from 'axios'
import VueAxios from 'vue-axios'
//jwt
import VueAuth from '@websanova/vue-auth'
 
Vue.use(VueAxios, axios)
Vue.use(ElementUI);
locale.use(lang)

Vue.use(VueAuth, {
   auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
   http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
   router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
   rolesVar: 'type',
   loginData: {url: ' api/auth/login'},
   logoutData: {url: ' api/auth/logout'},
   fetchData: {url: ' api/auth/user'},
   refreshData: {enabled: false},
});
Vue.use(VueRouter);
const router = new VueRouter({ mode: 'history', routes: routes})


AppLayout.router = Vue.router;

new Vue(AppLayout).$mount('#app');