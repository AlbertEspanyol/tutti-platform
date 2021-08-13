<template>
    <div id="app">
        <h1>
            Display
        </h1>
        <h2>
            Page title
        </h2>
        <h3>
            Section title
        </h3>
        <h4>
            Item title
        </h4>
        <h5>
            Subtitle
        </h5>
        <label>
            Label
        </label>
        <p>
            xd
        </p>
        <p class="big">
            xd
        </p>
        <p class="little">
            xd
        </p>
        <p class="error">
            xd
        </p>
        <p class="success">
            xd
        </p>
        <a href="">
            link
        </a>
        <button class="maxPriority">
            Label
        </button>
        <button class="maxPriority disabled">
            Label
        </button>
        <button class="standardPriority">
            Label
        </button>
        <button class="standardPriority disabled">
            Label
        </button>
        <button class="lowPriority">
            Label
        </button>
        <button class="lowPriority disabled">
            Label
        </button>
        <button class="minPriority">
            Label
        </button>
        <button class="minPriority disabled">
            Label
        </button>
        <br>
        <form>
            <input type="checkbox"/>
            <input type="checkbox" disabled/>
        </form>
        <form>
            <input type="radio" name="group1"/>
            <input type="radio" name="group1" disabled/>
        </form>
        <div id="toggle">
            <toggle :is-disabled="false"/>
            <toggle :is-disabled="true" />
        </div>
        <input type="text">
        <input type="email">
        <input type="password">
        <select>
            <option>xs</option>
            <option>xd</option>
        </select>
        <input type="search">
        <div class="date-container">
            <datepicker v-model="date"></datepicker>
            <img class="date-input-icon" src="storage/assets/icons/calendar.svg" alt="calendar">
        </div>
    </div>
</template>

<script>
import toggle from "./inputs/toggle";
import Datepicker from 'vuejs-datepicker'

export default {
    name: "app",
    data() {
        return {
            // Initial value can be a date object as well
            date: '2020-10-16'
        }
    },
    components: {
        toggle,
        Datepicker
    }
}
</script>

<style scoped>
.date-container{
    position: relative;
    width: 200px;
    height: 32px;
}

.date-input-icon{
    position: absolute;
    height: var(--icon-regular);
    top: 7px;
    right: 12px;
}
</style>
