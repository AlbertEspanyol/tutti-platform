<template>
    <div class="bread-container">
        <div class="breads">
            <button class="minPriority" v-on:click.prevent="changeLocation('/')">Home</button>
            <span class="material-icons-round">keyboard_arrow_right</span>
        </div>
        <div class="breads" v-for="(item, index) in pages">
            <span class="material-icons-round" v-if="index > 0">keyboard_arrow_right</span>
            <button v-if="item.ref!=='none'" class="minPriority" v-on:click.prevent="changeLocation(item.ref)">{{ item.name }}</button>
            <div v-else class="lastBread">{{ item.name }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "breadcrumbs",
    props: {
        pages: {required: true, type: Array}
    },
    methods: {
        changeLocation(ref){
            window.location = ref;
        }
    }
}
</script>

<style scoped>
.bread-container{
    display: flex;
    align-items: center;
    margin-top: var(--margin-regular);
}

.breads{
    display: flex;
}

.breads > button{
    font-size: var(--text-small);
    font-weight: 500;
    padding: 0;
}

.breads > *{
    margin-right: var(--margin-small);
}

.breads > span{
    font-size: var(--text-small);
    color: var(--tutti-white);
}

.lastBread{
    font-size: var(--text-small);
    font-weight: 700;
    letter-spacing: 0.05em;
}
</style>
