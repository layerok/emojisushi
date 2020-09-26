window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import Vue from 'vue';
import router from './router.js';


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

import Vuex from 'vuex';
window.Vuex = Vuex;
Vue.use(Vuex);

import VueRouter from 'vue-router'
Vue.use(VueRouter)

const App = () => import('./views/App')


Vue.component('sumoist-cart', require('./components/Cart').default);
Vue.component('sumoist-cart-pop-up', require('./components/CartPopUp').default);

Vue.component('products-list', require('./components/ProductsList.vue').default);
Vue.component('sumoist-header', require('./components/layout/header').default);
Vue.component('sumoist-footer', require('./components/layout/footer').default);
Vue.component('sumoist-nav', require('./components/layout/nav').default);
Vue.component('sumoist-slider', require('./components/layout/slider').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import storeConf from './store.js';

const store = new Vuex.Store(storeConf)
import VueCarousel from 'vue-carousel';
Vue.use(VueCarousel);

router.beforeEach((to, from, next) => {

    if(to.params.hasOwnProperty('spot') && to.name !== 'home' &&  to.name !== 'thankyou') {

        axios
            .get('/api/spots/getOne/'+ to.params.spot)
            .then(response => {

                if(response.data.length > 0){

                    if(store.state.currentSpot === null || store.state.currentSpot.slug !== response.data[0]['slug']){
                        store.commit('setCurrentSpot', response.data[0]);
                    }

                    next();
                }else{
                    next({name: 'home'})
                }

            }).catch(error => {

        });
    }else{
        if(to.name !== 'home'){
            next({name: 'home'})
        }else{
            next();
        }

    }

})



const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store,
});


