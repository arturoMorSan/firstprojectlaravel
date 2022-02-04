import slugify from './helpers/slugify.js';
import hammer from './vendor/hammer.js';
window.Vue = require('vue');
window.axios = require('axios');

(function() {
    document.documentElement.classList.remove('no-js');
    document.documentElement.classList.add('js');


    /*
    |---------------------------------------------------------------------------
    | Hammer
    |---------------------------------------------------------------------------
    */
    window.hammer = hammer;

    /*
    |---------------------------------------------------------------------------
    | Axios headers
    |---------------------------------------------------------------------------
    */

    /*const token = document.head.querySelector('meta[name="csrf-token"]');

    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;*/


    /*
    |---------------------------------------------------------------------------
    | Vue configuration
    |---------------------------------------------------------------------------
    */

    Vue.config.productionTip = false;

    Vue.filter('slugify', slugify);

     /*
    |---------------------------------------------------------------------------
    | Vue directives
    |---------------------------------------------------------------------------
    */

    Vue.directive('swipeleft', {
        bind: function(el, binding) {
            if (typeof binding.value === 'function') {
                const hammer = new window.Hammer(el);
                hammer.on('swipeleft', binding.value);
            }
        }
    });

    Vue.directive('swiperight', {
        bind: function(el, binding) {
            if (typeof binding.value === 'function') {
                const hammer = new window.Hammer(el);
                hammer.on('swiperight', binding.value);
            }
        }
    });

    /*
    |---------------------------------------------------------------------------
    | Sweet Alert defaults
    |---------------------------------------------------------------------------
    */

    window.swal = window.swal.mixin({
        cancelButtonColor  : '#bbb',
        cancelButtonText   : 'Cancelar',
        confirmButtonColor : '#20c372',
        confirmButtonText  : 'Aceptar'
    });
})();
