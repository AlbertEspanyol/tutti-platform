<template>
    <div v-if="type==='user'">
        <div v-if="userState" class="state-container success">
            <span class="material-icons-round">check</span>
            <p class="success">{{ userType === 'entrepreneur' ? 'Looking for a project' : 'Looking to invest' }}</p>
        </div>
        <div v-else class="state-container error">
            <span class="material-icons-round mdi-18px">close</span>
            <p class="error">{{ userType === 'entrepreneur' ? 'Not looking for a proj.' : 'Not looking to invest' }}</p>
        </div>
    </div>

    <div v-else>
        <div v-if="needState" class="state-container success">
            <span class="material-icons-round">check</span>
            <p class="success">{{ projectNeed === 'recruitment' ? (short ? 'New partners' : 'Open to new partners') : (short ? 'Investments' : 'Open to investments') }}</p>
        </div>
        <div v-else class="state-container error">
            <span class="material-icons-round mdi-18px">close</span>
            <p class="error">{{ projectNeed === 'recruitment' ? (short ? 'New partners' : 'Closed to new partners') : (short ? 'Investments' : 'Closed to investments') }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "stateTag",
    props: {
        type: {required: true, oneOf: ['user', 'project']},
        userType: {oneOf: ['investor', 'entrepreneur'], default: 'investor'},
        userState: {default: false},
        projectNeed: {oneOf: ['investment', 'recruitment'], default: 'investment'},
        needState: {default: false},
        short: {default: false}
    }
}
</script>

<style scoped>
.state-container{
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin: 0 0 var(--margin-small) 0;
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
    font-size: var(--icon-small);
    margin-right: var(--margin-tiny);
}

.state-container.success{
    color: var(--success);
}

.state-container.error{
    color: var(--error);
}
</style>
