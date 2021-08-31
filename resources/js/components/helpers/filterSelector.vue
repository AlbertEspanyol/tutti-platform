<template>
    <div :class="'filter-container ' + [isActive || markAsUsed() ? 'active' : '']" v-on:mouseleave="filterOpen=false ">
        <div class="informer" v-if="markAsUsed()">{{ filterMessage() }}</div>
        <label v-on:click="filterOpen=!filterOpen" >{{ name }}</label>
        <toggle v-if="toggle" style="margin-left: var(--margin-small)"></toggle>
        <span v-on:click="filterOpen=!filterOpen" v-if="!toggle" class="material-icons-round">{{ filterOpen ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</span>
        <div v-if="filterOpen && !toggle" class="arrow"/>
        <div v-if="filterOpen && !toggle" class="filterDialog">
            <div v-if="name === 'Progress'" class="percentBar">
                <h5>Progress state</h5>
                <vue-slider style="width: 90%; margin: var(--margin-regular) 0;" v-model="filterData.progress" :enableCross="false" :tooltip="'none'"></vue-slider>
                <div class="progressInfo">
                    <h4>{{ filterData.progress[0] + '%' }}</h4>
                    <h4>{{ filterData.progress[1] + '%' }}</h4>
                </div>
            </div>
            <div v-else-if="name === 'Financement'" class="percentBar">
                <h5>Financement state</h5>
                <vue-slider style="width: 90%; margin: var(--margin-regular) 0;" v-model="filterData.financement" :enableCross="false" :tooltip="'none'"></vue-slider>
                <div class="progressInfo">
                    <h4>{{ filterData.financement[0] + '%' }}</h4>
                    <h4>{{ filterData.financement[1] + '%' }}</h4>
                </div>
            </div>
            <v-date-picker v-else-if="name === 'Start date'" v-model="filterData.start_date" color="gray" :max-date='new Date()' :input-props="{class: 'date-picker'}"></v-date-picker>
            <div v-else-if="name === 'Themes'" class="lisitng">
                <h5>Project themes</h5>
                <div v-for="item in this.filterData.themes" class="checkbox-container">
                    <input type="checkbox" name="themes" v-model="item.selected">
                    <div>{{ item.theme }}</div>
                </div>
            </div>
            <div v-else-if="name === 'Members'" class="percentBar">
                <h5>Number of members</h5>
                <vue-slider style="width: 90%; margin: var(--margin-regular) 0;" v-model="filterData.members" adsorb :min="1" :max="10" :interval="1" :tooltip="'none'"></vue-slider>
                <h4>{{ filterData.members }}</h4>
            </div>
        </div>
    </div>
</template>

<script>
import toggle from "../inputs/toggle";
import VueSlider from 'vue-slider-component'
import '../../../css/slider.css'
import Vue2Filters from "vue2-filters";
import VCalendar from 'v-calendar';

const FILTERS = {
    PROGRESS: 'Progress',
    FINANCEMENT: 'Financement',
    STRART_DATE: 'Start date',
    MEMBERS: 'Members',
    THEMES: 'Themes'
};

export default {
    name: "filterSelector",
    components: {VueSlider, toggle, VCalendar},
    props: {
        name: {required: true},
        toggle: {default: false}
    },
    mixins: [Vue2Filters.mixin],
    data(){
        return{
            isActive: false,
            filterOpen: false,
            filterData: {
                progress: [0 ,100],
                financement: [0, 100],
                start_date: null,
                themes: [{theme:'Theme1', selected: false}, {theme:'Theme2', selected: false},  {theme:'Theme3', selected: false}],
                location: null,
                members: 1,
                open_to: null
            },
            temp: [{tooltip: 'none'}, {tooltip: 'none'}]
        }
    },
    methods: {
        markAsUsed(){
            let processedName = this.$options.filters.lowercase(this.name);
            processedName = processedName.replace(/\s/g, "_");
            processedName = processedName.replace(/[^\w\s]/gi, '');
            switch (this.name){
                case FILTERS.PROGRESS:
                    return this.filterData.progress[0] !== 0 || this.filterData.progress[1] !== 100;
                case FILTERS.FINANCEMENT:
                    return this.filterData.financement[0] !== 0 || this.filterData.financement[1] !== 100;
                case FILTERS.MEMBERS:
                    return this.filterData.members > 1;
                case FILTERS.THEMES:
                    for(let i = 0; i < this.filterData.themes.length; i++){
                        if(this.filterData.themes[i].selected) return true;
                    }
                    return false;
                default:
                    return this.filterData[processedName] !== null;
            }
        },

        filterMessage(){
            let processedName = this.$options.filters.lowercase(this.name);
            processedName = processedName.replace(/\s/g, "_");
            processedName = processedName.replace(/[^\w\s]/gi, '');
            switch (this.name){
                case FILTERS.PROGRESS:
                    return (this.filterData[processedName][0] + '% - ' +  this.filterData[processedName][1] + '%');
                case FILTERS.FINANCEMENT:
                    return (this.filterData[processedName][0] + '% - ' +  this.filterData[processedName][1] + '%');
                case FILTERS.STRART_DATE:
                    const date = this.filterData[processedName];
                    const month = date.getMonth + 1;
                    return date.getDate() + '/' + month + '/' + date.getFullYear();
                case FILTERS.THEMES:
                    let themeString = '';
                    this.filterData.themes.forEach((value, key) => {
                        console.log(value.theme)
                        if(value.selected) themeString = themeString.concat((key === 0  ? '' : ', ') + value.theme);
                    });
                    return themeString;
                default:
                    return this.filterData[processedName];
            }
        },
        addToFilters(e){
            let processedName = this.$options.filters.lowercase(this.name);
            processedName = processedName.replace(/\s/g, "_");
            processedName = processedName.replace(/[^\w\s]/gi, '');

                this.filterData[processedName] = e.target.value;
        }
    }
}
</script>

<style scoped>
.filter-container{
    position: relative;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    border-radius: var(--margin-small);
    padding: 8px 16px 5px;
    margin-left: var(--margin-tiny);
    cursor: pointer;
}

.filter-container > span{
    font-size: calc(var(--icon-regular) + 4px);
    margin-left: var(--margin-tiny);
}

.filter-container.active{
    background: rgba(138, 137, 140, 0.2);
}

.filter-container:hover{
    background: rgba(138, 137, 140, 0.2);
}

.filter-container > label{
    font-size: var(--text-base);
    font-weight: 600;
    letter-spacing: 0.05em;
    white-space: nowrap;
    cursor: pointer;
}

.filterDialog{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    position: absolute;
    top: var(--margin-big);
    background: rgba(29, 29, 29, 0.8);
    backdrop-filter: blur(64px);
    padding: var(--margin-regular);
    white-space: nowrap;
    border-radius: var(--margin-small);
}

.filterDialog > .first{
    margin-bottom: var(--margin-medium);
}

.arrow{
    position: absolute;
    width: 0;
    height: 0;
    border-left: 32px solid transparent;
    border-right: 32px solid transparent;
    top: var(--margin-medium);
    border-bottom: 32px solid transparent;
}

.percentBar{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 200px;
}

.progressInfo{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.informer{
    position: absolute;
    bottom: var(--margin-big);
    width: fit-content;
    padding: var(--margin-tiny) var(--icon-small) 0 var(--icon-small);
    background: var(--tutti-white);
    border-radius: var(--margin-small);
    cursor: default;
    color: var(--tutti-black);
    font-size: var(--text-small);
    font-weight: 700;
    letter-spacing: 0.05em;
    max-width: 120px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.date-picker{
    background: var(--tutti-grey-2);
    color: var(--tutti-white);
}

.checkbox-container{
    display: flex;
    align-items: center;
}

.checkbox-container > input{
    margin-right: var(--margin-small);
}

.listing{
    display: flex;
    flex-direction: column;
}
</style>
