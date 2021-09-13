<template>
    <div class="home-container">
        <div class="background-container">
            <div class="newsFeed">
                <h1>Welcome</h1>
                <h2>Here are some fresh news to start off the day</h2>
                <div class="newsCard">
                    <img src="/storage/assets/temp/ProjectPlaceholder.svg" alt="">
                    <div class="newsContent">
                        <h2>Tutti has reached 1M users</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a mauris in dolor gravida tincidunt congue vel libero. Pellentesque vitae ullamcorper eros. Integer tempor eros augue, nec euismod leo porta in. Sed odio lacus, efficitur ut nisi sed, tempor maximus lectus. Aliquam lectus nunc, malesuada vitae purus ac, fermentum pharetra mauris. Nulla facilisi. Sed velit lectus, vestibulum non nulla nec, elementum porttitor nulla. Maecenas commodo id ligula a dignissim. Mauris elementum placerat nunc sed imperdiet. Mauris cursus iaculis neque, ut efficitur risus eleifend tincidunt.
                        </p>
                        <div class="newsFooter">
                            <div class="author">
                                <img src="/storage/assets/temp/UserPlaceholder.svg" alt="">
                                <div class="names">
                                    <p>Article written by</p>
                                    <button class="minPriority">User</button>
                                </div>
                            </div>
                            <p>
                                100k people have read the article
                            </p>
                            <button class="standardPriority">Go to article</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-container">
            <div class="title">
                <div class="left-items">
                    <h2>Top Projects</h2>
                    <button class="lowPriority" v-on:click="changeLocation('/search/project')">See more</button>
                </div>
                <div class="swipers">
                    <span :class="'material-icons-round ' + [checkForPrevSlides() ? 'disbaled' : '']" v-on:click="slidePrev">keyboard_arrow_left</span>
                    <span :class="'material-icons-round ' + [checkForNextSlides() ? 'disbaled' : '']" v-on:click="slideNext">keyboard_arrow_right</span>
                </div>
            </div>
            <hooper ref="carousel" class="project-list" :items-to-show="2.5" :mouse-drag="false" :wheelControl="false" :keysControl="false">
                <slide v-for="item in cutProjects()" :key="item.id" class="project-item">
                    <project-card :selected-project="item"></project-card>
                </slide>
            </hooper>
        </div>
        <div class="top-container">
            <div class="title">
                <h2>Recommended users</h2>
                <button class="lowPriority" v-on:click="changeLocation('/search/entrepreneur')">See more</button>
            </div>
            <div class="userSearchContent child">
                <user-item v-for="item in cutUsers()" :key="item.id" :user="item" :following="false" :state="true"></user-item>
            </div>
        </div>
        <div class="extraElement">
            <div class="brands">
                <h1>Invest Safely</h1>
                <img class="first" src="storage/assets/images/logos/paypal_logo.svg" alt="">
                <img src="storage/assets/images/logos/mastercard_logo.svg" alt="">
                <img class="last" src="storage/assets/images/logos/visa_logo.svg" alt="">
            </div>
            <h2>With our 3 ways of payment</h2>
            <div class="buts">
                <button class="standardPriority">Start investing</button>
                <button class="lowPriority">Learn more</button>
            </div>
        </div>
    </div>
</template>

<script>
import ProjectCard from "./items/projectCard";
import UserItem from "./items/userItem";
import { Hooper, Slide } from 'hooper';

export default {
    name: "home",
    components: {ProjectCard, UserItem, Hooper, Slide},
    props:{
        users: {required: true},
        projects: {required: true}
    },
    methods:{
        goToProject(){
            console.log('xd');
        },
        cutProjects(){
            return JSON.parse(this.projects).slice(0,4);
        },
        cutUsers(){
            return JSON.parse(this.users).slice(0,6);
        },
        changeLocation(loc){
            window.location = loc;
        },
        slidePrev() {
            this.$refs.carousel.slidePrev();
        },
        slideNext() {
            this.$refs.carousel.slideNext();
        },
        checkForNextSlides(){
            const nexts = document.getElementsByClassName('is-next');
            return nexts.length > 0;
        },
        checkForPrevSlides(){
            const prevs = document.getElementsByClassName('is-prev');
            return prevs.length > 0;
        }
    }
}
</script>

<style scoped>
p{
    margin: 0;
}
.home-container{
    display: flex;
    flex-direction: column;
}

.background-container{
    background: url("/assets/images/SquareGradient.svg") no-repeat;
    background-size: cover;
    margin: -66px -128px var(--margin-large) -128px;
    padding: 50px 128px 0 128px;
}

.newsFeed{
    padding: var(--margin-big) 0;
    display: flex;
    flex-direction: column;
}

.newsFeed > h1{
    color: var(--tutti-black);
}

.newsFeed > h2{
    font-size: var(--text-larger);
    color: var(--tutti-black);
    margin: 0 0 var(--margin-regular) 0;
}

.newsCard{
    height: 335px;
    background: rgba(29, 29, 29, 0.8);
    backdrop-filter: blur(64px);
    border-radius: 48px;
    display: flex;
    align-items: center;
    padding: var(--margin-big);
}

.newsCard > img{
    height: 100%;
    width: auto;
    border-radius: var(--margin-regular);
    margin-right: var(--margin-medium);
}

.newsContent{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.newsContent > h2{
    margin: 0;
}

.newsFooter > p{
    color: var(--tutti-grey-4);
}

.newsFooter{
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
}

.author{
    display: flex;
    align-items: flex-end;
}

.author > img{
    width: 52px;
    height: 52px;
    margin-right: var(--margin-small);
    border-radius: 128px;
}

.names{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.names > p{
    color: var(--tutti-grey-4);
}

.names > button{
    padding: 0;
}

.top-container{
    display: flex;
    flex-direction: column;
    margin-bottom: var(--margin-large);
}

.title{
    display: flex;
    align-items: center;
    margin-bottom: var(--margin-regular);
    justify-content: space-between;
    width: 100%;
}

.left-items > h2{
    margin-right: var(--margin-medium);
}

.left-items {
    display: flex;
    align-items: center;
    margin-bottom: var(--margin-regular);
}

.swipers{
    display: flex;
    align-items: center;
}

.swipers>.disbaled{
    color: var(--tutti-grey-4);
}

.swipers > *{
    margin-left: var(--margin-regular);
    font-size: var(--margin-medium);
    cursor: pointer;
}

.project-item{
    line-height: 150%;
    margin-right: 16px;
}

.project-list{
    display: flex;
    max-width: 1250px;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.userSearchContent{
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    column-gap: var(--margin-regular);
    grid-template-rows: auto;
    row-gap: var(--margin-regular);
}

.extraElement{
    background: url("/assets/images/backgrounds/rockets.png") no-repeat;
    background-size: cover;
    margin: var(--margin-large) -128px -64px -128px;
    padding: 0 128px;
    display: flex;
    flex-direction: column;
    height: 400px;
}

.brands{
    display: flex;
    align-items: center;
}

.brands > h1{
    margin-right: var(--margin-big);
}

.brands > img{
    height: 40px;
    width: auto;
    margin-right: var(--margin-medium);
}

.buts{
    display: flex;
    align-items: center;
    margin-top: var(--margin-medium);
}

.buts>button{
    margin-right: var(--margin-big);
}

.last{
    height: 64px;
    width: auto;
}

.first{
    height: 16px;
    width: auto;
}
</style>
