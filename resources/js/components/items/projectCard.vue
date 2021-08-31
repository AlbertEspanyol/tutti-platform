<template>
    <div class="projectCard-container">
        <div class="card-top">
            <img :src="this.mainPicture === '' ? 'storage/assets/temp/ProjectPlaceholder.svg' : this.mainPicture" alt="project_img">
            <div class="card-header">
                <div class="title">
                    <h3>{{ title }}</h3>
                    <h5>{{ subtitle }}</h5>
                    <div class="title-extra-info">
                        <div v-if="location!==''" class="icon-button card-location">
                            <span class="material-icons-round">place</span>
                            <button class="minPriority titleText">
                                {{ location }}
                            </button>
                        </div>
                        <div :class="'state-container ' + [online ? 'success' : 'warning']">
                            <span class="material-icons-round">devices</span>
                            <p class="success">{{ online ? 'On-line friendly' : 'Attendance required' }}</p>
                        </div>
                    </div>
                </div>
                <div class="profiles">
                    <div class="top-row">
                        <tiny-profile v-for="n in this.members.slice(0,3)" :key="n" user-id="2" user-name="mamawebo" position="top"></tiny-profile>
                    </div>
                    <div class="bottom-row">
                        <tiny-profile v-for="n in this.members.slice(3,6)" :key="n" user-id="2" user-name="mamawebo" position="bottom"></tiny-profile>
                    </div>
                </div>
            </div>
            <div class="percentages">
                <div><h4 class="num">{{ financedState + '%' }}</h4> <h5 class="percent-text">Financed</h5></div>
                <div><h4 class="num">{{ projectState + '%'}}</h4> <h5 class="percent-text">Done</h5></div>
            </div>
            <p class="description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a mauris in dolor gravida tincidunt congue vel libero. Pellentesque vitae ullamcorper eros. Integer tempor eros augue, nec euismod leo porta in. Sed odio lacus, efficitur ut nisi sed, tempor maximus lectus. Aliquam lectus nunc, malesuada vitae purus ac, fermentum pharetra mauris. Nulla facilisi. Sed velit lectus, vestibulum non nulla nec, elementum porttitor nulla. Maecenas commodo id ligula a dignissim.
            </p>
        </div>
        <div class="card-footer">
            <div class="left-elements">
                <div class="states">
                    <state-tag type="project" project-need="investment" :need-state="needInvestment" :short="true"></state-tag>
                    <state-tag type="project" project-need="recruitment" :need-state="needRecruitment" :short="true"></state-tag>
                </div>
                <div v-if="stake!==''" class="stakeMsg"><span>Stake offered: </span><h4 class="num">{{stake}}%</h4></div>
            </div>
            <button class="standardPriority">See more</button>
        </div>
    </div>
</template>

<script>
import tinyProfile from "../helpers/tinyProfile";
import StateTag from "../helpers/stateTag";

export default {
    name: "projectCard",
    props:{
        online: {required: true},
        title: {required: true},
        subtitle: {required: true},
        location: {default: ''},
        members: {required: true, default: []},
        financedState: {required: true},
        projectState: {required: true},
        needInvestment: {required: true},
        needRecruitment: {required: true},
        stake: {default: ''},
        mainPicture: {default: ''}
    },
    components: {
        StateTag,
        tinyProfile
    }
}
</script>

<style scoped>
.projectCard-container{
    width: 462px;
    height: 544px;

    background: var(--tutti-grey-2);
    border-radius: var(--margin-regular);

    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: space-between;

    padding: var(--margin-medium);
}

.card-top{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.card-top > img{
    width: 100%;
    height: 144px;
    border-radius: var(--margin-small);
    object-fit: cover;
}

.card-header{
    display: flex;
    justify-content: space-between;
    margin-top: var(--margin-regular);
    width: 100%;
}

.title > h3{
    margin: 0 var(--margin-small) 0 0;
    font-size: var(--text-large);
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 195px;
}

.title > h5{
    font-size: var(--text-medium);
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.title-extra-info{
    display: flex;
    align-items: center;
    margin-top: var(--margin-small);
}

.icon-button{
    display: flex;
}

.icon-button.card-location{
    margin: 0 0 0 var(--margin-regular);
}

.icon-button> span{
    color: var(--tutti-grey-4);
    font-size: var(--icon-regular);
    margin-right: var(--margin-tiny);
}

.state-container{
    display: flex;
    align-items: center;
    justify-content: flex-end;
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

.profiles{
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.profiles > *{
    display: flex;
    margin-bottom: var(--margin-small);
}

.profiles > div > div{
    margin-left: var(--margin-small);
}

.percentages{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    color: var(--tutti-grey-4);
    margin: var(--margin-small) 0;
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

.description{
    max-height: 124px;
    text-overflow: ellipsis;
    overflow: hidden;
    margin: var(--margin-small) 0 var(--margin-regular) 0;
}

.card-footer{
    display: flex;
    justify-content: space-between;
    width: 100%;
    align-items: flex-end;
}

.states{
    display: flex;
    align-items: center;
}

.states > *{
    margin-right: var(--margin-small);
}

.stakeMsg{
    font-size: var(--text-base);
    font-weight: 600;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
}

.stakeMsg > span{
    margin-right: var(--margin-small);
}
</style>
