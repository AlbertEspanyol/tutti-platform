<template>
    <div :class="'goal ' + [completed ? 'success':'']">
        <span class="material-icons-round">{{completed ? 'check_circle' : 'tour'}}</span>
        <p><slot></slot></p>
    </div>
</template>

<script>
export default {
    name: "goal",
    props: {
        completed: {default: false}
    }
}
</script>

<style scoped>
.goal{
    background: var(--tutti-grey-2);
    display: flex;
    padding: var(--margin-regular) var(--margin-regular) calc(var(--margin-regular) - 4px);
    color: var(--tutti-white);
    border-radius: var(--margin-small);
}

.goal.success{
    color: var(--success);
}

.goal > span{
    margin-right: var(--margin-small);
    width: 20px;
    height: 20px;
}
</style>
