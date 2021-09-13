<template>
    <li class="small-profile">
        <div class="pfp"></div>
        <div class="info">
            <button class="minPriority"><slot></slot></button>
            <p>{{type}}</p>
        </div>
    </li>
</template>

<script>
export default {
    name: "smallProfile",
    props: {
        type: {required: true, oneOf: ['Partner', 'Investor', 'Creator']}
    }
}
</script>

<style scoped>
.small-profile{
    display: flex;
    align-items: center;
    padding: 0;
}

.pfp{
    background: url("/assets/temp/UserPlaceholder.svg") no-repeat;
    background-size: cover;
    width: var(--margin-medium);
    height: var(--margin-medium);
    border-radius: 50%;
    margin-right: var(--margin-small);
}

.pfp:hover{
    background: url("/assets/icons/messages.svg") no-repeat center var(--info);
    background-size: var(--margin-regular);
    cursor: pointer;
}

.info{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: baseline;
}

.info > button{
    font-size: var(--text-base);
    padding: 0;
}

.info > p{
    margin: 0;
    font-size: var(--text-small);
    color: var(--tutti-grey-4);
}
</style>
