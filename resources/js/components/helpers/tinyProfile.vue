<template>
    <div class="pfp-container">
        <img class="pfp" v-on:mouseover="displayHelper" v-on:mouseleave="removeHelper" src="storage/assets/temp/user.jpg" alt="project_img">
        <span v-if="isDisplayable" :class="'helper ' + position">{{userName}}</span>
        <div v-if="isDisplayable" :class="'arrow ' + position"/>
    </div>
</template>

<script>
export default {
    name: "tinyProfile",
    props: {
        userId: {required: true},
        userName: {required: true},
        position: {oneOf: ['top', 'bottom'],default: 'bottom'}
    },
    data(){
      return{
          hovering: false,
          isDisplayable: false
      }
    },
    methods: {
        displayHelper(){
            this.hovering = true;
            setTimeout(() => this.isDisplayable = this.hovering, 500);
        },
        removeHelper(){
            this.hovering = false;
            this.isDisplayable = false;
        }
    }
}
</script>

<style scoped>
.pfp-container{
    position: relative;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    display: flex;
}

.pfp{
    width: var(--icon-big);
    height: var(--icon-big);
    border-radius: 50%;
    border: none;
    object-fit: cover;
}

.pfp:hover{
    border: 2px solid var(--tutti-white);
}

.helper{
    padding: 4px 9px 2px;
    position: absolute;
    font-weight: 500;
    color: var(--tutti-black);
    font-size: var(--text-small);
    background: var(--tutti-white);
    border-radius: var(--margin-small);
    letter-spacing: 0.05em;
    box-shadow: 0 var(--margin-tiny) var(--margin-small) rgba(248, 247 ,255, 0.2);
}

.helper.top{
    bottom: var(--margin-big);
}

.helper.bottom{
    top: var(--margin-big);
}

.arrow{
    position: absolute;
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
}

.arrow.top {
    bottom: calc(var(--margin-big) - 8px);
    border-top: 8px solid var(--tutti-white);
}

.arrow.bottom {
    top: calc(var(--margin-big) - 8px);
    border-bottom: 8px solid var(--tutti-white);
}
</style>
