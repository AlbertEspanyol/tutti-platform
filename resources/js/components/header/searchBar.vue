<template>
    <div id="search-bar">
        <form class="search-container">
            <div class="text-container">
                <img class="search-icon" src="storage/assets/icons/search.svg" alt="search_icon"/>
                <input type="text" class="search-block" placeholder="Search projects, people..."/>
            </div>
            <select>
                <option>Projects</option>
                <option>Entrepreneurs</option>
                <option>Investors</option>
            </select>
        </form>
    </div>
</template>

<script>
export default {
    name: "searchBar"
}
</script>

<style scoped>
.search-container{
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 352px;
    max-height: 34px;
    background: var( --tutti-white);
    border-radius: 7px;
}

.text-container{
    align-items: center;
}

.search-block{
    padding-left: 48px;
    width: 100%;
    -webkit-appearance: none;
}

.search-icon{
    position: absolute;
    margin-left: 16px;
    width: var(--icon-regular);
}
</style>
