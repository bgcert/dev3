
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

window.flash = (message, type) => {
	EventBus.$emit('flash', message, type);
}

window.auth = { auth: '{{ auth()->check() }}' }

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/bg'

Vue.use(ElementUI, { locale })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('flash', require('./components/FlashComponent.vue'));
Vue.component('follow', require('./components/FollowComponent.vue'));
Vue.component('like', require('./components/LikeComponent.vue'));
Vue.component('event-feed', require('./components/EventFeedComponent.vue'));
Vue.component('event-box', require('./components/EventBoxComponent.vue'));
Vue.component('box-hover', require('./components/BoxHoverComponent.vue'));
Vue.component('request-modal', require('./components/RequestModalComponent.vue'));

Vue.component('comments', require('./components/CommentsComponent.vue'));

const app = new Vue({
    el: '#app'
});
