const router = new VueRouter();

const index = require('./components/Index.vue');
const show = require('./components/Show.vue');

router.map({
    '/': {
        name: 'index',
        component: index
    },
    '/show/:studentId': {
        name: 'show',
        component: show
    }
});

var App = Vue.extend({});

router.start(App, '#app');
