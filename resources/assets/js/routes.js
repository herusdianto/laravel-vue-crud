const router = new VueRouter();

router.map({
    '/': {
        name: 'index',
        component: require('./components/Index.vue')
    },
    '/create': {
        name: 'create',
        component: require('./components/Create.vue')
    },
    '/show/:studentId': {
        name: 'show',
        component: require('./components/Show.vue')
    },
    '/edit/:studentId': {
        name: 'edit',
        component: require('./components/Edit.vue')
    },
});

var App = Vue.extend({});

router.start(App, '#app');
