<template>
    <div v-if="!selectable" class="tag-container">
        {{text}}
        <img v-if="dismissable" src="storage/assets/icons/close_white.svg" alt="close" width="8" height="8">
    </div>

    <div v-else v-on:mouseover="mouseover=true" v-on:mouseleave="mouseover=false" v-on:click="changeSelected" :class="'tag-container selectable ' + [this.selected ? 'selected' : '']">
        {{text}}
        <img v-if="mouseover && !selected" src="storage/assets/icons/add.svg" alt="add" width="8" height="8">
        <img v-if="selected" src="storage/assets/icons/close_white.svg" alt="close" width="8" height="8">
    </div>
</template>

<script>
export default {
    name: "tag",
    props: {
        dismissable: {default: false},
        selectable: {default: false},
        text: {required: true}
    },
    data(){
        return{
            mouseover: false,
            selected: false,
        }
    },
    methods: {
        changeSelected(){
            this.selected=!this.selected;
            console.log(this.selected);
        }
    }
}
</script>

<style scoped>
.tag-container{
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 8px 16px 6px;
    width: fit-content;

    background: rgba(18, 18, 18, 0.3);
    border: 2px solid rgba(138, 137, 140, 0.3);
    border-radius: 21px;

    font-weight: 700;
    line-height: 17px;
    font-size: var(--text-base);
    letter-spacing: 0.05em;
    color: var(--tutti-white);
}

.tag-container.selectable:hover{
    cursor: pointer;
}

.tag-container:hover{
    background: rgba(18, 18, 18, 1);
    border: 2px solid rgba(138, 137, 140, 1);
}

.tag-container > img{
    margin-left: var(--margin-small);
    cursor: pointer;
}

.tag-container.selectable.selected{
    background: linear-gradient(109.04deg, rgba(0 ,247, 165, 0.8) 10.54%, rgba(255, 3, 104, 0.8) 113.22%);
    border: none;
    padding: 10px 18px 8px;
}

</style>
