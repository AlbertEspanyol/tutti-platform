<template>
    <div class="access-container">
        <hooper class="card-container" ref="carousel" :initial-slide="determineMode()" :mouse-drag="false" :wheelControl="false" :keysControl="false">
            <slide>
                <div class="header">
                    <h2>Register</h2>
                    <button class="lowPriority accessController" v-on:click.prevent="slideNext">Login</button>
                </div>
                <form ref="reg-form" class="form-containter" v-on:submit.prevent="registerSubmit">
                    <input class="mode-input" name="mode" :value="modeSelector">
                    <div :class="'input ' + [registerNameError() ? 'error' : '']">
                        <div class="input-label">Full name *</div>
                        <div class="date-container">
                            <input type="text" placeholder="Your name" name="reg_name" v-model.trim="register.name"/>
                            <img v-if="registerNameError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                        </div>
                    </div>
                    <div :class="'input ' + [registerMailError() ? 'error' : '']">
                        <div class="input-label">Email *</div>
                        <div class="date-container">
                            <input type="email" placeholder="Your e-mail" name="reg_mail" v-model.trim="register.mail"/>
                            <img v-if="registerMailError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                        </div>
                    </div>
                    <div class="passwords">
                        <div :class="'input ' + [registerPassword1Error() ? 'error' : '']">
                            <div class="input-label">Password *</div>
                            <div class="date-container">
                                <input :type="[register.password.first.visible ? 'text' : 'password']" placeholder="Password" name="reg_pass1" v-model="register.password.first.text"/>
                                <img :class="'password-input-icon ' + [register.password.first.text ? 'active ' : null] + [registerPassword1Error() ? 'error ' : null]" v-on:click="()=> {if(register.password.first.text) register.password.first.visible=!register.password.first.visible }" :src="'/storage/assets/icons/' + [register.password.first.visible ? 'eye-off.svg' : 'eye.svg' ]" alt="see_password">
                                <img v-if="registerPassword1Error()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                            </div>
                        </div>
                        <div :class="'input ' + [registerPassword2Error() ? 'error' : '']">
                            <div class="input-label">Repeat password *</div>
                            <div class="date-container">
                                <input :type="[register.password.second.visible ? 'text' : 'password']" placeholder="Type it again" name="reg_pass2" v-model="register.password.second.text"/>
                                <img :class="'password-input-icon ' + [register.password.second.text ? 'active ' : null] + [registerPassword2Error() ? 'error ' : null]" v-on:click="()=> {if(register.password.second.text) register.password.second.visible=!register.password.second.visible }" :src="'/storage/assets/icons/' + [register.password.second.visible ? 'eye-off.svg' : 'eye.svg' ]" alt="see_password">
                                <img v-if="registerPassword2Error()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                            </div>
                        </div>
                    </div>
                    <div :class="'input ' + [registerDateError() ? 'error' : '']">
                        <div class="input-label">Birthday *</div>
                        <div class="date-container">
                            <datepicker placeholder="Choose a date" v-model="register.date"></datepicker>
                            <img :class="[registerDateError() ? 'error-input-icon' : 'date-input-icon']" :src="'/storage/assets/icons/' + [registerDateError() ? 'error_exclamation.svg' : 'calendar.svg']" alt="calendar">
                        </div>
                    </div>
                    <div class="terms">
                        <input type="checkbox" name="reg_terms" v-model="register.terms">
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
                <form ref="login-form" class="form-containter" v-on:submit.prevent="loginSubmit">
                    <input class="mode-input" name="mode" :value="modeSelector">
                    <div :class="'input ' + [ loginMailError() ? 'error' : '']">
                        <div class="input-label">Email *</div>
                        <div class="date-container">
                            <input type="email" placeholder="Your e-mail" name="log_mail" v-model="login.mail"/>
                            <img v-if="loginMailError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                        </div>
                    </div>
                    <div :class="'input ' + [loginPasswordError() ? 'error' : '']">
                        <div class="input-label">Password *</div>
                        <div class="date-container">
                            <input :type="[login.password.visible ? 'text' : 'password']" placeholder="Password" name="log_pass" v-model="login.password.text"/>
                            <img :class="'password-input-icon ' + [login.password.text ? 'active ' : null] + [loginPasswordError() ? 'error ' : null]" v-on:click="()=> {if(login.password.text) login.password.visible=!login.password.visible }" :src="'/storage/assets/icons/' + [login.password.visible ? 'eye-off.svg' : 'eye.svg' ]" alt="see_password">
                            <img v-if="loginPasswordError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                        </div>
                    </div>
                    <div class="loginHelpers">
                        <div class="checkbox-container">
                            <input type="checkbox" name="log_remember" v-model="login.remember">
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
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import { Hooper, Slide } from 'hooper';
import 'hooper/dist/hooper.css';
import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'
import {TYPE} from "vue-toastification";

