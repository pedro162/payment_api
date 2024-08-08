<template>
  <div>
    <!-- Desktop View -->
    <div v-if="!isMobile" class="overflow-x-auto shadow rounded-lg border">
      <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th v-for="(header, index) in headers" :key="index" class="w-auto text-left py-3 px-4 uppercase font-semibold text-sm">{{ header }}</th>
            <th class="w-auto text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(item, index) in items" :key="index" :class="{'bg-gray-50': index % 2 === 0}">
            <td v-for="(header, headerIndex) in headers" :key="headerIndex" class="w-auto text-left py-3 px-4">{{ item[header] }}</td>
            <td class="flex w-auto text-left py-3 px-4">
              <div v-for="(action, actionIndex) in item.actions" :key="actionIndex">
                <slot :name="action.name" :item="item"></slot>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Mobile View -->
    <div v-else class="space-y-4 rounded-lg shadow-md border border-gray-200 p-4 ">
      <div v-for="(item, index) in items" :key="index" class="bg-white p-4  relative">
        <div class="flex flex-row items-start mt-8">
          
          <div class="flex-shrink-0 mr-4">
            <slot name="image" :item="item"></slot>
          </div>
          <div class="flex-1">
            <div v-for="(value, key) in filterInfoMobile(item)" :key="key" class="flex justify-between py-1">
              <span class="font-semibold">{{ formatLabel(key) }}:</span>
              <span>{{ value }}</span>
            </div>
          </div>
        </div>
        
        <div class="absolute top-2 right-2">
          <button @click="toggleMenu(index)" class="text-gray-500 hover:text-gray-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 6h12m-12 12h12"></path>
            </svg>
          </button>
          <div v-if="activeMenuIndex === index" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-200">
            <div v-for="(action, actionIndex) in item.actions" :key="actionIndex">
              <button @click="$emit(action.name, item)" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                {{ formatLabel(action.name) }}
              </button>
            </div>
          </div>
        </div>
        <hr class="mt-2" />
        
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Report',
  props: {
    items: {
      type: Array,
      required: true
    },
    headers: {
      type: Array,
      required: true
    },
    mobile_fields: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      isMobile: window.innerWidth < 768,
      activeMenuIndex: null
    }
  },
  methods: {
    handleResize() {
      this.isMobile = window.innerWidth < 768
    },
    filterInfoMobile(item) {
      const newObj = {};
      for (const prop in item) {
        if (this.mobile_fields.includes(prop)) {
          newObj[prop] = item[prop];
        }
      }
      return newObj;
    },
    formatLabel(key) {
      // Optionally format labels for mobile view, e.g., capitalize or add spaces
      return key.charAt(0).toUpperCase() + key.slice(1);
    },
    toggleMenu(index) {
      this.activeMenuIndex = this.activeMenuIndex === index ? null : index;
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

<style scoped>
/* Additional custom styles, if needed */
</style>
