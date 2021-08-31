<template>
    <div class="header-container">
        <div class="left-elements">
            <img v-on:click="logged=!logged" class="logo" src="storage/assets/logo/noText/Logo_noText_Svg.svg" alt="Logo_noText" width="34" height="34"/>
            <search-bar></search-bar>
            <div>Home</div>
            <div>Projects</div>
            <div>Investors</div>
            <div class="last">Entrepreneurs</div>
        </div>
        <div v-if="logged" class="right-elements">
            <button class="maxPriority headerCTA">Start a project</button>
            <header-logo-function icon="help"></header-logo-function>
            <header-logo-function icon="notifications"></header-logo-function>
            <header-logo-function icon="messages" notifications="3"></header-logo-function>
            <img src="storage/assets/icons/account.svg" class="account" alt="account">
        </div>
        <div v-else class="right-elements accessSide">
            <button class="maxPriority headerCTA notLogged">Start a project</button>
            <div class="separator"/>
            <button class="standardPriority headerCTA login">Login</button>
            <button class="minPriority signUp">Sign up</button>
        </div>
    </div>
</template>

<script>
import searchBar from "./searchBar";
import headerLogoFunction from "./headerLogoFunction";

export default {
    name: "mainHeader",
    props: {logged: {required: true}},
    components: {
        searchBar,
        headerLogoFunction
    }
}
</script>

<style scoped>
.header-container{
    display: flex;
    align-items: center;
    position: sticky;
    left: 0;
    top: 0;
    height: 66px;
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
}

.left-elements > div{
    font-weight: 800;
    font-size: var(--text-base);
    letter-spacing: 0.1em;
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
