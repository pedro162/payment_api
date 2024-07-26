<template>
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4" >Settings</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-gray-100 rounded-lg shadow-md ">
                <h3 class="text-xl font-semibold mb-4" >User Settings</h3>
                <ul>
                    <li class="mb-2">
                        <router-link to="/settings/profile" class="text-blue-500 hover:underline" >Profile</router-link>
                    </li>
                    <li class="mb-2">
                        <router-link to="/settings/privacy" class="text-blue-500 hover:underline">Privacy</router-link>
                    </li>
                    <li class="mb-2">
                        <router-link to="/settings/account" class="text-blue-500 hover:underline">Account</router-link>
                    </li>
                    <li class="mb-2">
                        <router-link to="/settings/users" class="text-blue-500 hover:underline">Users</router-link>
                    </li>
                </ul>
            </div>

            <div class="p-6 bg-gray-100 rounded-lg shadow-md ">
                <h3 class="text-xl font-semibold mb-4" >System settings</h3>
                <ul>
                    <li class="mb-2">
                        <router-link to="/settings/preferences" class="text-blue-500 hover:underline" >Preferences</router-link>
                    </li>
                    <li class="mb-2">
                        <router-link to="/settings/language" class="text-blue-500 hover:underline" >Language</router-link>
                    </li>
                    <li class="mb-2">
                        <router-link to="/settings/themes" class="text-blue-500 hover:underline" >Themes</router-link>
                    </li>
                </ul>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow-md ">
                <h3 class="text-xl font-semibold mb-4" >Other Settings</h3>
                <ul>
                    <li class="mb-2">
                        <router-link to="/brands" class="text-blue-500 hover:underline">Brands</router-link>
                    </li>
                    <li class="mb-2">
                        <router-link to="/categories" class="text-blue-500 hover:underline">Categories</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'Settings',
    props:{
        setBreadcrumb:Function,
        setTitle:Function,
        breadcrumb:Array,
    },
    components:{

    },
    data(){
        return({

        })
    },
    methods:{

    },
    created(){
        this.setBreadcrumb(this.breadcrumb)
        this.setTitle('Settings')
    },
}
</script>

<style scoped >
.settings {
  text-align: center;
  margin-top: 20px;
}
</style>