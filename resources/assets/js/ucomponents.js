require('./bootstrap');

window.toastr = require('../vendors/js/extensions/toastr.min');
window.Vue = require('vue');

require('animate.css');


 Vue.component('modulos', require('./components/modulos/Modulo.vue'));
 // Vue.component('modulos', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#ucontenido'
});
