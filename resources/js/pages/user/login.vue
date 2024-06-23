

<template>
  <!-- eslint-disable vue/no-v-html https://tailwindcss.com/docs/width-->

  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
      <h1 class="text-2xl font-bold mb-6 text-center">Login Page</h1>
        <form @submit.prevent="login">
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700" >Username:</label>
            <input type="text" v-model="username" id="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700" >Password:</label>
            <input type="password" v-model="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>
        <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-600" >Login</button>
        </form>
    </div>

  </div>
</template>

<script>
//https://play.google.com/store/apps/details?id=br.com.ridsoftware.shoppinglist&hl=pt_BR
export default {
  name: 'Login',
  data() {
    return {
      username: '',
      password: '',
      form:{
        password:'',
        email:'',
        remember:false,
      }
    };
  },
  methods: {
    login() {
      // Aqui você pode adicionar a lógica de autenticação.
      if (this.username === 'user' && this.password === 'password') {
        this.$router.push({ name: 'Home' });
      } else {
        alert('Credenciais inválidas!');
      }
    }
  }
};

</script>
<style scoped>
.login {
  max-width: 300px;
  margin: 0 auto;
  padding: 1em;
  background-color: #f7f7f7;
  border-radius: 5px;
}
</style>
