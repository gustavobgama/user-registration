
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Import ElementUI
 */
Vue.use(require('element-ui'));

/**
 * Import VueFormWizard
 */
Vue.use(require('vue-form-wizard'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import FormSteps from './components/FormSteps';

new Vue({
    el: '.main',
    components: {
        'form-steps': FormSteps,
    },
});