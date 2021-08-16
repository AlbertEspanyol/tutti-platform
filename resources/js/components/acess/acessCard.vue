<template>
    <hooper class="card-container" ref="carousel" :initial-slide="determineMode()" :mouse-drag="false" :wheelControl="false" :keysControl="false">
        <slide>
            <div class="header">
                <h2>Register</h2>
                <button class="lowPriority accessController" v-on:click.prevent="slideNext">Login</button>
            </div>
            <form class="form-containter">
                <div class="input">
                    <label>Full name *</label>
                    <input type="text" placeholder="Your name" name="reg_name"/>
                </div>
                <div class="input">
                    <label>Email *</label>
                    <input type="email" placeholder="Your e-mail" name="reg_mail"/>
                </div>
                <div class="input passwords">
                    <div>
                        <label>Password *</label>
                        <div class="date-container">
                            <input :type="[regPassword.first.visible ? 'text' : 'password']" placeholder="Password" name="reg_pass1" v-model="regPassword.first.text"/>
                            <img :class="'password-input-icon ' + [regPassword.first.text ? 'active' : null]" v-on:click="regPassword.first.visible=!regPassword.first.visible" :src="'/storage/assets/icons/' + [regPassword.first.visible ? 'eye-off.svg' : 'eye.svg' ]" alt="see_password">
                        </div>
                    </div>
                    <div>
                        <label>Repeat password *</label>
                        <div class="date-container">
                            <input :type="[regPassword.second.visible ? 'text' : 'password']" placeholder="Type it again" name="reg_pass2" v-model="regPassword.second.text"/>
                            <img :class="'password-input-icon ' + [regPassword.second.text ? 'active' : null]" v-on:click="regPassword.second.visible=!regPassword.second.visible" :src="'/storage/assets/icons/' + [regPassword.second.visible ? 'eye-off.svg' : 'eye.svg' ]" alt="see_password">
                        </div>
                    </div>
                </div>
                <div class="input">
                    <label>Birthday *</label>
                    <div class="date-container">
                        <datepicker placeholder="Choose a date" v-model="date"></datepicker>
                        <img class="date-input-icon" src="/storage/assets/icons/calendar.svg" alt="calendar">
                    </div>
                </div>
                <div class="terms">
                    <input type="checkbox" name="reg_terms">
                    <p>I agree to all the statements in <a href="">Terms of service</a></p>
                </div>
                <div class="submitButton">
                    <button class="standardPriority" type="submit">Register</button>
                </div>
                <div class="card-footer">
                    <p>Already a member? <a v-on:click.prevent="slideNext">Login</a></p>
                </div>
            </form>
        </slide>
        <slide>
            <div class="header">
                <h2>Login</h2>
                <button class="lowPriority accessController" v-on:click.prevent="slidePrev">Register</button>
            </div>
            <form class="form-containter">
                <div class="input">
                    <label>Email *</label>
                    <input type="email" placeholder="Your e-mail" name="log_mail"/>
                </div>
                <div class="input">
                    <label>Password *</label>
                    <div class="date-container">
                        <input :type="[logPassword.visible ? 'text' : 'password']" placeholder="Password" name="reg_pass1" v-model="logPassword.text"/>
                        <img :class="'password-input-icon ' + [logPassword.text ? 'active' : null]" v-on:click="logPassword.visible=!logPassword.visible" :src="'/storage/assets/icons/' + [regPassword.first.visible ? 'eye-off.svg' : 'eye.svg' ]" alt="see_password">
                    </div>
                </div>
                <div class="loginHelpers">
                    <div class="checkbox-container">
                        <input type="checkbox" name="log_remember">
                        <p>Remember me?</p>
                    </div>
                    <a href="">Forgot my password?</a>
                </div>
                <div class="submitButton">
                    <button class="standardPriority" type="submit">Login</button>
                </div>
                <div class="separator">
                    <hr>
                    <p>Or log in with</p>
                    <hr>
                </div>
                <div class="alternatives">
                    <div class="alternative">
                        <img src="/storage/assets/images/logos/google.png" alt="google_logo" width="50%">
                    </div>
                    <div class="alternative left">
                        <img src="/storage/assets/images/logos/linkedin.png" alt="google_logo" width="50%">
                    </div>
                </div>
                <div class="card-footer">
                    <p>Not a member yet? <a v-on:click.prevent="slidePrev">Register</a></p>
                </div>
            </form>
        </slide>
    </hooper>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import { Hooper, Slide } from 'hooper';
import 'hooper/dist/hooper.css';

const REGISTER = 'register';
const LOGIN = 'login';

export default {
    name: "acessCard",
    props: {
        mode: {required: true},
    },
    data: function () {
        return {
            date: null,
            regPassword: {
                first: {
                    text: "",
                    visible: false
                },
                second: {
                    text: "",
                    visible: false
                }
            },
            logPassword:{
                text: "",
                visible: false
            }
        }
    },
    components: {
        Datepicker,
        Hooper,
        Slide
    },
    methods: {
        slidePrev() {
            this.$refs.carousel.slidePrev();
        },
        slideNext() {
            this.$refs.carousel.slideNext();
        },
        determineMode(){
            return this.mode === REGISTER ? 0 : 1;
        }
    }
}
</script>


<style>
.card-container{
    margin-top: var(--margin-regular);
    margin-bottom: var(--margin-huge);

    height: 642px;
    width: 462px;
    padding: var(--margin-big) var(--margin-medium) var(--margin-medium) var(--margin-medium);

    background: rgba(29, 29, 29, 0.5);
    backdrop-filter: blur(64px);
    border-radius: 48px;

    grid-column-start: 2;
    grid-row: 2;
}

.header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-left: var(--margin-regular);
}

.accessController{
    margin-right: 18%;
}

.input{
    margin-bottom: var(--margin-regular);
}

.input.passwords{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-column-gap: var(--margin-small);
}

.form-containter{
    margin-top: var(--margin-medium);
    margin-right: 18%;
    margin-left: var(--margin-regular);
}

.date-container{
    position: relative;
    width: 100%;
    height: 32px;
}

.date-input-icon{
    position: absolute;
    height: var(--icon-regular);
    top: 7px;
    right: 12px;
}

.password-input-icon{
    position: absolute;
    height: var(--icon-regular);
    top: 7px;
    right: 12px;
    opacity: 0.3;
    cursor: not-allowed;
}

.password-input-icon.active{
    opacity: 1;
    cursor: pointer;
}

.checkbox-container{
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.terms{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-top: var(--margin-medium);
}

.loginHelpers{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.submitButton{
    display: flex;
    margin-top: var(--margin-medium);
    margin-bottom: var(--margin-big);
    justify-content: center;
}

.separator{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.separator > hr{
    width: 32%;
    border: 1px solid var(--tutti-white);
}

.separator > p {
    font-weight: 700;
    margin: 0 var(--margin-regular);
}

.alternatives{
    margin: var(--margin-medium) 0 var(--margin-big);
    display: flex;
    justify-content: center;
    align-items: center;
}

.alternative{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 96px;
    height: 74px;
    border-radius: 100px 0 0 100px;
    background: var(--tutti-white);
}

.alternative.left{
    border-radius: 0 100px 100px 0;
}

.alternative:hover{
    background: rgba(248, 247, 255, 0.8);
    cursor: pointer;
}

.card-footer{
    display: flex;
    justify-content: center;
}
</style>
