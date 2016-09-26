const router = new VueRouter();

const index = require('./components/Index.vue');

router.map({
    '/': {
        component: index
    }
});

var App = Vue.extend({});

router.start(App, '#app');
