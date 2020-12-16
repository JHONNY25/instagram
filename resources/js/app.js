require('./bootstrap');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import VueMoment from 'vue-moment'
import moment from 'moment-timezone'
import { InertiaProgress } from '@inertiajs/progress'
import NProgress from 'nprogress'

moment.locale('es');

Vue.use(VueMoment, {
    moment,
});
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
const app = document.getElementById('app');

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 500,
  
    // The color of the progress bar.
    color: '#1c64f2',
  
    // Whether to include the default NProgress styles.
    includeCSS: true,
  
    // Whether the NProgress spinner will be shown.
    showSpinner: true,
})

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        })
}).$mount(app);
