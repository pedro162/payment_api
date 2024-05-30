import './bootstrap';


import { createApp } from 'vue';
import App from './views/App.vue';
import {createRouter, createWebHistory } from 'vue-router'
import Welcome from './components/Welcome.vue';
import Products from './components/Products.vue';

//const app = createApp({});
//app.component('Welcome', Welcome);
//app.component('Products', Products);

const routes = [
    {path:'/products', component:Products, name:'Home'},
    {path:'/home', component:Welcome, name:'Welcome'}
]

const router = createRouter({
	history:createWebHistory(),
	routes,
})

createApp(App).use(router).mount('#app');