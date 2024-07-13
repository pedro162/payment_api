<template>
    <div class="create max-w-7xl mx-auto p-8 bg-white shadow-md rounded-md mt-10 ">
        <h2 class="text-2xl font-semibold mb-6" >Add itens to gorcery list {{request.grocery_id}}</h2>
        <div v-if="isLoading != true && error != null && String(error).length > 0 " class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
          <span class="font-medium">Error!</span> {{error}}        
        </div>
        <div v-if="isLoading != true && msg_success != null && String(msg_success).length > 0 " class="p-4 mb-4 text-sm text-green-700 bg-red-100 rounded-lg" role="alert">
          <span class="font-medium">Error!</span> {{msg_success}}        
        </div>
        <form @submit.prevent="submitForm" >
            <!--<input type="hidden" name="_token" :value="form_data.csrfToken">-->
            <div class="mb-4">
                <label for="product" class="block text-gray-700 text-sm font-bold mb-2">Product</label>
                <input
                type="text"
                id="product"
                v-model="form_data.product"
                @input="searchProduct"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
                <ul v-if="suggestions.length" class="absolute bg-white border mt-1 rounded w-full">
                <li
                    v-for="suggestion in suggestions"
                    :key="suggestion.id"
                    @click="selectProduct(suggestion)"
                    class="p-2 cursor-pointer hover:bg-gray-200"
                >{{ suggestion.name }}</li>
                </ul>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                <input
                type="number"
                id="quantity"
                v-model="form_data.quantity"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                <input
                type="text"
                id="price"
                v-model="form_data.price"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>
            <div class="flex items-right justify-end">
                <button v-if="isLoading == true" type="button" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Saving...</button>
                <button v-else type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Save</button>
            </div>
        </form>
        <div class="mt-6">
            <h3 class="text-xl font-semibold mb-4">Items in Grocery List</h3>
        </div>
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

import { GROCERY_LIST_STORE, GROCERY_LIST_GET_ITEMS, GROCERY_LIST_GET_ONE } from '../../functions/endpoints';

import Report from "../../components/Report.vue"
import Spinner from "../../components/Spinner.vue";
import Pagination from "../../components/Pagination.vue";

export default {
    name:'GroceryItemCreate',
    props:{
      setBreadcrumb:Function,
      breadcrumb:Array,
      setTitle:Function,
    },
    components:{
      Report,
      Spinner,
      Pagination,        
    },
    data(){
        return({
            form_data:{
                //csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                name:'',
            },
            form_data_grocery:{
                //csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                name:'',
            },
            isLoading:false,
            error:null,
            msg_success:null,
            title:"Add itens to gorcery list",
            request:{
                urlLoadData:'',
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
                grocery_id:null,
            },
            items: [],
            suggestions: [],
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
              {click:()=>{this.createItem()},type:'button',label:'Add',class:'bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded',icon:'fas fa-plus'},
              {click:()=>alert('Export report'),type:'button',label:'Export',class:'bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded',icon:'fas fa-file-export'},

            ],
        })
    },
    methods:{
        async submitForm(){
            try{

                this.isLoading   = true;
                this.error       = null;
                this.msg_success = null;

                //let url = this.request.urlLoadData;
                let { url, options } = GROCERY_LIST_STORE({...this.form_data})
                let response = await fetch(url, options)
                response = await response.json()
                let {state, data} = response
                if(state == true && Number(data?.id) > 0){
                    this.$router.push({name:'Groceries'})
                    alert('Register successfully')
                    this.msg_success = "Register successfully"
                }else{
                    throw new Error(data)
                }
                
            }catch(e){
                this.error = e.message
            }finally{
                this.isLoading=false;
            }
        },
        searchProduct() {
            this.suggestions = [
                // Example suggestions
                { id: 1, name: 'Apple' },
                { id: 2, name: 'Banana' },
                { id: 3, name: 'Orange' },
            ];
        },
        selectProduct(suggestion) {
            this.form_data.product = suggestion.name;
            this.suggestions = [];
        },
        resetForm(){

        },
        editProduct(product) {
            this.$router.push({name:'EditGrocery', id:product})
        },
        deleteProduct(product) {
            console.log('Delete product', product);
        },
        async loadProductData(){
            try{

                this.isLoading = true;

                let {url, options} = GROCERY_LIST_GET_ITEMS(this.request.grocery_id, {});
                if(String(this.request.urlLoadData).length > 0){
                    url = this.request.urlLoadData+'&grocery_id='+this.request.grocery_id;
                }
                
                
                let response = await fetch(url, options)
          
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
                    temp_data.push({ID:id, Name:name, "Total Gross":total_gros_price, Discount:total_discount_amount, "Total Net":total_net_price, actions: [{ name: 'edit' }, { name: 'add_product' }, { name: 'delete' }]})
                  })        
                }
                this.data_products.products=temp_data;


            }catch(e){

            }finally{
                this.isLoading=false;
            }
        },
        async loadGrocryList(id){
            try{

                this.isLoading  = true;
                this.error      = null;
                if(Number(id) > 0){
                    let { url, options } = GROCERY_LIST_GET_ONE(id, {...this.form_data})
                    let response = await fetch(url, options)
                    response = await response.json()
                    let {state, data} = response
                    if(state == true && Number(data?.id) > 0){
                        this.form_data_grocery.name = data?.name;
                    }else{
                        throw new Error(data)
                    }
                }
                
            }catch(e){
                this.error = e.message
            }finally{
                this.isLoading=false;
            }
        },
        handlePageChange(page) {
            this.request.urlLoadData = page; 
            this.loadProductData();
        }
    },
    created(){
        this.request.grocery_id = this.$route.params.id;
        if(Number(this.request.grocery_id) > 0){
            this.title = `Edditing grocery list nº ${this.request.grocery_id}`
            this.loadGrocryList(this.request.grocery_id)
            this.loadProductData()
        }
        this.setBreadcrumb(this.breadcrumb)
        this.setTitle('New grocery list')
    }
}
</script>

<style scoped>
    .create{
    }
</style>