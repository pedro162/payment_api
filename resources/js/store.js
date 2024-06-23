// store.js

import Vue from 'vue';
import { createStore } from 'vuex';
Vue.use(Vuex);

const store =  createStore({
  state: {
    globalProperty: 'Valor global'
  },
  mutations: {
    updateGlobalProperty(state, newValue) {
      state.globalProperty = newValue;
    }
  },
  actions: {
    // Adicione ações se necessário
  },
  getters: {
    // Adicione getters se necessário
  }
});
export default store;
