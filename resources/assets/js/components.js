const Vuetable = require('vuetable/src/components/Vuetable.vue');
const VuetablePagination = require('vuetable/src/components/VuetablePagination.vue');
const VuetablePaginationDropdown = require('vuetable/src/components/VuetablePaginationDropdown.vue');

const VuestrapDatepicker = require('vue-strap').datepicker;

const Actions = require('./components/Actions.vue');
const ImageInput = require('./components/ImageInput.vue');
const CRUDForm = require('./components/CRUDForm.vue');

Vue.component('vuetable', Vuetable);
Vue.component('vuetable-pagination', VuetablePagination);
Vue.component('vuetable-pagination-dropdown', VuetablePaginationDropdown);

Vue.component('datepicker', VuestrapDatepicker);

Vue.component('actions', Actions);
Vue.component('image-input', ImageInput);
Vue.component('crud-form', CRUDForm);