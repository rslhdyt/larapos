
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueSweetalert2 from 'vue-sweetalert2';
import VeeValidate from 'vee-validate';

Vue.use(VueSweetalert2);
Vue.use(VeeValidate);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
Vue.component('delete-action', require('./components/DeleteAction.vue'));
Vue.component('restore-action', require('./components/RestoreAction.vue'));
Vue.component('form-receiving', require('./components/FormReceiving.vue'));

// setup axios interceptor
window.axios.interceptors.response.use(function (response) {
    // Do something before request is sent
    return response;
}, function (error) {

    if (error.response.status == 422) {
        let errorMessages = _.map(error.response.data.errors, err => {
            return err[0]
        });

        Vue.swal({
            title: 'Validation Failed!',
            html: errorMessages.join('<br>'),
            type: 'error',
        })
    } else if (error.response.status == 500) {
        Vue.swal({
            type: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
        })
    } else if (error.response.status == 401) {
        // window.location = '/login'
    }

    return Promise.reject(error.response);
});

/*
 * By extending the Vue prototype with a new '$bus' property
 * we can easily access our global event bus from any child component.
 */
Object.defineProperty(Vue.prototype, '$bus', {
    get() {
        return this.$root.bus;
    }
});

window.bus = new Vue({});

const app = new Vue({
    el: '#app',
    data() {
        return {
            bus: bus
        }
    }
});
