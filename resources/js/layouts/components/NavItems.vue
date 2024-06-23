<template>
  <div class="flex h-screen">
    <div :class="['sidebar bg-gray-800 text-white', { 'sidebar-expanded': isExpanded }]" @mouseenter="expand" @mouseleave="collapse">
      <ul class="space-y-4 p-4">
        <li><a href="#" class="block p-2 hover:bg-gray-700">Home</a></li>
        <li><a href="#" class="block p-2 hover:bg-gray-700">Lista de Compras</a></li>
        <li><a href="#" class="block p-2 hover:bg-gray-700">Produtos</a></li>
        <li><a href="#" class="block p-2 hover:bg-gray-700">Configurações</a></li>
      </ul>
    </div>
    <button class="menu-btn md:hidden absolute top-4 left-4 bg-gray-800 text-white p-2" @click="toggle">☰</button>
    <div class="content flex-1 p-6">
      <h1 class="text-2xl">Bem-vindo ao seu Sistema de Lista de Compras</h1>
      <p class="mt-4">Aqui você pode gerenciar suas listas de compras de forma fácil e eficiente.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NavItems',
  data() {
    return {
      isExpanded: true
    };
  },
  methods: {
    expand() {
      this.isExpanded = true;
    },
    collapse() {
      this.isExpanded = false;
    },
    toggle() {
      this.isExpanded = !this.isExpanded;
    }
  }
};
</script>

<style scoped>
.sidebar {
  transition: width 0.3s ease;
  width: 60px;
}
.sidebar-expanded {
  width: 250px;
}
</style>
