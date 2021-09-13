<template>
    <form class="search-container" v-on:submit.prevent="changeLocation()">
        <input class="search-input" type="search" name="searchContent" placeholder="Search projects, people..." v-model="text"/>
        <img class="search-icon" src="/storage/assets/icons/search.svg" alt="search_icon"/>
        <select class="search-type" name="searchType" v-model="option">
            <option ref="project" value="project">Projects</option>
            <option selected value="investor">Investors</option>
            <option ref="entrepreneur" value="entrepreneur">Entrep.</option>
        </select>
    </form>
</template>

<script>
export default {
    name: "searchBar",
    props:{type: {default: 'none'}, previousText: {default: ''}},
    data(){
        return{
            option: 'project',
            text: this.previousText
        }
    },
    created: function (){
        for (let $refsKey in this.$refs) {
            if($refsKey === this.type) {
                this.$refs[this.type].setAttribute('selected', 'true');
            } else {
                this.$refs[this.type].setAttribute('selected', 'false');
            }
        }
    },
    methods:{
        changeLocation(){
            window.location = '/search/' + this.option + '/' + this.text;
        }
    }
}
</script>

<style scoped>
.search-container{
    position: relative;
    width: 352px;
}

.search-input{
    padding-left: var(--margin-big);
}

.search-icon{
    position: absolute;
    margin-left: var(--margin-regular);
    left: 0;
    top: var(--margin-small);
    width: var(--icon-regular);
}

.search-type{
    position: absolute;
    right: 0;
    border: none;
    margin: 0;
    width: 96px;
}

.search-type:focus{
    border: none;
    margin: 0;
    border-radius: 7px;
    height: var(--icon-big);
}
</style>
