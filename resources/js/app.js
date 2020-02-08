
import Vue from 'vue'

require('./bootstrap');


window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import routes from './routes.js'
const router = new VueRouter({
  // mode: 'history',
  routes
});

// Vue.component('spinner', require('vue-simple-spinner'));
import BootstrapVue from 'bootstrap-vue' //Importing
Vue.use(BootstrapVue) // Telling Vue to use this in whole application

import  BootstrapVueIcons from 'bootstrap-vue'
Vue.use(BootstrapVueIcons)
// Vue.component('BIconArrowUp', BIconArrowUp)


import App from './App.vue';

new Vue({
  router,
  render: h=> h(App)
}).$mount('#app')

// Vue.component('app-component', require('./components/App.vue').default);
// Vue.component('navbar', require('./components/navbar.vue').default);
// Vue.component('autocomplete', require('./components/autocomplete.vue').default);
//
//
// const app = new Vue({
//   // router,
//     el: '#app'
// });
