<template>
    <div class="searchPage-container">
        <breadcrumbs :pages="[capitalizeFirstLetter(searchType) + 's']"></breadcrumbs>
        <div class="searchHeader">
            <div class="searchMode-container" v-on:click="titleOpen=!titleOpen" v-on:mouseleave="titleOpen=false">
                <h2>{{ capitalizeFirstLetter(searchType) + 's' }}</h2>
                <span class="material-icons-round">{{ titleOpen ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</span>
                <div v-if="titleOpen" class="fill"/>
                <div v-if="titleOpen" class="titleDialog">
                    <a v-for="(item, i) in this.types" v-if="item !== searchType" :class="[i === 0 ? 'first' : '']">{{ capitalizeFirstLetter(item) + 's' }}</a>
                </div>
            </div>
            <div v-if="searchType==='project'" class="filters">
                <filter-selector name="Progress"></filter-selector>
                <filter-selector name="Financement"></filter-selector>
                <filter-selector name="Start date"></filter-selector>
                <filter-selector name="Themes"></filter-selector>
                <filter-selector name="Location"></filter-selector>
                <filter-selector name="Members"></filter-selector>
                <filter-selector name="Needs"></filter-selector>
            </div>
            <div v-else-if="searchType==='entrepreneur'" class="filters">
                <filter-selector name="Location"></filter-selector>
                <filter-selector name="Rating"></filter-selector>
                <filter-selector name="Finished projects"></filter-selector>
                <filter-selector name="Work status"></filter-selector>
                <filter-selector name="Looking for a proj." :toggle="true"></filter-selector>
                <filter-selector name="Verified" :toggle="true"></filter-selector>
                <filter-selector name="Following" :toggle="true"></filter-selector>
            </div>
            <div v-else class="filters">
                <filter-selector name="Location"></filter-selector>
                <filter-selector name="Rating"></filter-selector>
                <filter-selector name="Nº of investments"></filter-selector>
                <filter-selector name="Looking to invest" :toggle="true"></filter-selector>
                <filter-selector name="Verified" :toggle="true"></filter-selector>
                <filter-selector name="Following" :toggle="true"></filter-selector>
            </div>
        </div>
        <div class="header-extras">
            <h5 v-if="anySearch!==''">Showing results for "{{ anySearch }}"</h5>
            <div v-if="anySearch!==''" class="separator"/>
            <h5>100 results</h5>
            <div v-if="searchType==='project'" class="tags">
                <tag text="Design" :selectable="true"></tag>
                <tag text="Mechanical" :selectable="true"></tag>
                <tag text="Car" :selectable="true"></tag>
                <tag text="Engine" :selectable="true"></tag>
                <tag text="Racing" :selectable="true"></tag>
            </div>
        </div>
        <div v-if="searchType==='project'" class="projectSearchContent">
            <ul ref="projectsScroller" class="project-list">
                <project-item v-for="n in 7" class="child" :key="n" :need-recruitment="false" :need-investment="true" project-state="40" financed-state="60" members="3" title="AR STRADALE 33" project-id="3"></project-item>
                <li class="projectsEnd">
                    <div>
                        <h5>
                            There's no more projects to show
                        </h5>
                        <div class="icon-button">
                            <span class="material-icons-round">north</span>
                            <button class="minPriority" v-on:click="projectsScroll">
                                Go back to the top
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            <project-card :need-recruitment="false" :need-investment="true" project-state="40" financed-state="60" :members="[1,2,3,4,5]" subtitle="Automobile development" title="AR STRADALE 33" :online="true"></project-card>
        </div>
        <div v-else ref="usersScroller" class="userScroller">
            <div class="userSearchContent child">
                <user-item v-for="n in 10" :key="n" :following="false" :state="true" :type="searchType" name="Elsa Pito" user-id="2"></user-item>
                <div class="usersEnd">
                    <h5>
                        There's no more {{searchType + 's'}} to show
                    </h5>
                    <div class="icon-button">
                        <span class="material-icons-round">north</span>
                        <button class="minPriority" v-on:click="usersScroll">
                            Go back to the top
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import breadcrumbs from "../helpers/breadcrumbs";
import filterSelector from "../helpers/filterSelector";
import tag from "../helpers/tag";
import ProjectItem from "../items/projectItem";
import ProjectCard from "../items/projectCard";
import SelectableBackground from "../helpers/selectableBackground";
import UserItem from "../items/userItem";
import Vue2Filters from "vue2-filters";

export default {
    name: "searchPage",
    components: {
        UserItem,
        SelectableBackground,
        ProjectCard,
        ProjectItem,
        breadcrumbs,
        filterSelector,
        tag
    },
    mixins: [Vue2Filters.mixin],
    props:{
        anySearch: {default: ''},
        searchType: {required: true, oneOf: ['project', 'entrepreneur', 'investor']}
    },
    data(){
        return{
            titleOpen: false,
            types: ['project', 'entrepreneur', 'investor'],
            value: 50
        }
    },
    methods: {
        projectsScroll(){
            this.$refs.projectsScroller.scrollTo(0,0);
        },
        usersScroll(){
            this.$refs.usersScroller.scrollTo(0,0);
        },
        capitalizeFirstLetter(text){
            return this.$options.filters.capitalize(text);
        }
    }
}
</script>

<style scoped>
.searchPage-container{
    display: block;
}

.searchHeader{
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-top: var(--margin-regular);
}

.filters{
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-left: var(--margin-regular);
}

.searchMode-container{
    display: flex;
    align-items: center;
    cursor: pointer;
    position: relative;
}

.searchMode-container > h2{
   margin: 0;
}

.searchMode-container > span{
    font-size: var(--icon-big);
    color: var(--tutti-white);
    margin-left: var(--margin-tiny);
}

.titleDialog{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    position: absolute;
    top: var(--margin-big);
    background: rgba(29, 29, 29, 0.8);
    backdrop-filter: blur(64px);
    padding: var(--margin-regular);
    border-radius: var(--margin-regular);
}

.titleDialog > a{
    font-size: var(--text-larger);
    color: var(--tutti-grey-4);
    letter-spacing: 0.02em;
    font-weight: 700;
    text-decoration: none;
    border-radius: var(--margin-small);
}

.titleDialog > .first{
    margin-bottom: var(--margin-regular);
}

.fill{
    position: absolute;
    width: 0;
    height: 0;
    border-left: 32px solid transparent;
    border-right: 32px solid transparent;
    top: var(--margin-medium);
    border-bottom: 32px solid transparent;
}

.header-extras{
    display: flex;
    align-items: center;
    margin-top: var(--margin-regular);
}

.header-extras > h5{
    font-size: var(--text-medium);
}

.separator{
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: var(--tutti-grey-4);
}

.tags{
    display: flex;
    margin-left: var(--margin-medium);
}

.tags > *{
    margin-left: var(--margin-small);
}

.projectSearchContent{
    display: grid;
    grid-template-columns: 60% 40%;
    column-gap: 20px;
    margin-top: var(--margin-half);
}

.userSearchContent{
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    column-gap: var(--margin-regular);
    grid-template-rows: auto;
    row-gap: var(--margin-regular);
    margin: 0 0 0 var(--margin-regular);
}

.userScroller{
    margin-top: var(--margin-medium);
    overflow-y: scroll;
    scroll-behavior: smooth;
    direction: rtl;
    height: 544px;
    border-radius: var(--margin-regular);
}

.userScroller::-webkit-scrollbar{
    width: 6px;
    background: none;
}

.project-list{
    overflow-y: scroll;
    height: 544px;
    list-style-type: none;
    padding: 0;
    direction: rtl;
    scroll-behavior: smooth;
    margin: 0;
    border-radius: var(--margin-regular);
}

.project-list::-webkit-scrollbar{
    width: 6px;
    background: none;
}

.child{
    direction:ltr;
}

.projectsEnd{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 98%;
    height: 128px;
    padding: var(--margin-regular);
    background: none;
    border-radius: var(--margin-regular);
    border: none;
    font-size: unset;
    line-height: unset;
}

.projectsEnd > div{
    display: flex;
    flex-direction: column;
    align-items: center;
}

.icon-button{
    display: flex;
    flex-direction: row-reverse;
    align-items: center;
}

.icon-button> span{
    color: var(--tutti-white);
    font-size: var(--icon-regular);
}

.usersEnd{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    grid-column-start: 1;
    grid-column-end: 6;
    padding: var(--margin-medium);
}
</style>
