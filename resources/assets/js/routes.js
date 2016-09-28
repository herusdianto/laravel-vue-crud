const router = new VueRouter();

router.map({
    '/': {
        name: 'index',
        component: require('./components/Index.vue')
    },
    '/show/:studentId': {
        name: 'show',
        component: require('./components/Show.vue')
    },
    '/create': {
        name: 'create',
        component: require('./components/Create.vue')
    },
});

var App = Vue.extend({});

router.start(App, '#app');
