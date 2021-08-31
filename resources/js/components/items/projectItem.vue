<template>
    <li :class="'project-container small ' + [clicked ? 'clicked' : '']" v-on:click="clicked=!clicked">
        <img :src="this.mainPicture === '' ? 'storage/assets/temp/ProjectPlaceholder.svg' : this.mainPicture" alt="pfp">
        <div class="info">
            <div class="topInfo">
                <div class="title">
                    <div class="topPart">
                        <h3>Title</h3>
                        <div v-if="location!==''" class="separator"/>
                        <div v-if="location!==''" class="icon-button">
                            <span class="material-icons-round">place</span>
                            <button class="minPriority titleText">
                                {{ location }}
                            </button>
                        </div>
                        <div class="separator"/>
                        <button class="minPriority titleText last">
                            {{members}} members
                        </button>
                    </div>
                    <h5 v-if="subtitle!==''">{{subtitle}}</h5>
                </div>
                <div class="states">
                    <state-tag type="project" project-need="investment" :need-state="needInvestment"></state-tag>
                    <state-tag type="project" project-need="recruitment" :need-state="needRecruitment"></state-tag>
                </div>
            </div>
            <div class="bottomInfo">
                <div class="percentages">
                    <div><h4 class="num">{{financedState}}%</h4> <h5 class="percent-text">Financed</h5></div>
                    <div><h4 class="num">{{projectState}}%</h4> <h5 class="percent-text">Done</h5></div>
                </div>
                <div v-if="tags.length > 0" class="tags">
                    <tag v-for="n in tags.length" :key="n" :text="'sadfg' + n"></tag>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
import stateTag from "../helpers/stateTag";
import tag from "../helpers/tag";

export default {
    name: "projectItem",
    props: {
        projectId: {required: true},
        mainPicture: {default: ''},
        title: {required: true},
        subtitle: {default: ''},
        location: {default: ''},
        members: {required: true},
        financedState: {required: true},
        projectState: {required: true},
        tags: {default: [], type: Array},
        needInvestment: {required: true},
        needRecruitment: {required: true}
    },
    components:{
        stateTag,
        tag
    },
    data(){
        return{
            clicked: false
        }
    }
}
</script>

<style scoped>
.project-container.small{
    display: flex;
    width: 98%;
    height: 128px;
    padding: var(--margin-regular);
    background: var(--tutti-grey-2);
    border-radius: var(--margin-regular);
    border: none;
    font-size: unset;
    line-height: unset;
}

.project-container.small:hover{
    background: var(--tutti-grey-3);
    cursor: pointer;
}

.project-container.small.clicked{
    border: 2px solid var(--tutti-grey-4);
    background: var(--tutti-grey-3);
    padding: calc(var(--margin-regular) - 2px);
}

.project-container > img{
    width: 96px;
    height: 96px;
    border-radius: var(--margin-small);
    object-fit: cover;
}

.info{
    display: flex;
    flex: 1;
    justify-content: space-between;
    flex-direction: column;
    margin-left: var(--margin-regular);
}

.topInfo{
    display: flex;
    justify-content: space-between;
}

.states{
    display: flex;
    flex-direction: column;
}

.title{
}

.title > h5{
    font-size: var(--text-medium);
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.topPart{
    display: flex;
    align-items: center;
}

.topPart > h3{
    margin: 0 var(--margin-small) 0 0;
    font-size: var(--text-large);
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 195px;
}

.topPart > *{
    margin-right: var(--margin-small);
}

.icon-button{
    display: flex;
}

.icon-button> span{
    color: var(--tutti-grey-4);
    font-size: var(--icon-regular);
    margin-right: var(--margin-tiny);
}

.separator{
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: var(--tutti-grey-4);
}

.titleText{
    display: flex;
    align-items: center;
    font-weight: 500;
    color: var(--tutti-grey-4);
    padding: 0;
    font-size: var(--text-base);
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 80px;
}

.last{
    margin-right: 0;
}

.bottomInfo{
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}

.percentages{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    color: var(--tutti-grey-4);
}

.percentages > div{
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-right: var(--margin-medium);
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.percent-text{
    font-size: var(--text-medium);
    margin-left: var(--margin-small);
}

.num{
    font-size: var(--text-big);
    color: var(--tutti-white);
}

.tags{
    display: flex;
    justify-content: flex-end;
}

.tags > *{
    margin-left: var(--margin-small);
}
</style>
