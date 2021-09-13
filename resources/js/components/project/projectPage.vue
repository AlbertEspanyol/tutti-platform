<template>
    <div class="projectPage-container">
        <breadcrumbs :pages="[{name: 'Projects', ref: '/search/project'},{name: info.title, ref: 'none'}]"></breadcrumbs>
        <div class="done">
            <button class="standardPriority" v-on:click.prevent="goToEdit">Edit project</button>
        </div>
        <div class="projImages">
            <img v-for="(item, index) in displayPaths" :class="index === 0 ? 'first' : ''" :src="item" alt="">
        </div>
        <div class="content-container">
            <div class="information">
                <div class="titleInfo">
                    <h2>{{info.title}}</h2>
                    <div class="percentage"><h3 class="num">{{ info.financedState + '%' }}</h3> <h5 class="percent-text">Financed</h5></div>
                    <div class="percentage"><h3 class="num">{{ info.projectState + '%'}}</h3> <h5 class="percent-text">Done</h5></div>
                    <state-tag type="project" project-need="investment" :need-state="info.needInvestment" :short="false"></state-tag>
                    <state-tag type="project" project-need="recruitment" :need-state="info.needRecruitment" :short="false"></state-tag>
                </div>
                <div class="subtitleInfo">
                    <div class="subText">
                        <h5>{{info.subtitle}}</h5>
                        <div :class="'state-container ' + [info.isOnline ? 'success' : 'warning']">
                            <span class="material-icons-round">devices</span>
                            <p class="success">{{ info.isOnline ? 'On-line friendly' : 'Attendance required' }}</p>
                        </div>
                        <div v-if="info.location!==''" class="icon-button card-location last">
                            <span class="material-icons-round">place</span>
                            <button class="minPriority titleText">
                                {{ info.location }}
                            </button>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="numbers">
                            <div class="percentage"><h4>{{ info.currentCash + '€ '}}</h4><h3 class="num">{{ " / "+info.budget + '€'}}</h3> <h5 class="percent-text">Needed</h5></div>
                        </div>
                        <div class="bar-back">
                            <div class="bar" :style="{width: calcProgress() + '%'}"/>
                        </div>
                    </div>
                </div>
                <p class="introduction">
                    {{info.introduction}}
                </p>
                <div v-if="getTags().length > 0" class="tags">
                    <tag v-for="(item, index) in getTags()" v-if="item!=='none'" :key="index" :text="item" :index="index"></tag>
                </div>
                <div class="field small">
                    <h3>Goals</h3>
                    <div class="goals">
                        <goal v-for="n in 4" :key="n" :completed="n <= 2">{{'Goal ' + n}}</goal>
                    </div>
                </div>
                <div class="field">
                    <h3>Description</h3>
                    <p>{{info.description}}</p>
                </div>
                <div class="field">
                    <h3>Partner conditions & requirements</h3>
                    <p>{{info.partnerConditions}}</p>
                    <div class="stakes"><p>Stake offered:</p> <h4>{{ info.stake }}</h4></div>
                </div>
                <div class="field">
                    <h3>Investment needs</h3>
                    <p>{{info.investmentNeeds}}</p>
                    <div class="stakes"><p>Investment needed:</p> <h4>{{' ' + (info.budget - info.currentCash) +' € (' + (100 - calcProgress()) +'%)' }}</h4></div>
                </div>
            </div>
            <div class="users">
                <div class="usersCard">
                    <h4>TEAM</h4>
                    <ul class="usersList">
                        <small-profile v-for="(item, n) in info.members.split(',')" :key="n" :type="n === 0 ? 'Creator' :'Partner'">{{ item }}</small-profile>
                    </ul>
                </div>
                <div class="usersCard">
                    <h4>INVESTORS</h4>
                    <ul class="usersList">
                        <small-profile v-for="n in 3" :key="n" type="Investor">User Name</small-profile>
                    </ul>
                </div>
                <form ref="project" class="partner-form" v-on:submit.prevent="partnerPubmit">
                    <button class="maxPriority" type="submit">Join Project</button>
                    <div class="terms">
                        <input type="checkbox" name="partner_terms" v-model="termsAccepted">
                        <p>I agree to all the statements in <a href="">Terms of partnership</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import breadcrumbs from "../helpers/breadcrumbs";
import StateTag from "../helpers/stateTag";
import tag from "../helpers/tag";
import goal from "../helpers/goal";
import SmallProfile from "../helpers/smallProfile";
import {TYPE} from "vue-toastification";

const isSelected = (value) => value === true;

