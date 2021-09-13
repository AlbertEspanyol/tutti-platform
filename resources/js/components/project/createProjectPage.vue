<template>
    <form ref="createForm" class="editor-container" v-on:submit.prevent="createProject">
        <breadcrumbs :pages="[{name: 'Create project', ref: 'none'}]"></breadcrumbs>
        <div class="done">
            <button type="submit" class="standardPriority">Done</button>
            <button class="lowPriority" v-on:click.prevent="goBack">Go back</button>
        </div>
        <div class="photos-field">
            <label>Photos</label>
            <div class="photos">
                <div v-for="(item, index) in images" class="editImage">
                    <img :src="item.path" alt="">
                    <span v-on:click="removePhoto(index)" :data-id="item" class="material-icons-round">close</span>
                </div>
                <strong>{{images.length + ' photo' + [images.length !== 1 ? 's':'']}}</strong>
                <form>
                    <input type="file" id="photo" v-on:change="loadPhoto" name="filename" accept="image/png, image/gif, image/jpeg">
                    <label class="uploadButton" for="photo">Add photo</label>
                </form>
            </div>
        </div>
        <div class="title-field">
            <div :class="'input ' + [titleError() ? 'error' : '']">
                <div class="input-label">Title *</div>
                <div class="date-container">
                    <input type="text" placeholder="Project title" name="title" v-model="title"/>
                    <img v-if="titleError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                </div>
            </div>
            <div :class="'input ' + [subtitleError() ? 'error' : '']">
                <div class="input-label">Theme *</div>
                <div class="date-container">
                    <input type="text" placeholder="What's it about" name="subtitle" v-model="subtitle"/>
                    <img v-if="subtitleError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                </div>
            </div>
            <div :class="'input ' + [locationError() ? 'error' : '']">
                <div class="input-label">Location *</div>
                <div class="date-container">
                    <input type="text" placeholder="Type any location" name="location" v-model="location"/>
                    <img v-if="locationError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                    <span v-else class="material-icons-round">place</span>
                </div>
            </div>
            <div class="toggles-container">
                <div class="toggle-1">
                    <label>
                        Online work
                    </label>
                    <div class="toggleText-container">
                        <toggle style="margin-right: var(--margin-small)" v-on:click="isOnline=!isOnline" v-model="isOnline"></toggle>
                        <p>Can the work be done remotely?</p>
                    </div>
                </div>
                <div class="toggle-1">
                    <label>
                        Search for investments or partners
                    </label>
                    <div class="toggleText-container">
                        <toggle style="margin-right: var(--margin-small)" v-on:click="needInvestment=!needInvestment" v-model="needInvestment"></toggle>
                        <p>Looking for investors?</p>
                    </div>
                    <div class="toggleText-container">
                        <toggle style="margin-right: var(--margin-small)" v-on:click="needRecruitment=!needRecruitment" v-model="needRecruitment"></toggle>
                        <p>Looking for partners?</p>
                    </div>
                </div>
            </div>
            <div class="budgets">
                <div :class="'input ' + [budgetError() ? 'error' : '']">
                    <div class="input-label">Budget *</div>
                    <div class="date-container">
                        <input type="text" placeholder="Aim high!" name="budget" v-model="budget"/>
                        <img v-if="budgetError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                    </div>
                </div>
                <div :class="'input ' + [stakeError() ? 'error' : '']">
                    <div class="input-label">Share per partner *</div>
                    <div class="date-container">
                        <input type="text" placeholder="Be rational" name="stake" v-model="stake"/>
                        <img v-if="stakeError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
                    </div>
                </div>
            </div>
        </div>
        <div class="tag-field">
            <div class="input">
                <div class="input-label">Tags</div>
                <div class="date-container">
                    <input type="text" placeholder="Type anything" name="tags" v-model="tempTag"/>
                </div>
            </div>
            <button class="lowPriority" v-on:click.prevent="addTag">Add new</button>
            <div class="tags">
                <tag v-for="(item, n) in tags" :key="n" :text="item" :dismissable="true" :close-function="removeTag" :index="n"></tag>
            </div>
        </div>
        <div class="tag-field users">
            <div class="input">
                <div class="input-label">Team</div>
                <div class="date-container">
                    <input type="text" placeholder="Type anyone" name="tags" v-model="membersTemp"/>
                </div>
            </div>
            <button class="lowPriority" v-on:click.prevent="addMember">Add new</button>
            <div class="userActions">
                <small-profile type="Creator">You</small-profile>
                <div class="partner" v-for="(item, n) in members" v-if="n>0">
                    <small-profile type="Partner" :key="n">{{item}}</small-profile>
                    <div class="terms">
                        <input type="checkbox" name="partner_edit" v-model="editableMembers[n]">
                        <p>Can edit</p>
                    </div>
                    <button class="lowPriority" v-on:click.prevent="removeMember(n)">Remove</button>
                </div>
            </div>
        </div>
        <div :class="'input area intro ' + [introError() ? 'error' : '']">
            <div class="input-label">Introduction *</div>
            <div class="date-container">
                <textarea name="introduction" v-model="introduction"/>
                <img v-if="titleError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
            </div>
        </div>
        <div :class="'input area ' + [descError() ? 'error' : '']">
            <div class="input-label">Description *</div>
            <div class="date-container">
                <textarea name="description" v-model="description"/>
                <img v-if="descError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
            </div>
        </div>
        <div :class="'input area ' + [pcrError() ? 'error' : '']">
            <div class="input-label">Partner conditions & requirements *</div>
            <div class="date-container">
                <textarea name="partnerConditions" v-model="partnerConditions"/>
                <img v-if="pcrError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
            </div>
        </div>
        <div :class="'input area ' + [invError() ? 'error' : '']">
            <div class="input-label">Investment needs *</div>
            <div class="date-container">
                <textarea name="investmentNeeds" v-model="investmentNeeds"/>
                <img v-if="invError()" class="error-input-icon" src="/storage/assets/icons/error_exclamation.svg" alt="error_exclamation">
            </div>
        </div>
        <div class="done">
            <button type="submit" class="standardPriority">Done</button>
        </div>
    </form>
