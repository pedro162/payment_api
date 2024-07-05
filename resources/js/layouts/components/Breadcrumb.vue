<template>
  <nav v-id="items.length > 0" class="bg-gray-100 p-3 rounded-md w-full">
    <ol class="list-reset flex text-grey-dark">
      <li v-for="(item, index) in items" :key="index" class="flex items-center">
        <span v-if="index !== 0" class="mx-2 text-gray-500">/</span>
        <span v-if="index === items.length - 1" class="text-blue-500">{{ item.name }}</span>
        <router-link
          v-else
          :to="item.link"
          class="text-blue-600 hover:text-blue-800"
        >{{ item.name }}</router-link>
      </li>
    </ol>
  </nav>
</template>
<script>

export default {
    name:'Breadcrumb',
    props:{
        items:{
            type:Array,
            required:true
        }
    }
}
</script>
