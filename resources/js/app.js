require('./bootstrap');

import Vue from 'vue';

import App from './components/app';
import mainHeader from "./components/header/mainHeader";

new Vue({
    el: '#app',
    components: {
        App,
        mainHeader
    }
});
