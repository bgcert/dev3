
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

window.auth = { auth: '{{ auth()->check() }}' }

import router from './router.js' // Importing routes
import StoreData from './store';

import VueRouter from 'vue-router'
import Vuex from 'vuex';

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/bg'

Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(StoreData);

Vue.use(ElementUI, { locale });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/FlashComponent.vue'));
//Vue.component('follow', require('./components/FollowComponent.vue'));
Vue.component('carousel', require('./components/CarouselComponent.vue'));
Vue.component('event-feed', require('./components/EventFeedComponent.vue'));
Vue.component('venue-feed', require('./components/VenueFeedComponent.vue'));
Vue.component('venue-slider', require('./components/VenueSliderComponent.vue'));
Vue.component('related-feed', require('./components/RelatedFeedComponent.vue'));
//Vue.component('event-box', require('./components/EventBoxComponent.vue'));
Vue.component('theme-box', require('./components/ThemeBoxComponent.vue'));
Vue.component('request-modal', require('./components/RequestModalComponent.vue'));
Vue.component('company-view', require('./components/CompanyViewComponent.vue'));
Vue.component('imageUpload', require('./components/ImageUploadComponent.vue'));

Vue.component('comments', require('./components/CommentsComponent.vue'));

Vue.component('google-map', require('./components/GoogleMapComponent.vue'));

// Auth
Vue.component('login', require('./components/auth/LoginComponent.vue'));
Vue.component('register', require('./components/auth/RegisterComponent.vue'));

// Settings
Vue.component('settings', require('./components/SettingsComponent.vue'));

// Dashboard
Vue.component('dashboard', require('./components/DashboardComponent.vue'));

// Messanger
Vue.component('messanger', require('./components/MessangerComponent.vue'));
//Vue.component('new-message', require('./components/NewMessageComponent.vue'));
//Vue.component('messanger-app', require('./components/messanger/MessangerAppComponent.vue'));

const app = new Vue({
    el: '#app',

    router,
    store
});