const REGISTER = 'register';
const LOGIN = 'login';

const REQUIRED_ERROR = " is required";
const MAIL_ERROR = "Email format is not correct";
const PASSWORD_ERROR = "Password must have more than 6 characters";

const isSelected = (value) => value === true;

export default {
    name: "acessCard",
    props: {
        mode: {required: true},
    },
    data() {
        return {
            modeSelector: this.mode,
            register:{
                name: "",
                mail: "",
                password: {
                    first: {
                        text: "",
                        visible: false
                    },
                    second: {
                        text: "",
                        visible: false
                    }
                },
                date: null,
                terms: false
            },
            login: {
                mail: "",
                password:{
                    text: "",
                    visible: false
                },
                remember: false
            },
            submitted: false
        }
    },
    computed: {},
    validations: {
        register:{
            name: { required },
            mail: { required, email },
            password: {
                first: {
                    text: { required, minLength: minLength(6) }
                },
                second: {
                    text: { required, sameAsPassword: sameAs(function () {
                        return this.register.password.first.text;
                        })}
                }
            },
            date: { required },
            terms: { isSelected },
        },
        login: {
            mail: { required, email },
            password: {
                text: { required }
            },
            remember: false
        }
    },
    components: {
        Datepicker,
        Hooper,
        Slide
    },
    methods: {
        slidePrev() {
            this.modeSelector = REGISTER;
            this.$refs.carousel.slidePrev();
            this.submitted = false;
        },
        slideNext() {
            this.modeSelector = LOGIN;
            this.$refs.carousel.slideNext();
            this.submitted = false;
        },
        determineMode(){
            return this.mode === REGISTER ? 0 : 1;
        },
        registerNameError(){
          return this.submitted && this.$v.register.name.$error;
        },
        registerMailError(){
            return this.submitted && this.$v.register.mail.$error;
        },
        registerPassword1Error(){
            return this.submitted && this.$v.register.password.first.$anyError;
        },
        registerPassword2Error(){
            return this.submitted && this.$v.register.password.second.$anyError;
        },
        registerDateError(){
            return this.submitted && this.$v.register.date.$error;
        },
        loginMailError(){
            return this.submitted && this.$v.login.mail.$error;
        },
        loginPasswordError(){
            return this.submitted && this.$v.login.password.$anyError;
        },
        extractErrors(){
            const errorMsgs = [];
            switch (this.modeSelector){
                case REGISTER:
                    if(!this.$v.register.name.required){
                        errorMsgs.push('Name' + REQUIRED_ERROR);
                    }

                    if(!this.$v.register.mail.required){
                        errorMsgs.push('Email' + REQUIRED_ERROR);
                    } else if(!this.$v.register.mail.email){
                            errorMsgs.push(MAIL_ERROR);
                    }

                    if(this.$v.register.password.first.$anyError){
                        if(!this.$v.register.password.first.text.required) {
                            errorMsgs.push('Password' + REQUIRED_ERROR);
                        } else if(!this.$v.register.password.first.text.minLength){
                            errorMsgs.push(PASSWORD_ERROR);
                        }
                    } else if (this.$v.register.password.second.$anyError){
                        if(!this.$v.register.password.second.text.required) {
                            errorMsgs.push('Password confirmation needed');
                        } else if(!this.$v.register.password.second.sameAsPassword){
                            errorMsgs.push('Passwords do not coincide');
                        }
                    }

                    if(!this.$v.register.date.required){
                        errorMsgs.push('Birthday' + REQUIRED_ERROR);
                    }

                    if(!this.$v.register.terms.isSelected){
                        errorMsgs.push('Please accept the terms & conditions');
                    }
                    break;
                case LOGIN:
                    if(!this.$v.login.mail.required){
                        errorMsgs.push('Email' + REQUIRED_ERROR);
                    } else {
                        if(!this.$v.login.mail.email){
                            errorMsgs.push(MAIL_ERROR);
                        }
                    }

                    if(!this.$v.login.password.text.required) {
                        errorMsgs.push('Password' + REQUIRED_ERROR);
                    }
                    break;
            }
            let errorString = "";
            errorMsgs.forEach(value => {
               errorString = errorString + value + '\n';
            });
            return errorString;
        },
        loginSubmit(e) {
            this.submitted = true;

            if(this.$v.login.$invalid){
                this.$toast(this.extractErrors(),
                    {
                        type: TYPE.ERROR,
                        position: 'top-center',
                        icon: {
                            iconClass: 'material-icons',
                            iconChildren: 'error',
                            iconTag: 'span'
                        }
                    });
                return;
            }

            this.$refs["login-form"].submit();
        },
        registerSubmit(e) {
            this.submitted = true;

            this.$v.register.$touch();
            if(this.$v.register.$invalid){
                this.$toast(this.extractErrors(),
                    {
                        type: TYPE.ERROR,
                        position: 'top-center',
                        icon: {
                            iconClass: 'material-icons',
                            iconChildren: 'error',
                            iconTag: 'span'
                        }
                    });
                return;
            }

            this.$refs["reg-form"].submit();
        }
    }
}
</script>


