
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
* Initialize event bus
*/
export const EventBus = new Vue();

// Need to be checked!
window.flash = (message, type) => {
	EventBus.$emit('flash', message, type);
}

import router from './router.js' // Importing routes
import StoreData from './store';

import VueRouter from 'vue-router'
import Vuex from 'vuex';

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/bg'

import Ion from 'ion-sound'

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Ion);
const store = new Vuex.Store(StoreData);

Vue.use(ElementUI);

Vue.prototype.$storagePath = '/storage/photos/';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/FlashComponent.vue'));
Vue.component('carousel', require('./components/CarouselComponent.vue'));
Vue.component('category-menu', require('./components/CategoryMenuComponent.vue'));
Vue.component('event-feed', require('./components/EventFeedComponent.vue'));
Vue.component('venue-feed', require('./components/VenueFeedComponent.vue'));
Vue.component('venue-slider', require('./components/VenueSliderComponent.vue'));
Vue.component('related-feed', require('./components/RelatedFeedComponent.vue'));
Vue.component('theme-box', require('./components/ThemeBoxComponent.vue'));
Vue.component('request-modal', require('./components/RequestModalComponent.vue'));
Vue.component('company-view', require('./components/CompanyViewComponent.vue'));
Vue.component('comments', require('./components/CommentsComponent.vue'));
Vue.component('notifications', require('./components/NotificationsComponent.vue'));
Vue.component('modal', require('./components/ModalComponent.vue'));
Vue.component('search', require('./components/SearchComponent.vue'));
Vue.component('multi-image-upload', require('./components/MultiImageUploadComponent.vue'));
Vue.component('image-upload', require('./components/ImageUploadComponent.vue'));
Vue.component('captcha', require('./components/CaptchaComponent.vue'));

// Vue.component('google-map', require('./components/GoogleMapComponent.vue'));

// Auth
Vue.component('login', require('./components/auth/LoginComponent.vue'));
Vue.component('register', require('./components/auth/RegisterComponent.vue'));
Vue.component('login-modal', require('./components/auth/LoginModalComponent.vue'));
Vue.component('register-modal', require('./components/auth/RegisterModalComponent.vue'));

// Account
Vue.component('account', require('./components/AccountComponent.vue'));

// Dashboard
Vue.component('dashboard', require('./components/DashboardComponent.vue'));

// Messanger
Vue.component('messanger', require('./components/MessangerComponent.vue'));

const app = new Vue({
    el: '#app',
    router,
    store
});
