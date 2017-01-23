
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router'
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
// Vue.component('example', require('./components/Example.vue'));
const routes = [
  	{ 
	  	path: '/Employee-Management', 
	  	name: 'emps',
	 	component: require('./components/employee/employee.vue')
	},
	{
		path: '/Officials',
		name: 'opisyal',
		component: require('./components/official/official.vue')
	}
]

window.router = new VueRouter({
  routes // short for routes: routes
});

const app = new Vue({
  	router
}).$mount('#app');

