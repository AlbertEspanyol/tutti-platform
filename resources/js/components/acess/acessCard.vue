<template>
    <div class="card-container">
        <div class="header">
            <h2>Register</h2>
            <button class="lowPriority">Login</button>
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
                        <input :type="[password.first.visible ? 'text' : 'password']" placeholder="Password" name="reg_pass1" v-model="password.first.text"/>
                        <img :class="'password-input-icon ' + [password.first.text ? 'active' : null]" v-on:click="password.first.visible=!password.first.visible" :src="'storage/assets/icons/' + [password.first.visible ? 'eye-off.svg' : 'eye.svg' ]" alt="see_password">
                    </div>
                </div>
                <div>
                    <label>Repeat password *</label>
                    <div class="date-container">
                        <input :type="[password.second.visible ? 'text' : 'password']" placeholder="Type it again" name="reg_pass2" v-model="password.second.text"/>
                        <img :class="'password-input-icon ' + [password.second.text ? 'active' : null]" v-on:click="password.second.visible=!password.second.visible" :src="'storage/assets/icons/' + [password.second.visible ? 'eye-off.svg' : 'eye.svg' ]" alt="see_password">
                    </div>
                </div>
            </div>
            <div class="input">
                <label>Birthday *</label>
                <div class="date-container">
                    <datepicker placeholder="Choose a date" v-model="date"></datepicker>
                    <img class="date-input-icon" src="storage/assets/icons/calendar.svg" alt="calendar">
                </div>
            </div>
            <div class="terms">
                <input type="checkbox" name="reg_terms">
                <p>I agree to all the statements in <a>Terms of service</a></p>
            </div>
            <div class="submitButton">
                <button class="standardPriority">Register</button>
            </div>
            <div class="card-footer">
                <p>Already a member? <a>Login</a></p>
            </div>
        </form>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";

export default {
    name: "acessCard",
    data: function () {
        return {
            type: "",
            date: null,
            password: {
                first: {
                    text: "",
                    visible: false
                },
                second: {
                    text: "",
                    visible: false
                }
            }
        }
    },
    components: {
        Datepicker
    }
}
</script>

<style scoped>
.card-container{
    margin-top: var(--margin-regular);
    margin-bottom: var(--margin-huge);

    height: 642px;
    width: 462px;
    padding: var(--margin-big);

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

.terms{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-top: var(--margin-regular);
}

.submitButton{
    display: flex;
    margin-top: var(--margin-medium);
    margin-bottom: var(--margin-big);
    justify-content: center;
}

.card-footer{
    display: flex;
    justify-content: center;
}
</style>
