<template>
    <div class="logo-container" v-on:click="changeLocation">
        <img class="logo" src="/storage/assets/logo/text/Logo_text_svg.svg" alt="logo_noText">
    </div>
</template>

<script>
export default {
    name: "logoOnly",
    methods: {
        changeLocation(){
            window.location = '/'
        }
    }
}
</script>

<style scoped>
.logo-container{
    position: relative;
    width: 100%;
    height: 80px;
    cursor: pointer;
}

.logo{
    position: absolute;
    bottom: 0;
    width: 180px;
    height: 64px;
}
</style>
