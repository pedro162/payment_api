
<template>
  <div class="welcome">
    <h1>Welcome to my grocery list app</h1>
    <p>This is just a simple example using Vue.js and Laravel.</p>
     <router-link to="/products">Product list</router-link>
  </div>
</template>

<script>
export default {
  name: 'Welcome',
  props:{
    setBreadcrumb:Function,
    breadcrumb:Array
  },
  created(){
    this.setBreadcrumb(this.breadcrumb)
  }
};
</script>

<style scoped>
.welcome {
  text-align: center;
  margin-top: 20px;
}
</style>
