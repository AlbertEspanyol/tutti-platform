<template>
    <form class="form-containter" ref="extra-form">
        <input class="decision-input" :value="this.decision" name="userType">
        <input class="decision-input" :value="this.isElite" name="isElite">
        <hooper class="select-container" ref="carousel" :initial-slide="this.slide" :mouse-drag="false" :wheelControl="false" :keysControl="false">
            <slide>
                <div class="header">
                    <h2>What do you want to be?</h2>
                </div>
                <div class="option-container accessController">
                    <div>
                        <div class="option" v-on:click="submitDecisions" data-id="investor">
                            <div>
                                <span>123456 investors online</span>
                                <h3>INVESTOR</h3>
                                <ul class="bullets">
                                    <li>Invest in promising projects</li>
                                    <li>Contact entrepreneurs</li>
                                    <li class="final">Chat with other investors</li>
                                </ul>
                            </div>
                            <img src="/storage/assets/images/elements/Dollar.svg" alt="dollar">
                        </div>
                        <button class="minPriority extra">+ More info about investors</button>
                    </div>
                    <div>
                        <div class="option" v-on:click="slideNext" data-id="entrepreneur">
                            <div>
                                <span>9834754 entrepreneurs on-line</span>
                                <h3>ENTREPRENEUR</h3>
                                <ul class="bullets">
                                    <li>Create your own projects</li>
                                    <li>Join other’s projects</li>
                                    <li class="final">Find partners</li>
                                </ul>
                            </div>
                            <img class="idea" src="/storage/assets/images/elements/Idea.svg" alt="idea">
                        </div>
                        <button class="minPriority extra">+ More info about entrepreneurs</button>
                    </div>
                </div>
                <div class="selector-footer accessController">
                    <h5>Choose one</h5>
                    <p>This can be changed in the future</p>
                </div>
            </slide>
            <slide>
                <div class="header elite">
                    <h5>We're almost done</h5>
                    <button class="lowPriority accessController" v-on:click.prevent="slidePrev">Back</button>
                </div>
                <div class="elite-container accessController">
                    <div class="elitePanelHeader">
                        <h2>Join Tutti Elite today!</h2>
                    </div>
                    <div class="eliteInfo">
                        <div class="infoHeadings">
                            <div>
                                <h4>Unlimited projects</h4>
                                <p>No longer limited to 5</p>
                            </div>
                            <div>
                                <h4>No commissions</h4>
                                <p>0% commission on budget completion</p>
                            </div>
                            <div>
                                <h4>Unlimited budget</h4>
                                <p>No longer limited to 100k</p>
                            </div>
                            <div>
                                <h4>Better exposure</h4>
                                <p>Get found quicker</p>
                            </div>
                        </div>
                        <div class="eliteFooter">
                            <div class="price">
                                <p>Start your Tutti journey the best way for only</p>
                                <h3>12.99€ / month</h3>
                            </div>
                            <div class="buttons">
                                <button class="lowPriority margins" type="submit" v-on:click.prevent="eliteSubmit" data-id="false">No thanks</button>
                                <button class="standardPriority" type="submit" v-on:click.prevent="eliteSubmit" data-id="true">Start with Elite</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="minPriority">+ More info about Tutti Elite</button>
            </slide>
        </hooper>
    </form>
</template>

<script>
import { Hooper, Slide } from 'hooper';
import 'hooper/dist/hooper.css';

const ENTREPRENEUR = 'entrepreneur';
const INVESTOR = 'investor';

export default {
    name: "registerStep2",
    data() {
        return {
            decision: INVESTOR,
            slide: 0,
            isElite: false
        }
    },
    components: {
        Hooper,
        Slide
    },
    methods: {
        slidePrev() {
            this.slide--;
            this.decision = INVESTOR;
            this.$refs.carousel.slidePrev();
        },
        slideNext() {
            this.slide++;
            this.decision = ENTREPRENEUR;
            this.$refs.carousel.slideNext();
        },
        eliteSubmit(e){
            this.isElite = e.currentTarget.getAttribute('data-id');
            this.submitDecisions();
        },
        submitDecisions(){
            this.$refs["extra-form"].submit();
        }
    }
}
</script>

<style scoped>
.form-containter{
    grid-column-start: 2;
    grid-column-end: 10;
    grid-row: 2;
}

.decision-input{
    display: none;
}

.select-container{
    margin-top: var(--margin-regular);
    margin-bottom: var(--margin-huge);

    height: 487px;
    width: 944px;
    padding: var(--margin-big) var(--margin-big) var(--margin-medium) var(--margin-big);

    background: rgba(29, 29, 29, 0.5);
    backdrop-filter: blur(64px);
    border-radius: var(--margin-big);
}

.header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--margin-big);
    margin-left: 0;
}

.header > h5{
    color: rgba(138, 137, 140, 0.5);
}

.accessController{
    margin-right: 10.3%;
}

.option-container{
    display: grid;
    height: 192px;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 100%;
    grid-column-gap: 20px;
}

.option{
    width: 100%;
    height: 100%;
    border: 2px solid rgba(138, 137, 140, 0.5);
    box-sizing: border-box;
    border-radius: var(--margin-regular);
    padding: var(--margin-regular) var(--margin-medium) var(--margin-medium) var(--margin-medium);
    cursor: pointer;

    display: flex;
    align-items: center;
}

.option:hover{
    background: rgba(84, 84, 88, 0.3);
    border: 2px solid var(--tutti-grey-4);
}

.option > div > span{
    font-weight: 400;
    font-size: var(--text-small);
    letter-spacing: 0.05em;
    color: var(--tutti-grey-4);
}

.option > img{
    width: 60px;
    margin-left: auto;
    margin-right: var(--margin-regular);
    margin-top: auto;
}

.option > img.idea{
    width: 80px;
}

.bullets{
    margin-top: var(--margin-half);
}

.extra{
    margin-top: var(--margin-regular);
}

.selector-footer{
    display: block;
    text-align: center;
    justify-content: center;
    color: rgba(138, 137, 140, 0.5);
    margin-top: calc(var(--margin-large) + 21px);
}

.selector-footer > h5{
    color: rgba(138, 137, 140, 0.5);
}

.elite-container{
    height: 339px;
    background: url("/assets/images/SquareGradient.svg") no-repeat center;
    background-size: cover;
    border-radius: var(--margin-medium);
}

.elitePanelHeader{
    display: flex;
    justify-content: center;
    align-items: center;
    padding: var(--margin-medium);
}

.header.elite{
    margin-bottom: var(--margin-medium);
}

.eliteInfo{
    height: 243px;
    width: 100%;
    padding: var(--margin-medium);
    border-radius: var(--margin-medium);
    background: rgba(29, 29, 29, 0.8);
    backdrop-filter: blur(64px);
}

.infoHeadings{
    align-self: flex-start;
    display: flex;
    justify-content: space-between;
}

.infoHeadings > div{
    max-width: 25%;
}

.infoHeadings > div > p{
    margin-top: var(--margin-regular);
}

.infoHeadings > div > h4{
    font-weight: 700;
}

.eliteFooter{
    align-self: flex-end;
    display: flex;
    justify-content: space-between;
    margin-top: 56px;
}

.eliteFooter > .price > h3{
    margin-top: var(--margin-regular);
    margin-bottom: var(--margin-medium);
}

.margins{
    margin-right: var(--margin-regular);
}
</style>
