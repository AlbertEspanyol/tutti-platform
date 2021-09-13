require('./bootstrap');

import Vue from 'vue';

/*** Custom Components ****************************/
import App from './components/app';
import mainHeader from "./components/header/mainHeader";
import Switch from "./components/inputs/toggle";
import logoOnly from "./components/header/logoOnly";
import accessCard from "./components/access/accessCard";
import registerStep2 from "./components/access/registerStep2";
import home from "./components/home";
import searchPage from "./components/search/searchPage";
import projectItem from "./components/items/projectItem";
import projectCard from "./components/items/projectCard";
import userItem from "./components/items/userItem";
import breadcrumbs from "./components/helpers/breadcrumbs";
import tuttiFooter from "./components/footer/tuttiFooter";
import projectPage from "./components/project/projectPage";
import editProjectPage from "./components/project/editProjectPage";
import createProjectPage from "./components/project/createProjectPage";

/*** Validation Library ****************************/
import Vuelidate from "vuelidate";
import VuelidateErrorExtractor, { templates } from "vuelidate-error-extractor";
Vue.use(Vuelidate);
Vue.use(VuelidateErrorExtractor, {
    messages: { required: "The {attribute} field is required" },
    attributes: {
        email: "Email"
    }
})

/*** Toast Library ****************************/
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
const options = {
    timeout: 5000,
    hideProgressBar: true,
    maxToasts: 1,
    toastClassName: "tutti-toast",
};
Vue.use(Toast, options);

/*** Filter Library ****************************/
import Vue2Filters from 'vue2-filters'
Vue.use(Vue2Filters)

/*** Bar Library ****************************/
import VueSlideBar from 'vue-slide-bar'
Vue.component('VueSlideBar', VueSlideBar);

/*** Calendar Library ***********************/
import VCalendar from 'v-calendar';
Vue.use(VCalendar);

new Vue({
    el: '#app',
    components: {
        App,
        mainHeader,
        Switch,
        logoOnly,
        accessCard,
        registerStep2,
        home,
        searchPage,
        projectItem,
        userItem,
        Toast,
        Vuelidate,
        projectCard,
        breadcrumbs,
        VuelidateErrorExtractor,
        Vue2Filters,
        VueSlideBar,
        VCalendar,
        tuttiFooter,
        projectPage,
        editProjectPage,
        createProjectPage
    }
});
