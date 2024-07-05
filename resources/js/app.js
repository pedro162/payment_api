import './bootstrap';


import { createApp } from 'vue';
import App from './views/App.vue';
import {createRouter, createWebHistory } from 'vue-router'
import Welcome from './components/Welcome.vue';
import Products from './pages/products/products.vue';
import Groceries from './pages/groceries/groceries.vue';
import LoginPage from './pages/user/login.vue';
import NavItems from './layouts/components/NavItems.vue';
//const app = createApp({});
//app.component('Welcome', Welcome);
//app.component('Products', Products);
//https://github.com/themeselection/materio-vuetify-vuejs-laravel-admin-template-free/blob/main/javascript-version/resources/js/plugins/router/routes.js

const routes = [
    {path:'/products', component:Products, name:'Products', props:{
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
    {path:'/groceries', component:Groceries, name:'Groceries', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Groceries', link:'/groceries'}
        ]
    }},
    {path:'/purchases', component:Groceries, name:'Purchase history', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Groceries', link:'/purchases'}
        ]
    }},
    {path:'/settings', component:Groceries, name:'Settings', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Settings', link:'/settings'}
        ]
    }},
]

const router = createRouter({
	history:createWebHistory(),
	routes,
})

createApp(App).use(router).mount('#app');