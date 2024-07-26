import './bootstrap';


import { createApp } from 'vue';
import App from './views/App.vue';
import {createRouter, createWebHistory } from 'vue-router'
import Welcome from './components/Welcome.vue';
import Products from './pages/products/products.vue';
import Groceries from './pages/groceries/groceries.vue';
import GroceryCreate from './pages/groceries/create.vue';
import GroceryItemCreate from './pages/groceries_items/create.vue';
import Purchases from './pages/purchases/purchases.vue';
import LoginPage from './pages/user/login.vue';
import NavItems from './layouts/components/NavItems.vue';
import ProductCreate from './pages/products/create.vue'
import Settings from './pages/settings/settings.vue';
import Brands from './pages/brands/brands.vue';

//const app = createApp({});
//app.component('Welcome', Welcome);
//app.component('Products', Products);
//https://github.com/themeselection/materio-vuetify-vuejs-laravel-admin-template-free/blob/main/javascript-version/resources/js/plugins/router/routes.js
//ProductCreate//Brands
const routes = [
    {path:'/products', component:Products, name:'Products', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Products', link:'/products'}
        ]
    }},{path:'/products/crate', component:ProductCreate, name:'ProductCreate', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Products', link:'/products'},
            {name:'Crate', link:'/products/create'}
        ]
    }},{path:'/products/edit/:id', component:ProductCreate, name:'ProductEdit', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Products', link:'/products'},
            {name:'Edit', link:'/products/edit/:id'}
        ]
    }},{path:'/brands', component:Brands, name:'Brands', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Brands', link:'/brands'}
        ]
    }},
    {path:'/login', component:LoginPage, name:'Login', props:{
        breadcrumb:[
            
        ]
    }},
    {path:'/', component:Welcome, name:'Welcome', props:{
        breadcrumb:[
            {name:'Home', link:'/'}
        ]
    }},
    {path:'/groceries', component:Groceries, name:'Groceries', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Groceries', link:'/groceries'}
        ]
    }},//GroceryItemCreate
    {path:'/groceries/create', component:GroceryCreate, name:'CreateGrocery', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Groceries', link:'/groceries'},
            {name:'Create', link:'/groceries/create'},
        ]
    }},
    {path:'/groceries/edit/:id', component:GroceryCreate, name:'GroceriesEdit', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Groceries', link:'/groceries'},
            {name:'Edit', link:'/groceries/edit/:id'}
        ]
    }},
    {path:'/groceries/item/create/:id', component:GroceryItemCreate, name:'GroceryItemCreate', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Groceries', link:'/groceries'},
            {name:'ADD item', link:'/groceries/item/create/:id'}
        ]
    }},
    {path:'/purchases', component:Purchases, name:'Purchase history', props:{
        breadcrumb:[
            {name:'Home', link:'/'},
            {name:'Purchase history', link:'/purchases'}
        ]
    }},
    {path:'/settings', component:Settings, name:'Settings', props:{
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