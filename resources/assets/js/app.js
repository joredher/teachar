// import Vue from "vue"
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.toastr = require('../vendors/js/extensions/toastr.min');
window.Vue = require('vue');
require('vue-resource');
window.VeeValidate = require('vee-validate');
var es = require('vee-validate/dist/locale/es');
Vue.use(VeeValidate, {locale: 'es'});
Vue.use(VeeValidate);
window.VuePaginator = require('./paginado');
Vue.use(VuePaginator);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.getElementById("token").getAttribute("value");

Vue.http.interceptors.push((Request, next) => {
    next((response) => {
        if (response.status == 401){
            window.location.reload();
        }
    })
});

require('animate.css');
import swal from 'sweetalert';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.config.devtools = false;
Vue.config.debug = false;
Vue.config.silent = true;