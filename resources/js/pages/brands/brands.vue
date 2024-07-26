
<template>
    <div class="brands">
  
      <Filter :filtersConfig="reportFilters" :actions="buttonActions" @filter="applyFilters" />
      <Spinner v-if="isLoading" />
      <Report v-if="!isLoading" :items="data_brands.brands" :mobile_fields="data_brands.mobile_fields" :headers="data_brands.headers" >
         <template #edit="{item }">
            <button @click="editBrand(item)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-edit text-1xl"></i> Edit</button>
          </template>
          <template #delete="{ item }">
            <button @click="deleteBrand(item)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2"><i class="fas fa-trash text-1xl"></i>  Delete</button>
          </template>
      </Report>

      <Pagination v-if="!isLoading" :pagination="request" @page-change="handlePageChange" />
    </div>
  </template>
  
  <script>
  import Report from "../../components/Report.vue"
  import Filter from '../../components/Filter.vue';
  import Spinner from "../../components/Spinner.vue";
  import Pagination from "../../components/Pagination.vue";

  export default {
    name: 'Brands',
    props:{
      setBreadcrumb:Function,
      setTitle:Function,
      breadcrumb:Array,
    },
    components:{
      Report,
      Filter,
      Spinner,
      Pagination,
    },
    data(){
      return({
        data_brands:{
          headers: ['ID', 'Name'],
          brands: [
            
          ],
          mobile_fields:['ID', 'Name']
        },
        reportFilters:{
          name: { type: 'text', label: 'Filter by Name' },
          category: { type: 'select', label: 'Filter by Category', options: [{value:'1', label:'Electronics'}, {value:'2', label:'Clothing'}, {value:'3', label:'Books'}] },
          
        },
        buttonActions:[
          {click:()=>this.crateBrand(),type:'button',label:'Add',class:'bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded',icon:'fas fa-plus'},
          {click:()=>alert('Export report'),type:'button',label:'Export',class:'bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded',icon:'fas fa-file-export'},

        ],
        isLoading:false,
        request:{
          urlLoadData:'/api/brands',
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
      crateBrand(){
        //this.$router.push({name:'CreateGrocery'})
        this.$router.push({name:'BrandCreate', params:{}})
      },
      editBrand(product) {        
        this.$router.push({name:'BrandEdit', params:{id:product.ID}})
      },
      deleteBrand(product) {
        console.log('Delete product', product);
      },
      async loadBrandData(){
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
            //current_page
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
                let {id, name} = item
                temp_data.push({ID:id, Name:name, actions: [{ name: 'edit' }, { name: 'delete' }]})
              })        
            }
            this.data_brands.brands=temp_data;


          }catch(e){

          }finally{
            this.isLoading=false;
          }
      },
      applyFilters(filters){
        this.filters = filters;

        this.loadBrandData()
      },
      handlePageChange(page) {
        this.request.urlLoadData = page; 
        this.loadBrandData();
      }

      
    },
    created(){
      this.setBreadcrumb(this.breadcrumb)
      this.loadBrandData()
      this.setTitle('Brand list')
    }
  };
  </script>
  
  <style scoped>
  .brands {
    text-align: center;
    margin-top: 20px;
  }
  </style>
  