export default {
    name: "projectPage",
    components: {SmallProfile, breadcrumbs, StateTag, tag, goal},
    props: {
        infoRaw: {required: true}
    },
    data(){
        return{
            termsAccepted: false,
            info: '',
            displayPaths: []
        }
    },
    created: function(){
        this.info = JSON.parse(this.infoRaw);
        if(this.info.images !== 'none'){
            const t = this;
            this.info.images.split(',').forEach(value => {
                axios.get('/api/file/' + value).then((res) =>{
                    t.displayPaths.push(res.data.path);
                })
            })
        }
    },
    validations:{
        termsAccepted: { isSelected }
    },
    methods: {
        calcProgress(){
           return ((this.info.currentCash / this.info.budget) * 100);
        },
        getTags(){
            return this.info.tags.replace(/\s/g, '').split(',');
        },
        partnerPubmit(){
            this.$v.termsAccepted.$touch();
            if(this.$v.termsAccepted.$invalid){
                this.$toast("You must accept the terms & conditions",
                    {
                        type: TYPE.ERROR,
                        position: 'top-center',
                        icon: {
                            iconClass: 'material-icons-round',
                            iconChildren: 'error',
                            iconTag: 'span'
                        }
                    });
                return;
            }

            this.$refs["project"].submit();
        },
        goToEdit(){
            window.location = '/project/' + this.info.id + '/edit';
        },
        getPath(id){
            let path;
            axios.get('/api/file/' + id).then((res) =>{
                path = res.data[0].path;
            })
            return path;
        },
        getImages(){
            return this.info.images === 'none' ? [] : this.info.images.split(',');
        }
    }
}
</script>

<style scoped>
p{
    margin: 0;
}

.projectPage-container{
    display: flex;
    flex-direction: column;
}

.done{
    width: fit-content;
    margin: var(--margin-medium) 0;
}

.projImages{
    position: relative;
    display: flex;
    align-items: center;
    margin-top: var(--margin-regular);
}

.projImages > *{
    border-radius: var(--margin-small);
    object-fit: cover;
    height: 211px;
    margin-right: var(--margin-regular);
}

.im{
    height: 211px;
    width: auto;
}

.first{
    width: 582px;
    height: 211px;
}

.content-container{
    display: grid;
    grid-template-columns: 80% 20%;
    column-gap: var(--margin-regular);
    margin-top: var(--margin-half);
}

.information{
    grid-column: 1;
    display: flex;
    flex-direction: column;
}

.titleInfo{
    display: flex;
    align-items: flex-end;
}

.titleInfo>h2{
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.titleInfo > *{
    margin-right: var(--margin-medium);
}

.percentage{
    display: flex;
    align-items: flex-end;
}

.percent-text{
    font-size: var(--text-medium);
    margin-left: var(--margin-small);
}

.num{
    color: var(--tutti-white);
}

h3{
    margin: 0;
}

.subtitleInfo{
    display: grid;
    grid-template-columns: 25% 75%;
    margin: var(--margin-regular) 0 var(--margin-half) 0;
}

.subText{
    display: flex;
    flex-direction: column;
}

.subText > *{
    margin-bottom: var(--margin-small);
}

.state-container{
    display: flex;
    align-items: center;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.state-container > p{
    margin: 0;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.state-container > span{
    font-size: var(--icon-regular);
    margin-right: var(--margin-tiny);
}

.state-container.success{
    color: var(--success);
}

.state-container.warning{
    color: var(--warning);
}

.state-container.warning > p{
    color: var(--warning);
}

.icon-button{
    display: flex;
}

.icon-button> span{
    color: var(--tutti-grey-4);
    font-size: var(--icon-regular);
    margin-right: var(--margin-tiny);
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

.progress{
    display: flex;
    flex-direction: column;
    margin-top: auto;
    padding: 0 var(--margin-huge);
}

.numbers{
    margin-bottom: var(--margin-small);
}

.bar-back{
    background: var(--tutti-grey-3);
    width: 100%;
    height: var(--margin-small);
    border-radius: 16px;
}

.bar{
    height: var(--margin-small);
    background: linear-gradient(109.04deg, var(--tutti-green-brigth) 10.54%, var(--tutti-red-bright) 113.22%);
    border-radius: 16px;
}

.last{
    margin: 0;
}

.introduction{
    margin-bottom: var(--margin-medium);
    padding-right: var(--margin-large);
}

.tags{
    display: flex;
    align-items: center;
    margin-bottom: var(--margin-medium);
}

.tags > *{
    margin-right: var(--margin-small);
}

.field{
    margin-bottom: var(--margin-medium);
    padding-right: var(--margin-large);
}

.field > h3{
    margin-bottom: var(--margin-half);
}

.field.small{
    margin-bottom: var(--margin-regular)
}

.goals{
    display: flex;
    align-items: center;
    max-width: 100%;
    width: 100%;
    flex-wrap: wrap;
}

.goals > *{
    margin: 0 var(--margin-regular) var(--margin-regular) 0;
}

.stakes{
    margin-top: var(--margin-half);
    display: flex;
    align-items: center;
}

.stakes > p{
    margin-right: var(--margin-small);
}

.users{
    display: flex;
    flex-direction: column;
    align-items: center;
}

.usersCard{
    width: 100%;
    background: var(--tutti-grey-2);
    padding: var(--margin-medium) var(--margin-medium) var(--margin-regular) var(--margin-medium);
    border-radius: var(--margin-regular);
    margin-bottom: var(--margin-regular);
}

.usersList{
    padding: 0;
    margin-bottom: 0;
}

.partner-form{
    display: flex;
    flex-direction: column;
    width: 100%;
    margin-top: var(--margin-regular);
}

.partner-form > button{
    font-size: var(--text-large);
}

.terms{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-top: var(--margin-medium);
}
</style>
