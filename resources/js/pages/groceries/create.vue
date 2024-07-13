<template>
    <div class="create max-w-7xl mx-auto p-8 bg-white shadow-md rounded-md mt-10 ">
        <h2 class="text-2xl font-semibold mb-6" >{{title}}</h2>
        
        <div v-if="isLoading != true && error != null && String(error).length > 0 " class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
          <span class="font-medium">Error!</span> {{error}}        
        </div>

        <div v-if="isLoading != true && msg_success != null && String(msg_success).length > 0 " class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
          <span class="font-medium">Success!</span> {{msg_success}}        
        </div>

        <form @submit.prevent="submitForm" >
            <!--<input type="hidden" name="_token" :value="form_data.csrfToken">-->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2"  >Name</label>
                <input
                    type="text"
                    id="name"
                    v-model="form_data.name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required
                />
            </div>
            <div class="flex items-right justify-end">
                <button v-if="isLoading == true" type="button" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Saving...</button>
                <button v-else type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Save</button>
            </div>
        </form>
    </div>
</template>
<script>
import { GROCERY_LIST_STORE, GROCERY_LIST_UPDATE, GROCERY_LIST_GET_ONE} from '../../functions/endpoints';
export default {
    name:'GroceryCreate',
    props:{
      setBreadcrumb:Function,
      breadcrumb:Array,
      setTitle:Function,
    },
    components:{
        
    },
    data(){
        return({
            form_data:{
                //csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                name:'',
            },
            isLoading:false,
            error:null,
            msg_success:null,
            title:"New grocery list",
            request:{
                grocery_id:null
            }
        })
    },
    methods:{
        async submitForm(){
            try{

                this.isLoading  = true;
                this.error      = null;
                let url, options;
                if(Number(this.request?.grocery_id) > 0){
                    
                    let config = GROCERY_LIST_UPDATE(this.request?.grocery_id, {...this.form_data})
                    url = config?.url
                    options = config?.options;
                }else{
                    let config = GROCERY_LIST_STORE({...this.form_data})
                    url = config?.url
                    options = config?.options;
                }
                let response = await fetch(url, options)
                response = await response.json()
                let {state, data} = response
                if(state == true && Number(data?.id) > 0){
                    this.isLoading=false;
                    this.msg_success = "Register successfully"
                    //alert('Register successfully')
                    setTimeout(()=>{
                        this.$router.push({name:'Groceries'})
                    }, 1000)
                    
                }else{
                    throw new Error(data)
                }
            }catch(e){
                this.error = e.message
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
                        this.form_data.name = data?.name;
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
        resetForm(){

        },
        addItem() {
            this.form_data.items.push('');
        },
        removeItem(index) {
            this.form_data.items.splice(index, 1);
        },
    },
    created(){
        this.request.grocery_id = this.$route.params.id;
        if(Number(this.request.grocery_id) > 0){
            this.title = `Edditing grocery list nº ${this.request.grocery_id}`
            this.loadGrocryList(this.request.grocery_id)
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