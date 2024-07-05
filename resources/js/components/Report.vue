<template>
    <div class="">
        <div v-if="!isMobile" class="overflow-x-out shadow rounded-lg border ">
            <table class="min-w-full bg-white" >
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th v-for="(header, index) in headers" :key="index" class="w-auto text-left py-3 px-4 uppercase font-semibold text-sm">{{ header }}</th>
                        <th class="w-auto text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" >
                    <tr v-for="(item, index) in items " :key="index" :class="{'bg-gray-50': index % 2 === 0}" >
                        <td v-for="(header, index) in headers" :key="index" class="w-auto text-lef py-3 px-4"  >{{item[header]}}</td>
                        <td class="flex w-auto text-left py-3 px-4">
                             <div v-for="(action, index) in item.actions" :key="index">
                                <slot :name="action.name" :item="item"></slot>
                            </div>
                        </td>
                    </tr>
            
                </tbody>
            </table>
        </div>

        <!-- Lista para Mobile -->
        <div v-else class="space-y-4">
            <div v-for="(item, index) in items" :key="index" class="bg-white p-4 rounded-lg shadow-md">
                <div v-for="(value, key, index) in filterInfoMobile(item)" :key="index" class="flex justify-between">
                    <span class="font-semibold">{{ key }}:</span>
                    <span>{{ value }}</span>
                </div>
                <div class="mt-2 flex justify-end space-x-2">
                <div v-for="(action, index) in item.actions" :key="index">
                    <slot :name="action.name" :item="item"></slot>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script >

export default{
    name:'Report',
    props:{
        items:{
            type:Array,
            required:true
        },
        headers:{
            type:Array,
            required:true
        },
        mobile_fields:{
            type:Array,
            required:true
        }
    },
    components:{
        
    },
    data(){
        return{
            isMobile: window.innerWidth < 768
        }
    },
    methods:{
        handleResize(){
            this.isMobile = window.innerWidth < 768
        },
        filterInfoMobile(item){
            let newObj = {}
            for(let prop in item){
                if((this.mobile_fields && this.mobile_fields.indexOf(prop) > -1)){
                    newObj[prop]=item[prop]
                }
            }    

            return newObj;
        }
    },
    mounted(){
        window.addEventListener('resize', this.handleResize)
        this.handleResize();
    },
    beforeUnmount(){
        window.removeEventListener('resize', this.handleResize);
    }
}
</script> 