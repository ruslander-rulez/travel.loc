
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../bootstrap');

window.Vue = require('vue');

import * as uiv from 'uiv'
import ToggleButton from 'vue-js-toggle-button'

window.Vue.directive('click-outside', {
    bind: function(el, binding, vNode) {
        // Provided expression must evaluate to a function.
        if (typeof binding.value !== 'function') {
            const compName = vNode.context.name
            let warn = `[Vue-click-outside:] provided expression '${binding.expression}' is not a function, but has to be`
            if (compName) { warn += `Found in component '${compName}'` }

            console.warn(warn)
        }
        // Define Handler and cache it on the element
        const bubble = binding.modifiers.bubble
        const handler = (e) => {
            if (bubble || (!el.contains(e.target) && el !== e.target)) {
                binding.value(e)
            }
        }
        el.__vueClickOutside__ = handler

        // add Event Listeners
        document.addEventListener('click', handler)
    },

    unbind: function(el, binding) {
        // Remove Event Listeners
        document.removeEventListener('click', el.__vueClickOutside__)
        el.__vueClickOutside__ = null

    }
})

window.Vue.use(uiv, {prefix: 'uiv'});

window.Vue.use(ToggleButton);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('range-datepicker', require('../RangePicker.vue').default);

Vue.component('pagination', require('../Pagination.vue').default);
Vue.component('error-block', require('../ErrorFormGroupBlock.vue').default);
Vue.component('delete-button', require('../DeleteButton.vue').default);
Vue.component('color-picker', require('../ColorPicker.vue').default);

Vue.component('book-table', require('./Table.vue').default);
Vue.component('ship-select', require('./ShipSelect.vue').default);
Vue.component('place-select', require('./PlaceSelect.vue').default);
Vue.component('restaurant-select', require('./RestaurantSelect.vue').default);
Vue.component('hotel-select', require('./HotelSelect.vue').default);
Vue.component('download-center', require('./DownloadCenter.vue').default);

Vue.component('book-row', require('./Row.vue').default);
Vue.component('book-edit', require('./Edit.vue').default);
Vue.component('edit-program-row', require('./EditProgramRow.vue').default);
Vue.component('client-edit', require('../client/Edit.vue').default);
Vue.component('color-edit', require('./EditColor.vue').default);

Vue.component('program_view_row', require('./ProgramViewRow.vue').default);




