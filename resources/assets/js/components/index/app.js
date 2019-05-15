
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

Vue.component('error-block', require('../ErrorFormGroupBlock.vue').default);

Vue.component('new-tourist', require('../booking/NewTourist.vue').default);
Vue.component('ship-select', require('../booking/ShipSelect.vue').default);
Vue.component('download-center', require('../booking/DownloadCenter.vue').default);

Vue.component('booking-edit', require('../booking/Edit.vue').default);
Vue.component('client-edit', require('../client/Edit.vue').default);


Vue.component('index-page', require('./Index.vue').default);
Vue.component('booking-row', require('./BookingRow.vue').default);


