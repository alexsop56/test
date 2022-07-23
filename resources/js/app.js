require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)

Vue.component('app', require('./App.vue').default);

require("./components");

import route from 'ziggy-js';

import { Ziggy } from './ziggy';
window.route = route;
window.Ziggy = Ziggy;
Vue.mixin({
    methods: {
        route,
    }
});

import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axios);

import Notifications from 'vue-notification'
Vue.use(Notifications)

const app = new Vue({
    el: '#app',
});