<style>
.access-container{
    position: relative;
    grid-column-start: 2;
    grid-row: 2;
}

.card-container{
    margin-top: var(--margin-regular);
    margin-bottom: var(--margin-huge);

    height: 642px;
    width: 462px;
    padding: var(--margin-big) var(--margin-medium) var(--margin-medium) var(--margin-medium);

    background: rgba(29, 29, 29, 0.5);
    backdrop-filter: blur(64px);
    border-radius: var(--margin-big);

    grid-column-start: 2;
    grid-row: 2;
}

.header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-left: var(--margin-regular);
}

.mode-input{
    display: none;
}

.accessController{
    margin-right: 18%;
}

.input{
    margin-bottom: var(--margin-regular);
}

.error-container{
    position: absolute;
    padding: var(--margin-medium);
    background: var(--error);
    border-radius: 48px;
    grid-column-start: 3;
    grid-row: 2;
    top:0;
    left: 462px;
    margin-top: var(--margin-regular);
    margin-left: var(--margin-regular);

}

.input.error > input{
    color: var(--error);
    border: 6px solid rgba(255,64,64,0.5);
    margin: -6px;
    border-radius: 13px;
    height: calc(var(--icon-big) + 12px);
    width: calc(100% + 12px);
    background-clip: padding-box;
    -webkit-background-clip: padding-box;
}

.input.error > div.date-container > input{
    color: var(--error);
    border: 6px solid rgba(255,64,64,0.5);
    margin: -6px;
    border-radius: 13px;
    height: calc(var(--icon-big) + 12px);
    width: calc(100% + 12px);
    background-clip: padding-box;
    -webkit-background-clip: padding-box;
}

.input.error > div.errorMsg{
    color: var(--error);
    font-weight: 600;
    font-size: var(--text-small);
    letter-spacing: 0.02em;
    margin-top: var(--margin-small);
}

.error-input-icon{
    position: absolute;
    height: var(--icon-regular);
    top: 7px;
    right: 12px;
}


.passwords{
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

.password-input-icon.error{
    margin-right: var(--margin-medium);
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
