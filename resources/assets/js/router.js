import VueRouter from 'vue-router';

let routes = [
    { path: '/home', component: require('./views/Home.vue') },
    { path: '/about', component: require('./views/About.vue') },
    { path: '/themes', component: require('./views/themes/ThemeIndex.vue') },
    { path: '/themes/create', component: require('./views/themes/CreateTheme.vue') },
    { path: '/events', component: require('./views/events/EventIndex.vue') },
    { path: '/events/create', component: require('./views/events/CreateEvent.vue') },

    // Settings routes
    { path: '/account', component: require('./views/settings/Account.vue') },
    { path: '/change-pass', component: require('./views/settings/ChangePassword.vue') },
    { path: '/change-email', component: require('./views/settings/ChangeEmail.vue') },
    { path: '/deactivate', component: require('./views/settings/Deactivate.vue') },
];

export default new VueRouter({
    routes,
    // To remove hashtag from urls
    //mode: 'history',
});