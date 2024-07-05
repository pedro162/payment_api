
<template>
  <div class="welcome">
    <h1>Bem-vindo ao meu site js</h1>
    <p>Este é um exemplo simples de uma tela de boas-vindas usando Vue.js no Laravel.</p>
     <router-link to="/products">Create New Post</router-link>
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
