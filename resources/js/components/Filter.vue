<template>
    <div class="mb-4 p-4 bg-white shadow rounded-lg">
        <div class="flex items-center justify-between border-b "  @click="toggleFilter" >
            <h3 class="text-lg font-bold mb-2 text-left" >Filters: </h3>
            <button type="button" class="text-blue-500 hover:text-blue-700" >
                <i v-if="!filterVisible" class="fas fa-chevron-up"></i>
                <i v-else class="fas fa-chevron-down" ></i>
            </button>
        </div>
        <div v-if="filterVisible" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 mt-5">
            <template v-for="(filter, key) in filtersConfig" :key="key" >
                <template v-if="filter.type=='text'">
                    <input
                        v-model="filters[key]"
                        type="text"
                        :placeholder="filter.label"
                        class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring focus:border-blue-300"
                    />
                </template>
                <template v-if="filter.type == 'select'"  >
                    <select 
                        v-model="filters[key]"
                        placeholder="filter.label"
                        class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring focus:border-blue-300"
                    >
                        <option value="" >{{ filter.label }}</option>
                        <option v-for="option in filter.options" :key="option.value" :value="option.value"  >{{option.label}}</option>
                    </select>
                </template>
            </template>    
            <button
                @click="applyFilters"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                <i class="fas fa-filter"></i>
                Apply
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name:'Filter',
    props:{
        filtersConfig:{
            type:Object,
            required:true,
        }
    },
    data(){
        const initialFilters = {}
        Object.keys(this.filtersConfig).forEach(key=>{
            initialFilters[key] = '';
        })

        return {
            filters:{...initialFilters},
            filterVisible:false
        }
    },
    methods:{
        applyFilters(){
            this.$emit('filter', {...this.filters})
        },
        toggleFilter(){
            this.filterVisible = !this.filterVisible
        }
    }
}
</script>