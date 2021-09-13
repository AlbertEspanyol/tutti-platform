<template>
    <div class="header-background-container">
        <div class="header-container">
            <div class="left-elements">
                <img v-on:click="changeLocation('/')" class="logo" src="/storage/assets/logo/noText/Logo_noText_Svg.svg" alt="Logo_noText" width="34" height="34"/>
                <search-bar :type="type" :previous-text="search"></search-bar>
                <div v-on:click="changeLocation('/')">
                    Home
                    <div v-if="currentPage==='Home'" class="underline"/>
                </div>
                <div v-on:click="changeLocation('/search/project')">
                    Projects
                    <div v-if="currentPage==='Projects'" class="underline"/>
                </div>
                <div v-on:click="changeLocation('/search/investor')">
                    Investors
                    <div v-if="currentPage==='Investors'" class="underline"/>
                </div>
                <div class="last" v-on:click="changeLocation('/search/entrepreneur')">
                    Entrepreneurs
                    <div v-if="currentPage==='Entrepreneurs'" class="underline"/>
                </div>
            </div>
            <div v-if="logged" class="right-elements">
                <button class="maxPriority headerCTA" v-on:click.prevent="changeLocation('/create')">Start a project</button>
                <header-logo-function icon="help"></header-logo-function>
                <header-logo-function icon="notifications"></header-logo-function>
                <header-logo-function icon="messages" notifications="3"></header-logo-function>
                <img src="/storage/assets/icons/account.svg" class="account" alt="account">
            </div>
            <div v-else class="right-elements accessSide">
                <button class="maxPriority headerCTA notLogged" v-on:click.prevent="changeLocation('/create')">Start a project</button>
                <div class="separator"/>
                <button class="standardPriority headerCTA login" v-on:click.prevent="changeLocation('/access/login')">Login</button>
                <button class="minPriority signUp" v-on:click.prevent="changeLocation('/access/register')">Sign up</button>
            </div>
        </div>
    </div>
</template>

<script>
import searchBar from "./searchBar";
import headerLogoFunction from "./headerLogoFunction";

export default {
    name: "mainHeader",
    props: {
        logged: {required: true},
        currentPage: {default: 'none', oneOf: ['Home', 'Projects', 'Entrepreneurs', 'Investors']},
        search: {default: ''},
        type: {default: 'project'}
    },
    components: {
        searchBar,
        headerLogoFunction
    },
    methods:{
        changeLocation(loc){
            window.location = loc;
        }
    }
}
</script>

<style scoped>
.header-background-container{
    position: sticky;
    left: 0;
    top: 0;
    height: 66px;
    width: 100%;
    z-index: 999;
}

.pre-background{
    position: absolute;
    height: 66px;
}

.header-container{
    display: flex;
    align-items: center;
    height: 66px;
    width: 100%;
    background: rgba(29, 29, 29, 0.8);
    padding-left: var( --margin-huge);
    padding-right: var( --margin-huge);
    backdrop-filter: blur(64px);
    justify-content: space-between;
}

.logo{
    margin-right: var( --margin-medium);
}

.left-elements{
    display: flex;
    flex-direction: row;
    align-items: center;
}

.left-elements > *{
    display: flex;
    margin-right: var(--margin-medium);
    flex-direction: row;
    cursor: pointer;
}

.left-elements > div{
    font-weight: 800;
    font-size: var(--text-base);
    letter-spacing: 0.1em;
    position: relative;
    align-items: center;
    justify-content: center;
}

.underline{
    position: absolute;
    bottom: calc(var(--margin-half)*-1);
    width: 40px;
    height: 3px;
    background: var(--tutti-white);
    border-radius: 11px 11px 0 0;
}

.right-elements{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-end;
}

.right-elements > *{
    margin-left: var(--margin-medium);
}

.account{
    width: var(--icon-big);
}

.headerCTA{
    height: 36px;
    font-weight: 900;
    font-size: 16px;
    line-height: 0;
    min-width: 175px;
}

.headerCTA:hover{
    height: 48px;
    min-width: 187px;
    margin-left: calc(var(--margin-medium) - 6px);
}

.headerCTA.notLogged:hover{
    height: 48px;
    min-width: 187px;
    margin-left: calc(var(--margin-regular) - 6px);
}

.headerCTA.login{
    min-width: 100px;
}

.headerCTA.login:hover{
    min-width: 112px;
    margin-left: calc(var(--margin-regular) - 6px);
}

.accessSide > *{
    margin-left: var(--margin-regular);
}

.separator{
    height: var(--icon-regular);
    border-left: 1px solid rgba(248, 247, 255, 0.5);
}

.signUp{
    font-weight: 800;
    font-size: var(--text-medium);
    min-width: 65px;
}

.last{
    margin: 0;
}

.xd{
    width: fit-content;
    height: fit-content;
}

@media (max-width: 1490px) {
    .headerCTA{
        display: none;
    }

    .separator{
        display: none;
    }

    .headerCTA.login{
        display: block;
        margin-left: var(--margin-medium);
    }

    .headerCTA.login:hover{
        margin-left: calc(var(--margin-medium) - 6px);
    }

    .headerCTA.notLogged:hover{
        margin-left: calc(var(--margin-medium) - 6px);
    }
}
</style>
