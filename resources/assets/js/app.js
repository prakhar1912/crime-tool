
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Crimes from './components/Crimes.vue';
import Users from './components/Users.vue';
import Stations from './components/Stations.vue';

new Vue({
	el: '#app',
	components:{Crimes,Users,Stations},
	data(){
		return {
		}
	}
});