<template>
    <input ref="range" type="range" min="0" max="100" v-model="this.model">
</template>

<script>
export default {
    name: "slider",
    props: {
        model: {required: false}
    },
    updated() {
        const rangeInputs = this.$refs.range;

        function handleInputChange(e) {
            let target = e.target
            if (e.target.type !== 'range') {
                target = document.getElementById('range')
            }
            const min = target.min
            const max = target.max
            const val = target.value

            target.style.backgroundSize = (val - min) * 100 / (max - min) + '% 100%'
        }

        rangeInputs.forEach(input => {
            input.addEventListener('input', handleInputChange)
        })
    }
}
</script>

<style scoped>

</style>
