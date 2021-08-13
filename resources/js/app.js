require('./bootstrap');

import Vue from 'vue';

import App from './components/app';
import mainHeader from "./components/header/mainHeader";
import Switch from "./components/inputs/toggle";
import logoOnly from "./components/header/logoOnly";
import acessCard from "./components/acess/acessCard";

new Vue({
    el: '#app',
    components: {
        App,
        mainHeader,
        Switch,
        logoOnly,
        acessCard
    }
});
