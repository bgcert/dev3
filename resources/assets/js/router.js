import VueRouter from 'vue-router';

let routes = [
    { path: '/home', component: require('./views/Home.vue') },
    { path: '/about', component: require('./views/About.vue') },

    // Profile routes
    { path: '/profile', component: require('./views/profile/Profile.vue') },

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

    // Event routes
    { path: '/venues', component: require('./views/venues/VenueIndex.vue') },
    { path: '/venues/create', component: require('./views/venues/CreateVenue.vue') },
    { path: '/venues/edit/:id', component: require('./views/venues/EditVenue.vue') },

    // Order routes
    { path: '/orders', component: require('./views/orders/Index.vue') },
    { path: '/orders/:id', component: require('./views/orders/View.vue') },
    { path: '/orders/create', component: require('./views/orders/Create.vue') },
    { path: '/orders/edit/:id', component: require('./views/orders/Edit.vue') },

    // Account routes
    { path: '/notifications', component: require('./views/account/Notifications.vue') },
    { path: '/settings/', component: require('./views/account/Settings.vue') },
    { path: '/change-pass', component: require('./views/account/ChangePassword.vue') },
    { path: '/change-email', component: require('./views/account/ChangeEmail.vue') },
    { path: '/deactivate', component: require('./views/account/Deactivate.vue') },

    // Messanger
    { path: '/t/:id?', component: require('./views/messanger/Index.vue') },
];

export default new VueRouter({
    routes,
    // To remove hashtag from urls
    //mode: 'history',
});