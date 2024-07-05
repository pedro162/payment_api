import './bootstrap';


import { createApp } from 'vue';
import App from './views/App.vue';
import {createRouter, createWebHistory } from 'vue-router'
import Welcome from './components/Welcome.vue';
import Products from './components/Products.vue';
import LoginPage from './pages/user/login.vue';
import NavItems from './layouts/components/NavItems.vue';
//const app = createApp({});
//app.component('Welcome', Welcome);
//app.component('Products', Products);
//https://github.com/themeselection/materio-vuetify-vuejs-laravel-admin-template-free/blob/main/javascript-version/resources/js/plugins/router/routes.js

const routes = [
    {path:'/products', component:Products, name:'Home', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Products', link:'/product'}
        ]
    }},
    {path:'/login', component:LoginPage, name:'Login', props:{
        breadcrumb:[
            
        ]
    }},
    {path:'/home', component:Welcome, name:'Welcome', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Home', link:'/home'}
        ]
    }},
]

const router = createRouter({
	history:createWebHistory(),
	routes,
})

createApp(App).use(router).mount('#app');