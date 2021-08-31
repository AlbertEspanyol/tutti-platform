<template>
    <div v-on:mouseover="displayHelper" v-on:mouseleave="removeHelper" class="back">
        <span v-if="isDisplayable && helperText!==''" class="helper">{{this.helperText}}</span>
    </div>
</template>

<script>
export default {
    name: "selectableBackground",
    data(){
        return{
            isDisplayable: false,
            hovering: false
        }
    },
    props: {
        helperText: {required: false, default: ''},
        waitTime: {required: false}
    },
    methods: {
        displayHelper(){
            this.hovering = true;
            setTimeout(() => this.isDisplayable = this.hovering, this.waitTime ? this.waitTime : 500);
        },
        removeHelper(){
            this.hovering = false;
            this.isDisplayable = false;
        }
    }
}
</script>

<style scoped>
.back{
    display: flex;
    flex-direction: row;
    position: absolute;
    left: -16px;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.back:hover{
    background: rgba(138,137,140, 0.2);
}

.helper{
    padding: 4px 9px 2px;
    position: absolute;
    top: var(--margin-large);
    font-weight: 500;
    font-size: var(--text-small);
    background: rgba(138,137,140, 0.2);;
    border-radius: var(--margin-small);
    letter-spacing: 0.05em;
    backdrop-filter: blur(64px);
}
</style>
