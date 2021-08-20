require('./bootstrap');

import Vue from 'vue';

import App from './components/app';
import mainHeader from "./components/header/mainHeader";
import Switch from "./components/inputs/toggle";
import logoOnly from "./components/header/logoOnly";
import accessCard from "./components/access/accessCard";
import registerStep2 from "./components/access/registerStep2";
import Vuelidate from "vuelidate";
import VuelidateErrorExtractor, { templates } from "vuelidate-error-extractor";

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const options = {
    timeout: 5000,
    hideProgressBar: true,
    maxToasts: 1,
    toastClassName: "tutti-toast",
};


Vue.use(Toast, options);
Vue.use(Vuelidate);
Vue.use(VuelidateErrorExtractor, {
    messages: { required: "The {attribute} field is required" },
    attributes: {
        email: "Email"
    }
})

Vue.component('formWrapper', templates.FormWrapper);
Vue.component('formSummary', templates.multiErrorExtractor.foundation6);

new Vue({
    el: '#app',
    components: {
        App,
        mainHeader,
        Switch,
        logoOnly,
        accessCard,
        registerStep2,
        Toast,
        Vuelidate,
        VuelidateErrorExtractor
    }
});
