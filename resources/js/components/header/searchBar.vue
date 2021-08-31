<template>
    <form class="search-container">
        <input class="search-input" type="search" name="searchContent" placeholder="Search projects, people..."/>
        <img class="search-icon" src="storage/assets/icons/search.svg" alt="search_icon"/>
        <select class="search-type" name="searchType">
            <option value="projects">Projects</option>
            <option value="users">Investors</option>
            <option value="entrepreneurs">Entrep.</option>
        </select>
    </form>
</template>

<script>
export default {
    name: "searchBar"
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
