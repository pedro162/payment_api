
<template>
    <div class="flex flex-col h-screen">
        <Header :title="title ? title : ''" :toggleMenuLateral="toggle" :isExpandedMenuLateral="isExpanded" />
        <div class="flex flex-1" >  
          <div id :class="['fixed inset-y-0 left-0 bg-gray-800 text-white transition-width duration-300 z-30', { 'w-60': isExpanded, 'w-0 md:w-16': !isExpanded }]" @mouseenter="expand" @mouseleave="collapse">
              <ul v-if="isExpanded || !isMobile" class="space-y-4 p-4 mt-12">
                  <li><router-link @click="toggle" to="/" class="block p-2 hover:bg-gray-700"><i class="mr-2 text-2xl fa fa-home"></i> Home</router-link></li>
                  <li><router-link @click="toggle" to="/groceries" class="block p-2 hover:bg-gray-700"><i class="mr-2 text-2xl fa fa-list-alt"></i> Grocery list</router-link></li>
                  <li><router-link @click="toggle" to="/products" class="block p-2 hover:bg-gray-700"><i class="mr-2 text-2xl fa fa-shopping-basket"></i> Products</router-link></li>
                  <li><router-link @click="toggle" to="/purchases" class="block p-2 hover:bg-gray-700"><i class="mr-2 text-2xl fa fa-history"></i> Purchase history</router-link></li>
                  <li><router-link @click="toggle" to="/settings" class="block p-2 hover:bg-gray-700"><i class="mr-2 text-2xl fa fa-cog"></i> Settings</router-link></li>
                  <li><span @click="()=>{toggle();logout();}" class="block p-2 hover:bg-gray-700" ><i class="mr-2 text-2xl fa fa-sign-out-alt"></i> Exit</span></li>
              </ul>
          </div>
          <div v-if="isExpanded && isMobile" class="fixed inset-0 bg-black opacity-50 z-20" @click="toggle"></div>
          
          <div class="flex-1 p-6 ml-0 md:ml-16">
            <div class="flex mb-4">
              <Breadcrumb :items="breadcrumbItems" />
            </div> 
            
            <router-view :setBreadcrumb="setBreadcrumb" :setTitle="setTitle" ></router-view>
          </div>
      </div>
    </div>
</template>
<script>

import NavItems from "../layouts/components/NavItems.vue"
import Header from "../layouts/components/Header.vue"
import Breadcrumb from "../layouts/components/Breadcrumb.vue"
//https://www.google.com/search?q=app%20lista%20de%20compras&udm=2&tbs=rimg:CS2B1z9tk4jsYX-5crWXWG1QsgIAwAIA2AIA4AIA&hl=pt-BR&sa=X&ved=0CBoQuIIBahcKEwjYu8SXrvCGAxUAAAAAHQAAAAAQLQ&biw=1920&bih=919&dpr=1#vhid=iBUyohobgA8hoM&vssid=mosaic
export default {
  name:'App',
  components:{
    Header,
    Breadcrumb
  },
  data() {

    return {
      isExpanded: false,
      isLogged: false,
      isMobile: window.innerWidth < 768,
      breadcrumbItems:[],
      title:''
    };
  },
  methods: {
    expand() {
      if (!this.isMobile) {
        this.isExpanded = true;
      }
    },
    collapse() {
      if (!this.isMobile) {
        this.isExpanded = false;
      }
    },
    toggle() {
      this.isExpanded = !this.isExpanded;
    },
    handleResize() {
      this.isMobile = window.innerWidth < 768;
      if (!this.isMobile) {
        this.isExpanded = false;
      }
    },
    setBreadcrumb(items){
      this.breadcrumbItems = items;
    },
    setTitle(title){
      this.title = title;
    },
    logout(){
      this.$router.push({ name: 'Login' });
    }
  },
  mounted() {
    window.addEventListener('resize', this.handleResize);
    this.handleResize();
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.handleResize);
  }
}
</script>
