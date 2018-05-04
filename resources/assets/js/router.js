import VueRouter from 'vue-router';

let routes = [
    { path: '/home', component: require('./views/Home.vue') },
    { path: '/about', component: require('./views/About.vue') },
    { path: '/themes', component: require('./views/themes/ThemeIndex.vue') },
    { path: '/themes/create', component: require('./views/themes/CreateTheme.vue') },
    { path: '/events', component: require('./views/events/EventIndex.vue') },
    { path: '/events/create', component: require('./views/events/CreateEvent.vue') }
];

export default new VueRouter({
    routes,
    // To remove hashtag from urls
    //mode: 'history',
});