</template>

<script>
import breadcrumbs from "../helpers/breadcrumbs";
import SmallProfile from "../helpers/smallProfile";
import { required } from 'vuelidate/lib/validators'
import toggle from "../inputs/toggle";
import Tag from "../helpers/tag";
import {TYPE} from "vue-toastification";

export default {
    name: "editProjectPage",
    components: {Tag, SmallProfile, breadcrumbs, toggle},
    data(){
        return{
            images: [],
            title: '',
            subtitle: '',
            location: '',
            members: [],
            financedState: null,
            projectStat: null,
            needInvestment: false,
            needRecruitment: false,
            stake: null,
            budget: null,
            tags: [],
            isOnline: false,
            introduction: '',
            description: '',
            partnerConditions: '',
            investmentNeeds: '',
            tempTag: '',
            membersTemp:'',
            editableMembers: [],
            submitted: false,
            id: 0
        }
    },
    validations:{
        title: { required },
        subtitle: { required },
        location: { required },
        stake: { required },
        budget: { required },
        introduction: { required },
        description: { required },
        partnerConditions: { required },
        investmentNeeds: { required }
    },
    methods: {
        removePhoto(index) {
            axios.delete('/api/file/' + this.images[index].id);
            this.$delete(this.images, index);
        },
        titleError(){
            return this.submitted && this.$v.title.$anyError;
        },
        subtitleError(){
            return this.submitted && this.$v.subtitle.$anyError;
        },
        locationError(){
            return this.submitted && this.$v.location.$anyError;
        },
        budgetError(){
            return this.submitted && this.$v.budget.$anyError;
        },
        stakeError(){
            return this.submitted && this.$v.stake.$anyError;
        },
        introError(){
            return this.submitted && this.$v.introduction.$anyError;
        },
        descError(){
            return this.submitted && this.$v.description.$anyError;
        },
        pcrError(){
            return this.submitted && this.$v.partnerConditions.$anyError;
        },
        invError(){
            return this.submitted && this.$v.investmentNeeds.$anyError;
        },
        addPhoto(){
            this.images.push(this.images[this.images.length - 1] + 1);
        },
        addMember(){
            if(this.membersTemp){
                this.members.push(this.membersTemp);
            }
        },
        addTag(){
            if(this.tempTag) {
                this.tags.push(this.tempTag);
            }
        },
        removeMember(index){
            this.$delete(this.members, index);
        },
        removeTag(index){
            this.$delete(this.tags, index);
        },
        createProject(){
            this.submitted = true;

            this.$v.$touch();
            if(this.$v.$invalid){
                this.$toast("Marked fields are required",
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

            axios.post('api/project/store',
                {
                    project: {
                        title: this.title,
                        subtitle: this.subtitle,
                        location: this.location,
                        members: this.formatMembers(),
                        financedState: 0,
                        projectState: 0,
                        needInvestment: this.needInvestment,
                        needRecruitment: this.needRecruitment,
                        stake: this.stake,
                        budget: this.budget,
                        currentCash: 0,
                        tags: this.formatTags(),
                        images: this.formatImage(),
                        isOnline: this.isOnline,
                        introduction: this.introduction,
                        description: this.description,
                        partnerConditions: this.partnerConditions,
                        investmentNeeds: this.investmentNeeds
                    }
                }
            ).then(() =>{
                window.location = '/';
            }).catch((error)=>{
                console.log(error);
            })
        },
        formatImage(){
            const imgs = [];
            this.images.forEach((value, index) => {
               imgs[index] = value.id + ':' + value.path;
            });
            return imgs.length > 0 ? imgs.join(',') : 'none';
        },
        formatMembers(){
            const mems = ['You'];
            this.members.forEach(value => {
                mems.push(value);
            });
            return mems.join(',');
        },
        formatTags(){
            return this.tags.length > 0 ? this.tags.join(',') : 'none';
        },
        goBack(){
            window.history.go(-1);
        },
        loadPhoto(e) {
            e.preventDefault();

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            let data = new FormData();
            data.append('file', e.target.files[0]);

            axios.get('/api/projects/big').then((resp)=>{
                if(resp.data.length > 0) this.id = resp.data[0].id + 1;
            })

            const t = this;
            axios.post('/api/file/upload/' + (this.id+1) +'/' + this.images.length, data, config)
                .then((res) =>{
                    console.log('xd');
                    t.images.push({id: res.data.id, path: res.data.path});
                })
                .catch(function (err) {
                    console.log(err);
                });
        },
        pushPath(path){
            this.images.push(path);
        }
    }
}
</script>

<style scoped>
.editor-container{
    display: flex;
    flex-direction: column;
}

.uploadButton{
    background: transparent;
    font-size: var( --text-medium);
    font-weight: 700;
    letter-spacing: 0.07em;
    height: 36px;
    cursor: pointer;
    border: 2px solid var( --tutti-grey-4);
    border-radius: 100px;
    padding: 0.6em 1.43em 0.5em 1.43em;
    color: var(--tutti-grey-4);
    text-align: center;
    white-space: nowrap;
    margin-left: var(--margin-regular);
}

.uploadButton:hover{
    background: rgba(255,255,255,0.15);
}

input[type="file" i] {
    display: none;
}

.done{
    display: flex;
    align-items: center;
    width: fit-content;
    margin: var(--margin-medium) 0;
}

.done>.lowPriority{
    margin-left: var(--margin-medium);
}

.done>.standardPriority{
    margin: 0;
}

.done>.standardPriority:hover{
    margin: -6px;
}

.photos-field{
    margin-top: var(--margin-regular);
    display: flex;
    flex-direction: column;
    margin-bottom: var(--margin-medium);
}

.photos{
    display: flex;
    align-items: center;
    height: 211px;
}

.editImage{
    position: relative;
    height: 211px;
    width: 211px;
    margin-right: var(--margin-regular);
    transition: ease-in-out;
    transition-duration: 0.2s;
}

.editImage >img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: var(--margin-small);
    margin-right: var(--margin-regular);
}

.editImage > span{
    display: none;
}

.editImage:hover > img{
    opacity: 0.4;
    transition: ease-in-out;
    transition-duration: 0.2s;
}

.editImage:hover > span{
    display: block;
    position: absolute;
    top: calc(50% - var(--margin-medium));
    left: calc(50% - var(--margin-medium));
    color: var(--tutti-white);
    height: 40%;
    width: auto;
    font-size: var(--margin-large);
    cursor: pointer;
}

.photos > strong, button{
    margin: 0 var(--margin-regular);
}

.title-field{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: auto auto;
    padding-right: var(--margin-big);
    column-gap: var(--margin-big);
    row-gap: var(--margin-medium);
    margin-bottom: var(--margin-medium);
}

.date-container{
    position: relative;
    width: 100%;
    height: fit-content;
}

.date-container>span{
    color: var(--tutti-black);
    position: absolute;
    height: var(--icon-regular);
    top: 7px;
    right: 12px;
    font-size: 16px;
}

.input{
    margin-bottom: var(--margin-large);
}

.input.error > div.date-container > input{
    color: var(--error);
    border: 6px solid rgba(255,64,64,0.5);
    margin: -6px;
    border-radius: 13px;
    height: calc(var(--icon-big) + 12px);
    width: calc(100% + 12px);
    background-clip: padding-box;
    -webkit-background-clip: padding-box;
}

.input.area.error > div.date-container > textarea{
    color: var(--error);
    border: 6px solid rgba(255,64,64,0.5);
    margin: -6px;
    border-radius: 13px;
    height: calc(200px + 12px);
    width: calc(100% + 12px);
    background-clip: padding-box;
    -webkit-background-clip: padding-box;
}

.input.area.intro.error > div.date-container > textarea{
    color: var(--error);
    border: 6px solid rgba(255,64,64,0.5);
    margin: -6px;
    border-radius: 13px;
    height: calc(125px + 12px);
    width: calc(100% + 12px);
    background-clip: padding-box;
    -webkit-background-clip: padding-box;
}

.input.area > .date-container>textarea{
    height: 200px;
    padding-top: 6px;
}

.input.area.intro > .date-container>textarea{
    height: 125px;
}

.input.area > .date-container>textarea:focus{
    height: calc(200px + 12px);
    padding-top: 6px;
}

.input.area.intro > .date-container>textarea:focus{
    height: calc(125px + 12px);
}

.toggles-container{
    display: flex;
    flex-direction: column;
}

.toggle-1{
    display: flex;
    flex-direction: column;
    margin-bottom: var(--margin-medium);
}

.toggle-1>*{
    margin-bottom: var(--margin-small);
}

.toggleText-container{
    display: flex;
    align-items: center;
}
.toggleText-container > p{
    margin: 0;
}

.budgets{
     display: flex;
     flex-direction: column;
     width: 60%;
 }

.budgets > *{
    margin-bottom: var(--margin-medium);
}

.tag-field{
    display: flex;
    align-items: flex-end;
    margin-bottom: var(--margin-large);
}

.tag-field.users{
    align-items: flex-start;
}

.tag-field.users > .input{
    margin-top: -16px;
}

.tag-field > *{
    margin-right: var(--margin-regular);
}

.tag-field > .input{
    margin-bottom: 0;
}

.tags{
    display: flex;
    align-items: flex-end;
}

.tags > *{
    margin-right: var(--margin-small);
}

.userActions{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    grid-template-rows: auto;
    column-gap: var(--margin-medium);
    row-gap: var(--margin-medium);
    align-items: baseline;
}

.terms{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-top: var(--margin-regular);
}

.partner > button{
    margin: 0 0  var(--margin-regular) 0;
}

.partner{
    display: flex;
    flex-direction: column;
}

.partner > *{
    margin-bottom: var(--margin-regular);
}
</style>
