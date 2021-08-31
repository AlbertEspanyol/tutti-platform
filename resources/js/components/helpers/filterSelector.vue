<template>
    <div :class="'filter-container ' + [isActive || markAsUsed() ? 'active' : '']" v-on:click="updateToggle" v-on:mouseleave="filterOpen=false ">
        <div class="informer" v-if="markAsUsed() && !toggle">{{ filterMessage() }}</div>
        <label v-on:click="filterOpen=!filterOpen" >{{ name }}</label>
        <toggle v-if="toggle" style="margin-left: var(--margin-small)" v-on:click="updateToggle" v-model="filterData[processName()]"></toggle>
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
                    <p>{{ item.option }}</p>
                </div>
            </div>
            <div v-else-if="name === 'Location'" class="location-container">
                <input type="text" name="location" placeholder="Type any location..." v-model="filterData.location">
                <span class="material-icons-round">place</span>
            </div>
            <div v-else-if="name === 'Members'" class="percentBar">
                <h5>Max. members</h5>
                <vue-slider style="width: 90%; margin: var(--margin-regular) 0;" v-model="filterData.members" adsorb :min="0" :max="10" :interval="1" :tooltip="'none'"></vue-slider>
                <h4>{{filterData.members === 0 ? 'Any' : filterData.members === 10 ? '10+' : filterData.members }}</h4>
            </div>
            <div v-else-if="name === 'Needs'" class="lisitng">
                <h5>Project needs</h5>
                <div v-for="item in this.filterData.needs" class="checkbox-container">
                    <input type="checkbox" name="needs" v-model="item.selected">
                    <p>{{ item.option }}</p>
                </div>
            </div>
            <div v-else-if="name === 'Rating'" class="percentBar">
                <h5>Nº of stars</h5>
                <vue-slider style="width: 90%; margin: var(--margin-regular) 0;" v-model="filterData.rating" adsorb :min="0" :max="3" :interval="1" :tooltip="'none'"></vue-slider>
                <h4>{{filterData.rating === 0 ? 'Any' : filterData.rating }}</h4>
            </div>
            <div v-else-if="name === 'Finished projects'" class="percentBar">
                <h5>Completed ones</h5>
                <vue-slider style="width: 90%; margin: var(--margin-regular) 0;" v-model="filterData.finished_projects" adsorb :min="0" :max="10" :interval="1" :tooltip="'none'"></vue-slider>
                <h4>{{filterData.finished_projects === 0 ? 'Any' : filterData.finished_projects === 10 ? '10+' : filterData.finished_projects }}</h4>
            </div>
            <div v-else-if="name === 'Nº of investments'" class="percentBar">
                <h5>Completed ones</h5>
                <vue-slider style="width: 90%; margin: var(--margin-regular) 0;" v-model="filterData.n_of_investments" adsorb :min="0" :max="10" :interval="1" :tooltip="'none'"></vue-slider>
                <h4>{{filterData.n_of_investments === 0 ? 'Any' : filterData.n_of_investments === 10 ? '10+' : filterData.n_of_investments }}</h4>
            </div>
            <div v-else-if="name === 'Work status'" class="lisitng">
                <h5>Project themes</h5>
                <div v-for="item in this.filterData.themes" class="checkbox-container">
                    <input type="checkbox" name="themes" v-model="item.selected">
                    <p>{{ item.option }}</p>
                </div>
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
    THEMES: 'Themes',
    MEMBERS: 'Members',
    LOCATION: 'Location',
    NEEDS: 'Needs',
    RATING: 'Rating',
    FINISHED_PR: 'Finished projects',
    INVESTMENTS: 'Nº of investments',
    NEED_PR: 'Looking for a proj.',
    WANT_IN: 'Looking to invest',
    WORK: 'Work status',
    VERIFIED: 'Verified',
    FOLLOWING: 'Following'
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
                themes: [{option:'Theme1', selected: false}, {option:'Theme2', selected: false},  {option:'Theme3', selected: false}],
                location: '',
                members: 0,
                needs: [{option: 'Investments', selected: false}, {option: 'New members', selected: false}],
                rating: 0,
                finished_projects: 0,
                n_of_investments: 0,
                looking_for_a_proj: false,
                looking_to_invest: false,
                work_status: [{option: 'Not working', selected: false}, {option: '1 project', selected: false}, {option: '2+ projects', selected: false}],
                verified: false,
                following: false
            },
            listMsgs: [],
            temp: false
        }
    },
    methods: {
        markAsUsed(){
            let processedName = this.processName();
            switch (this.name){
                case FILTERS.PROGRESS:
                    return this.filterData.progress[0] !== 0 || this.filterData.progress[1] !== 100;
                case FILTERS.FINANCEMENT:
                    return this.filterData.financement[0] !== 0 || this.filterData.financement[1] !== 100;
                case FILTERS.MEMBERS:
                case FILTERS.FINISHED_PR:
                case FILTERS.INVESTMENTS:
                case FILTERS.RATING:
                    return this.filterData[processedName] > 0;
                case FILTERS.THEMES:
                case FILTERS.NEEDS:
                case FILTERS.WORK:
                    for(let i = 0; i < this.filterData[processedName].length; i++){
                        if(this.filterData[processedName][i].selected) return true;
                    }
                    return false;
                default:
                    return this.filterData[processedName] !== '' && this.filterData[processedName] !== null && this.filterData[processedName] !== false ;
            }
        },

        filterMessage(){
            let processedName = this.processName();
            switch (this.name){
                case FILTERS.PROGRESS:
                    return (this.filterData[processedName][0] + '% - ' +  this.filterData[processedName][1] + '%');
                case FILTERS.FINANCEMENT:
                    return (this.filterData[processedName][0] + '% - ' +  this.filterData[processedName][1] + '%');
                case FILTERS.STRART_DATE:
                    const date = this.filterData[processedName];
                    const month = date.getMonth() + 1;
                    return date.getDate() + '/' + month + '/' + date.getFullYear();
                case FILTERS.MEMBERS:
                case FILTERS.FINISHED_PR:
                case FILTERS.INVESTMENTS:
                    return this.filterData[processedName] === 10 ? '10+' : this.filterData[processedName];
                case FILTERS.RATING:
                    return this.filterData[processedName] + ' Stars';
                case FILTERS.THEMES:
                case FILTERS.NEEDS:
                case FILTERS.WORK:
                    this.filterData[processedName].forEach(value => {
                        const index = this.listMsgs.indexOf(value.option);
                        if(index !== -1 && !value.selected) {
                            this.listMsgs.splice(index, 1);
                        } else if(index === -1 && value.selected){
                            this.listMsgs.push(value.option);
                        }
                    });
                    return this.listMsgs.join(", ");
                default:
                    return this.filterData[processedName];
            }
        },
        processName(){
            let processedName = this.$options.filters.lowercase(this.name);
            processedName = processedName.replace(/\s/g, "_");
            processedName = processedName.replace(/[^\w\s]/gi, '');
            return processedName;
        },
        updateToggle(){
            if(this.toggle){
                this.filterData[this.processName()] = !this.filterData[this.processName()];
            }
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
    max-width: 115px;
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
    margin-top: var(--margin-small);
}

.checkbox-container > p{
    margin: 0;
}

.checkbox-container > input{
    margin-right: var(--margin-small);
}

.listing{
    display: flex;
    flex-direction: column;
}

.listing > h5{
    margin-bottom: var(--margin-regular);
}

.location-container{
    position: relative;
    width: 200px;
}

.location-container > span{
    position: absolute;
    color: var(--tutti-black);
    font-size: var(--margin-regular);
    right: 12px;
    top: 25%;
}
</style>
