
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
BootstrapVue = require('bootstrap-vue');
flatPickr = require('vue-flatpickr-component');

Vue.use(BootstrapVue);
Vue.use(flatPickr);

/**
 * Global filters
 */
Vue.filter('capitalize', function (value) {
  if (!value) return ''
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component('v-select', require('vue-select'));
Vue.component('topnav', require('./components/Topnav.vue'));
Vue.component('expenses-list', require('./components/ExpensesList.vue'));
Vue.component('budget-categories', require('./components/BudgetCategories.vue'));

const app = new Vue({
    el: '#app'
});
