
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../bootstrap');

window.Vue = require('vue');

import * as uiv from 'uiv'
import ToggleButton from 'vue-js-toggle-button'


window.Vue.use(uiv, {prefix: 'uiv'});

window.Vue.use(ToggleButton);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('pagination', require('../Pagination.vue').default);
Vue.component('error-block', require('../ErrorFormGroupBlock.vue').default);
Vue.component('delete-button', require('../DeleteButton.vue').default);

Vue.component('place-table', require('./Table.vue').default);

Vue.component('place-row', require('./Row.vue').default);
Vue.component('place-edit', require('./Edit.vue').default);

