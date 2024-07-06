
<template>
    <div class="groceries">
  
      <Filter :filtersConfig="reportFilters"  :actions="buttonActions"  @filter="applyFilters" />
      <Spinner v-if="isLoading" />
      <Report v-if="!isLoading" :items="data_products.products" :mobile_fields="data_products.mobile_fields" :headers="data_products.headers" >
          <template #edit="{item }">
            <button @click="editProduct(item)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-edit text-1xl"></i> Edit</button>
          </template>
          <template #delete="{item}">
            <button @click="deleteProduct(item)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2"><i class="fas fa-trash text-1xl"></i>  Delete</button>
          </template>
      </Report>
      <Pagination v-if="!isLoading" :pagination="request" @page-change="handlePageChange"/>
    </div>
  </template>
  
  <script>

  import Report from "../../components/Report.vue"
  import Filter from '../../components/Filter.vue';
  import Spinner from "../../components/Spinner.vue";
  import Pagination from "../../components/Pagination.vue";

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
      Pagination,
    },
    data(){
      return({
        data_products:{
          headers: ['ID', 'Name', "Total Gross", "Discount", "Total Net"],
          products: [
            
          ],
          mobile_fields:['ID', 'Name', "Total Gross", "Discount", "Total Net"]
        },
        reportFilters:{
          name: { type: 'text', label: 'Filter by Name' },
          category: { type: 'select', label: 'Filter by Category', options: [{value:'1', label:'Electronics'}, {value:'2', label:'Clothing'}, {value:'3', label:'Books'}] },
          price: { type: 'text', label: 'Filter by Price' },
          date: { type: 'text', label: 'Filter by Date' },
        },
        buttonActions:[
          {click:()=>alert('Create new grocery'),type:'button',label:'Add',class:'bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded',icon:'fas fa-plus'},
          {click:()=>alert('Export report'),type:'button',label:'Export',class:'bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded',icon:'fas fa-file-export'},

        ],
        isLoading:false,
        request:{
          urlLoadData:'/api/groceries',
          current_page:null,
          first_page_url:null,
          from:null,
          last_page:null,
          last_page_url:null,
          links:null,
          next_page_url:null,
          path:null,
          per_page:null,
          to:null,
          total:null,
          path:null,
        },
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

            let url = this.request.urlLoadData;
            let response = await fetch(url, {
              method:'GET',
              headers:{
                "Access-Control-Allow-Origin":"*",
                'Content-Type': 'application/json',
              }
            })
      
            response = await response.json()
            
            let data = response?.data?.data;
            
            this.request.current_page = response?.data?.current_page;
            this.request.first_page_url = response?.data?.first_page_url;
            this.request.from = response?.data?.from;
            this.request.last_page = response?.data?.last_page;
            this.request.last_page_url = response?.data?.last_page_url;
            this.request.links = response?.data?.links;
            this.request.next_page_url = response?.data?.next_page_url;
            this.request.path = response?.data?.path;
            this.request.per_page = response?.data?.per_page;
            this.request.to = response?.data?.to;
            this.request.total = response?.data?.total;
            this.request.path = response?.data?.path;

            let temp_data = []
            if(data){
              data.forEach((item, index, arr)=>{
                let {id, name, total_gros_price, total_discount_amount,total_net_price,
                  created_at,
                 } = item
                //'ID', 'Name', "Total Gross", "Discount", "Total Net"
                temp_data.push({ID:id, Name:name, "Total Gross":total_gros_price, Discount:total_discount_amount, "Total Net":total_net_price, actions: [{ name: 'edit' }, { name: 'delete' }]})
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
      },
      handlePageChange(page) {
        this.request.urlLoadData = page; 
        this.loadProductData();
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
  