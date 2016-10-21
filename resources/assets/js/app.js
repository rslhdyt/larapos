
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('sales', require('./components/Sales.vue'));
Vue.component('recieving', require('./components/Recieving.vue'));


Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next((response) => {
        if (response.status == 400) {
            const message = response.body;

            $.notify(message.errors.join('<br/>'), {
                type: 'warning',
                placement: {
                    from: 'bottom'
                }
            });
        }
    });
});

const app = new Vue({
    el: 'body'
});


