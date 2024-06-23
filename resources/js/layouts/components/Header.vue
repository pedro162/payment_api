<template>
  <header class="bg-gray-800 text-white p-4 flex justify-between items-center">

    <button :class="[' text-white p-2 z-40']" @click="()=>toggleMenuLateral()">
      <i v-if="isExpandedMenuLateral==true" class="fas fa-times icon-menu"></i>
      <i  v-if="isExpandedMenuLateral==false" class="fas fa-bars icon-menu "></i>
    </button>
    <h1 class="text-xl">{{title}}</h1>
    <router-link  to="/user" >
      <button @click="logout" class="rounded-full bg-white-300">
        <i class="fas fa-user-circle text-4xl"></i>
      </button>
    </router-link>
  </header>
</template>

<style>
/* Estilos opcionais para o ícone */
.icon-menu {
  font-size: 24px; /* Tamanho do ícone */
}
</style>
<script>


export default {
    name:'Header',
    props:{
        title:{
            type:String
        },
        toggleMenuLateral:{
          type:Function
        },
        isExpandedMenuLateral:{
          type:Boolean
        }
    },
    methods: {
        logout() {
        // A função de logout pode ser adaptada para as necessidades da sua aplicação
        console.log("Usuário deslogado");
        this.$router.push("/login"); // Redireciona para a página de login
    }
  }
};
</script>
