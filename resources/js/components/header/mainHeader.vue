<template>
    <div class="header-container">
        <img class="logo" src="storage/assets/logo/noText/Logo_noText_Svg.svg" alt="Logo_noText" width="34" height="34"/>
        <search-bar></search-bar>
    </div>
</template>

<script>
import searchBar from "./searchBar";

export default {
    name: "mainHeader",
    components: {
        searchBar
    }
}
</script>

<style scoped>
.header-container{
    display: flex;
    align-items: center;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    height: 66px;
    background: rgba(29, 29, 29, 0.8);
    padding-left: var( --margin-huge);
    padding-right: var( --margin-huge);
    backdrop-filter: blur(64px);
}

.logo{
    margin-right: var( --margin-medium);
}
</style>
