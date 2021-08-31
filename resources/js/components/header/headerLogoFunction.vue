<template>
    <div class="icon-container">
        <selectable-background wait-time="1000" :helper-text="icon | capitalize"/>
        <img :src="'storage/assets/icons/' + icon + '.svg'" :alt="icon" :width="size" :height="size">
        <div v-if="notifications" class="noti"><span>{{notifications}}</span></div>
    </div>
</template>

<script>
import selectableBackground from "../helpers/selectableBackground";
import Vue2Filters from 'vue2-filters'

export default {
    name: "headerLogoFunction",
    props: {
        icon: {required: true},
        notifications: {required: false},
        size: {required: false}
    },
    mixins: [Vue2Filters.mixin],
    components:{
        selectableBackground
    }
}
</script>

<style scoped>
.icon-container{
    position: relative;
    display: flex;
    align-items: center;
}

.icon-container > img{
    width: calc(var(--icon-regular) + 4px);
}

.noti{
    position: absolute;
    content: "";
    background: var(--error);
    height: var(--icon-regular);
    width: var(--icon-regular);
    border-radius: 50%;
    left: calc(-1*var(--margin-small));
    right: 0;
    top: calc(-1*var(--margin-small));
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: var(--text-tiny);
    letter-spacing: 0.05em;
}
</style>
