<template>
    <li :class="'project-container small ' + [selected ? 'clicked' : '']" v-on:click="selectProject(project)">
        <img :src="displayPath" alt="pfp">
        <div class="info">
            <div class="topInfo">
                <div class="title">
                    <div class="topPart">
                        <h3>{{project.title}}</h3>
                        <div v-if="project.location!==''" class="separator"/>
                        <div v-if="project.location!==''" class="icon-button">
                            <span class="material-icons-round">place</span>
                            <button class="minPriority titleText">
                                {{ project.location }}
                            </button>
                        </div>
                        <div class="separator"/>
                        <button class="minPriority titleText last">
                            {{project.members.split(',').length}} members
                        </button>
                    </div>
                    <h5 v-if="project.subtitle">{{project.subtitle}}</h5>
                </div>
                <div class="states">
                    <state-tag type="project" project-need="investment" :need-state="project.needInvestment"></state-tag>
                    <state-tag type="project" project-need="recruitment" :need-state="project.needRecruitment"></state-tag>
                </div>
            </div>
            <div class="bottomInfo">
                <div class="percentages">
                    <div><h4 class="num">{{project.financedState}}%</h4> <h5 class="percent-text">Financed</h5></div>
                    <div><h4 class="num">{{project.projectState}}%</h4> <h5 class="percent-text">Done</h5></div>
                </div>
                <div class="tags">
                    <tag v-for="(item, n) in divideTags()" v-if="item!=='none'" :key="n" :text="item" :index="n"></tag>
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
        selectProject: {type: Function, required: true},
        project: {type: Object, required: true},
        selected: {default: false}
    },
    components:{
        stateTag,
        tag
    },
    created: function(){
        if(this.project.images !== 'none'){
            const t = this;
            axios.get('/api/file/' + this.project.images.split(',')[0]).then((res) =>{
                t.displayPath = res.data.path;
            })
        }
    },
    data(){
        return{
            clicked: false,
            displayPath: '/storage/assets/temp/UserPlaceHolder.svg'
        }
    },
    methods: {
        divideTags(){
            return this.project.tags.replace(/\s/g, '').split(',');
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
    text-align: initial;
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
