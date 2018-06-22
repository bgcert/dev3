import VueRouter from 'vue-router';

let routes = [
    { path: '/home', component: require('./views/Home.vue') },
    { path: '/about', component: require('./views/About.vue') },

    // Profile routes
    { path: '/profile', component: require('./views/profile/Profile.vue') },

    // Notification routes
    { path: '/notifications', component: require('./views/notifications/Index.vue') },

    // Theme routes
    { path: '/themes', component: require('./views/themes/ThemeIndex.vue') },
    { path: '/themes/create', component: require('./views/themes/CreateTheme.vue') },
    { path: '/themes/edit/:id', component: require('./views/themes/EditTheme.vue') },

    // Teacher routes
    { path: '/teachers', component: require('./views/teachers/TeacherIndex.vue') },
    { path: '/teachers/create', component: require('./views/teachers/CreateTeacher.vue') },
    { path: '/teachers/edit/:id', component: require('./views/teachers/EditTeacher.vue') },

    // Event routes
    { path: '/events', component: require('./views/events/EventIndex.vue') },
    { path: '/events/create', component: require('./views/events/CreateEvent.vue') },
    { path: '/events/edit/:id', component: require('./views/events/EditEvent.vue') },

    // Order routes
    { path: '/orders', component: require('./views/orders/Index.vue') },
    { path: '/orders/:id', component: require('./views/orders/View.vue') },
    { path: '/orders/create', component: require('./views/orders/Create.vue') },
    { path: '/orders/edit/:id', component: require('./views/orders/Edit.vue') },

    // Settings routes
    { path: '/account/', component: require('./views/settings/Account.vue') },
    { path: '/change-pass', component: require('./views/settings/ChangePassword.vue') },
    { path: '/change-email', component: require('./views/settings/ChangeEmail.vue') },
    { path: '/deactivate', component: require('./views/settings/Deactivate.vue') },

    // Messanger
    { path: '/t/:id?', component: require('./views/messanger/Index.vue') },

    //{ path: '/t/:id', component: require('./views/messanger/Index.vue') },
];

export default new VueRouter({
    routes,
    // To remove hashtag from urls
    //mode: 'history',
});