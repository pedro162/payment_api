<template>
    <div class="create max-w-7xl mx-auto p-8 bg-white shadow-md rounded-md mt-10 ">
        <h2 class="text-2xl font-semibold mb-6" >New grocery list</h2>
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
import { GROCERY_LIST_STORE } from '../../functions/endpoints';
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
            request:{
                urlLoadData:'/api/groceries'
            }
        })
    },
    methods:{
        async submitForm(){
            try{

                this.isLoading = true;

                //let url = this.request.urlLoadData;
                let { url, options } = GROCERY_LIST_STORE({...this.form_data})
                let response = await fetch(url, options)
                response = await response.json()
                let {state, data} = response
                if(state == true && Number(data?.id) > 0){
                    this.$router.push({name:'Groceries'})
                    alert('Register successfully')
                }
            }catch(e){

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
        this.setBreadcrumb(this.breadcrumb)
        this.setTitle('New grocery list')
    }
}
</script>

<style scoped>
    .create{
    }
</style>