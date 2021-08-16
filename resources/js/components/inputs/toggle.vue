<template>
    <label class="switch">
        <input type="checkbox" class="toggle" :disabled=isDisabled>
        <span class="slider round"></span>
    </label>
</template>

<script>
export default {
    name: "toggle",
    props: {
        isDisabled: Boolean
    }
}
</script>

<style>
.switch {
    position: relative;
    display: inline-block;
    width: 32px;
    height: 16px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    border: 3px solid rgba(248, 247, 255, 0.3);
    border-radius: 32px;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: -3px;
    bottom: -3px;
    border-radius: 32px;
    background-color: var(--tutti-white);
    -webkit-transition: .4s;
    transition: .4s;
}

input[type="checkbox" i].toggle:hover + .slider{
    background: rgba(248,247,255, 0.3);
    transition: 20ms;
}

input[type="checkbox" i].toggle:checked + .slider {
    background: url("/assets/images/SquareGradient.png") no-repeat 80% 70% transparent;
    background-size: 48px 32px;
}

input[type="checkbox" i].toggle:checked + .slider:before {
    -webkit-transform: translateX(16px);
    -ms-transform: translateX(16px);
    transform: translateX(16px);
}

input[type="checkbox" i].toggle:disabled + .slider {
    opacity: 0.3;
    cursor: not-allowed;
}

input[type="checkbox" i].toggle:disabled:hover + .slider{
    background: none;
}

</style>
