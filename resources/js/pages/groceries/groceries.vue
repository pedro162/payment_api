
<template>
    <div class="groceries">
  
      <Filter :filtersConfig="reportFilters" @filter="applyFilters" />
      <Spinner v-if="isLoading" />
      <Report v-if="!isLoading" :items="data_products.products" :mobile_fields="data_products.mobile_fields" :headers="data_products.headers" >
         <template #edit="{item }">
            <button @click="editProduct(item)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-edit text-1xl"></i> Edit</button>
          </template>
          <template #delete="{ item }">
            <button @click="deleteProduct(item)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2"><i class="fas fa-trash text-1xl"></i>  Delete</button>
          </template>
      </Report>
    </div>
  </template>
  
  <script>
  import Report from "../../components/Report.vue"
  import Filter from '../../components/Filter.vue';
  import Spinner from "../../components/Spinner.vue";

  export default {
    name: 'Groceries',
    props:{
      setBreadcrumb:Function,
      breadcrumb:Array,
      setTitle:Function,
    },
    components:{
      Report,
      Filter,
      Spinner,
    },
    data(){
      return({
        data_products:{
          headers: ['ID', 'Name', "Category", "Brand"],
          products: [
            
          ],
          mobile_fields:['ID', 'Name', "Category", "Brand"]
        },
        reportFilters:{
          name: { type: 'text', label: 'Filter by Name' },
          category: { type: 'select', label: 'Filter by Category', options: [{value:'1', label:'Electronics'}, {value:'2', label:'Clothing'}, {value:'3', label:'Books'}] },
          price: { type: 'text', label: 'Filter by Price' },
          date: { type: 'text', label: 'Filter by Date' },
        },
        isLoading:false,
      })
    },
    methods:{
      editProduct(product) {
        console.log('Edit product', product);
      },
      deleteProduct(product) {
        console.log('Delete product', product);
      },
      async loadProductData(){
        try{

            this.isLoading = true;

            let url = "/api/products"
            let response = await fetch(url, {
              method:'GET',
              headers:{
                "Access-Control-Allow-Origin":"*",
                'Content-Type': 'application/json',
              }
            })
      
            response = await response.json()
            let data = response?.data
            let temp_data = []
            if(data){
              data.forEach((item, index, arr)=>{
                let {id, name} = item
                temp_data.push({ID:id, Name:name, Category:'Test Category', Brand:'Test brand',  actions: [{ name: 'edit' }, { name: 'delete' }]})
              })        
            }
            this.data_products.products=temp_data;


          }catch(e){

          }finally{
            this.isLoading=false;
          }
      },
      applyFilters(filters){
        this.filters = filters;

        this.loadProductData()
      }

      
    },
    created(){
      this.setBreadcrumb(this.breadcrumb)
      this.loadProductData()
      this.setTitle('Grocery lists')
    }
  };
  </script>
  
  <style scoped>
  .groceries {
    text-align: center;
    margin-top: 20px;
  }
  </style>
  