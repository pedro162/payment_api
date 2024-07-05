<template>
    <div class="flex items-center justify-center h-full">
      <div class="spinner-border animate-spin inline-block w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "Spinner"
  };
  </script>
  
  <style scoped>
  .spinner-border {
    border-top-color: transparent;
    border-right-color: transparent;
  }
  </style>
  