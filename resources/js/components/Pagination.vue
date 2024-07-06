<template>
    <nav class="flex justify-center my-4">
      <ul class="flex list-none rounded-lg overflow-hidden bg-gray-100">
        <li>
          <button
            class="px-4 py-2 border-r border-gray-200 hover:bg-gray-200 focus:outline-none"
            :disabled="pagination?.last_page === 1"
            @click="changePage(pagination?.current_page - 1)"
          >
            Prev
          </button>
        </li>
        <li v-for="page in pagination?.last_page" :key="page">
          <button
            class="px-4 py-2 border-r border-gray-200 hover:bg-gray-200 focus:outline-none"
            :class="{ 'bg-blue-500 text-white': pagination?.current_page === page }"
            @click="changePage(page)"
          >
            {{ page }}
          </button>
        </li>
        <li>
          <button
            class="px-4 py-2 hover:bg-gray-200 focus:outline-none"
            :disabled="pagination?.current_page === pagination?.last_page"
            @click="changePage(pagination?.current_page + 1)"
          >
            Next
          </button>
        </li>
      </ul>
    </nav>
  </template>
  
  <script>
  export default {
    name:'Pagination',
    props: {
        pagination: {
            type: Object,
            required: true
        },
    },
    methods: {
      changePage(page) {
        if (page !== this.pagination?.current_page) {
          this.$emit("page-change", this.pagination?.path+'?page='+page);
        }
      }
    }
  };
  </script>
  
  <style scoped>
  /* Estilos opcionais para personalizar o componente de paginação */
  </style>
  