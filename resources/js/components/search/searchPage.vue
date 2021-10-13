<template>
    <div class="searchPage-container">
        <breadcrumbs :pages="[{name: capitalizeFirstLetter(searchType) + 's', ref: 'none'}]"></breadcrumbs>
        <div class="searchHeader">
            <div class="searchMode-container" v-on:click="titleOpen=!titleOpen" v-on:mouseleave="titleOpen=false">
                <h2>{{ capitalizeFirstLetter(searchType) + 's' }}</h2>
                <span class="material-icons-round">{{ titleOpen ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</span>
                <div v-if="titleOpen" class="fill"/>
                <div v-if="titleOpen" class="titleDialog">
                    <a v-for="(item, i) in this.types" v-if="item !== searchType" :href="'/search/'+item" :class="[i === 0 ? 'first' : '']">{{ capitalizeFirstLetter(item) + 's' }}</a>
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
            <h5>{{objects.length}} result{{objects.length === 1? '' : 's'}}</h5>
            <div v-if="searchType==='project'" class="tags">
                <tag v-for="(item, index) in allTags" :key="index" :text="item" :selectable="true" :index="index" :select-func="toggleTag"></tag>
            </div>
        </div>
        <div v-if="searchType==='project'" class="projectSearchContent">
            <ul ref="projectsScroller" class="project-list">
                <project-item v-for="item in objects" :class="'child' + [selectedProject.id === item.id ? ' child--active' : '']" :key="item.id" :select-project="selectProject" :project="item" :selected="selectedProject.id === item.id"></project-item>
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
            <project-card v-if="selectedProject !== ''" :selected-project="selectedProject"></project-card>
        </div>
        <div v-else ref="usersScroller" class="userScroller">
            <div class="userSearchContent child">
                <user-item v-for="item in objects" v-if="item.userType === searchType" :key="item.id" :user="item" :following="false" :state="true"></user-item>
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
        searchType: {required: true, oneOf: ['project', 'entrepreneur', 'investor']},
        items: {required: true}
    },
    created() {
        this.objects = JSON.parse(this.items);
        for(let i = 0; i < this.objects.length; i++){
            this.objects[i].tags = this.objects[i].tags.split(',');
        }
        this.objects.forEach(value => {
            value.tags.forEach(value => {
                if(!this.allTags.includes(value)) this.allTags.push(value);
            })
        })
    },
    data(){
        return{
            titleOpen: false,
            types: ['project', 'entrepreneur', 'investor'],
            value: 50,
            selectedProjectId: 0,
            selectedProject: '',
            selectedTags: [],
            objects: [],
            allTags: [],
            filteredObjects: []
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
        },
        selectProject(proj){
            this.selectedProject = proj;
        },
        toggleTag(name, selected){
            if(selected){
                this.selectedTags.push(name);
            } else {
                this.$delete(this.selectedTags, this.selectedTags.indexOf(name));
            }
            this.filter();
        },
        filter(){
            this.objects.forEach(obj => {
                this.selectedTags.forEach(value =>{
                    if(this.objects.tags.includes(value)) this.filteredObjects.push(obj);
                })
            })
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

.child--active{
    border: 2px solid var(--tutti-grey-4);
    background: var(--tutti-grey-3);
    padding: calc(var(--margin-regular) - 2px);
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
